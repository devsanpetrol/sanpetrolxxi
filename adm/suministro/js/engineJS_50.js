$(document).ready( function () {
    
    reset_form_personal();
    $('.form-control-select2').select2();
    $("body").addClass("sidebar-xs");
    $(".almacen").addClass("active");
    $(".almacen i").addClass("text-orange-800");
    $('#personal_tabla').DataTable({
        bDestroy: true,
        ordering: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        ajax: {
            url: "json_selectPersonal.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'nombre'},
            {data : 'apellidos'},
            {data : 'status'},
            {data : 'cargo'},
            {data : 'departamento'},
            {data : 'accion'}
        ],
        rowGroup: {
            dataSrc: 'ambito'
        },
        columnDefs: [
            {targets: -1, className:'text-center text-primary-800'}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Busqueda...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    
    $('#dt_for_inventario').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-footer"><"datatable-scroll-wrap"t>',
        createdRow: function ( row, data, index ) {
            $('td', row).eq(1).addClass('font-weight-semibold text-pink');
        },
        columnDefs: [
            {targets: 0, className:'text-right'},
            {targets: 2, className:'text-center'}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        }
    });
} );
 function inventarear(e){
     var cod_articulo = $("#"+e.target.id).data("codarticulo");
     var t = $('#dt_for_inventario').DataTable();
     $.post('json_inventariar.php',{ cod_articulo: cod_articulo },function(res){
         $.each(res, function (index, value) {
                t.row.add([
                    value.status,
                    value.cod_articulo,
                    value.unidad,
                    value.no_serie,
                    value.no_inventario,
                    value.costo,
                    value.accion
                ] ).draw( false );
                $("#descripcion").val(value.descripcion);
            });
     }).done(function() {
        $('#old_cod_articulo').val(cod_articulo);
        $('#modal_inventario').modal('show');
        $('.touchspin-prefix').TouchSpin({
            min: 0,
            max: 100000000,
            step: 0.1,
            decimals: 2,
            prefix: '$'
        });
        $('.bootstrap-touchspin-up').addClass('btn-sm alpha-primary text-primary-800 legitRipple font-weight-bold').removeClass('btn-light');
        $('.bootstrap-touchspin-down').addClass('btn-sm alpha-primary text-primary-800 legitRipple font-weight-bold').removeClass('btn-light');
    });
 }
 function guarda_inventario(e){
    var cod_articulo_new= $("#"+e.target.id).data("numercodarticulo");
    var cod_articulo    = $("#old_cod_articulo").val();
    var no_serie        = $("#ser_"+cod_articulo_new).val();
    var no_inventario   = ($('#inv_'+cod_articulo_new).val()).trim();
    var costo           = $('#cos_'+cod_articulo_new).val();
    var inventariado    = $('#'+e.target.id).data('inventariado');
    
    if(no_inventario == "" && inventariado == 'no'){
        console.log('Formulario vacio. No se guardo cambios');
    }else{
        $.post('json_set_inventario.php',{ cod_articulo: cod_articulo, cod_articulo_new: cod_articulo_new, no_serie:no_serie, no_inventario:no_inventario,costo:costo,inventariado:inventariado},function(res){
            if((res[0].type == 'update' || res[0].type == 'insert') && res[0].result == '1'){
                $("#ico_"+cod_articulo_new).removeClass('icon-price-tag3 text-slate-300').addClass('icon-price-tag2 text-pink');
                $('#'+e.target.id).data('inventariado','si');
            }else if(res[0].type == 'delete' && res[0].result == '1'){
                $("#ico_"+cod_articulo_new).addClass('icon-price-tag3 text-slate-300').removeClass('icon-price-tag2 text-pink');
                $("#"+e.target.id).data('inventariado','no');
                clear_form_inv(cod_articulo_new);
            }else if(res[0].type == 'check' && res[0].result == 'exist'){
                alert("El numero de inventario asignado ya existe.");
            }
            console.log('type:'+res[0].type+', result:'+res[0].result);
        });
    }
 }
 function clear_form_inv(cod_articulo_new){
    $("#ser_"+cod_articulo_new).val("");
    $("#inv_"+cod_articulo_new).val("");
    $("#cos_"+cod_articulo_new).val("0.00");
 }
 function  fecha_actual(){
    $.post('json_now.php',function(res){$('#num_folio_vale_salida').text(getFolio(res.fecha_actual));});
 }
 function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}
function salir(){
    $("#modal_inventario").modal("hide");
    var table = $('#dt_for_inventario').DataTable();
    table.clear().draw();
}
function propiedadArticle(e){
    var id = e.target.id;
    var cod_articulo = $("#"+id).data("codarticulo");
    $.post('json_propArticulo.php',{ cod_articulo: cod_articulo },function(res){
        //res[0].status,
        $("#new_codigobarra").val(res.cod_barra);
        $("#new_cod_inventario").val(res.cod_articulo);
        $('#new_tipounidad option[value='+res.tipo_unidad+']').prop('selected', 'selected').change();
        $('#select_categoria option[value='+res.id_categoria+']').prop('selected', 'selected').change();
        $("#new_descripcion").val(res.descripcion);
        $("#new_especificacion").val(res.especificacion);
        $("#new_marca").val(res.marca);
        $("#new_stock").val(res.stock);
        $("#new_min").val(res.stock_min);
        $("#new_max").val(res.stock_max);
        $("#new_ubicacion").val(res.ubicacion);
        $("#new_idarticulo").val(res.id_articulo);
        
        if(res.salida_rapida == 1){
            $("#new_salida_rapida").prop("checked", true);
        }else{
            $("#new_salida_rapida").prop("checked", false);
        }
    }).done(function() {
        $("#article_new").modal("show");
    });
}
function cerrarArticle(){
    $("#article_new").modal("hide");
}
function updArticle(){
    var cod_barra     = $("#new_codigobarra").val(),
        cod_articulo  = $("#new_cod_inventario").val(),
        tipo_unidad   = $('#new_tipounidad').val(),
        id_categoria  = $('#select_categoria').val(),
        descripcion   = $("#new_descripcion").val(),
        especificacion= $("#new_especificacion").val(),
        marca         = $("#new_marca").val(),
        stock_min     = $("#new_min").val(),
        stock_max     = $("#new_max").val(),
        ubicacion     = $("#new_ubicacion").val(),
        id_articulo   = $("#new_idarticulo").val(),
        salida_rapida;
        if($("#new_salida_rapida").is(':checked')) {  
            salida_rapida = 1;
        } else {  
            salida_rapida = 0;
        } 
    
    $.post('json_update_propArticulo.php',{
        cod_articulo:cod_articulo,
        id_articulo:id_articulo,
        cod_barra:cod_barra,
        descripcion:descripcion,
        especificacion:especificacion,
        tipo_unidad:tipo_unidad,
        marca:marca,
        id_categoria:id_categoria,
        stock_min:stock_min,
        stock_max:stock_max,
        ubicacion:ubicacion,
        salida_rapida:salida_rapida
    },function(result){
        if(result[0].result == "exito"){
            alert("Se guardo correctamente!");
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#article_new").modal("hide");
    });
}
function get_categoria(){
    $.ajax({
    type: "GET",
    url: 'json_selectCategoria.php', 
    dataType: "json",
    success: function(data){
        $.each(data,function(key, registro) {
            $("#select_categoria").append("<option value='"+registro.id_categoria+"'>"+registro.categoria+"</option>");
        });
    },
    error: function(data){
      alert('error');
    }
  });
}
//==========================================PERSONAL MODULE ====================
function propiedadPersonal(e){
    var obj = e.target;
    var idempleado = $(obj).data('idempleado');
    get_propPersonal(idempleado);
}
function get_propPersonal(idempleado){
    get_ambito();
    get_departamento();
    get_puesto();
    
    $.ajax({
        data:{idempleado:idempleado},
        url: 'json_propPersonal.php',
        type: 'POST',
        success: function (obj) {
            $("#id_persona").data({idpersona:obj.id_persona, idempleado:obj.id_empleado});
            $("#new_nombre").val(obj.nombre).prop({disabled:true});
            $("#new_apellidos").val(obj.apellidos).prop({disabled:true});
            $("#new_email_personal").val(obj.email_personal);
            $("#new_direccion").val(obj.direccion);
            $("#new_ciudad").val(obj.ciudad);
            $("#new_edo_prov").val(obj.edo_prov);
            $("#new_cod_postal").val(obj.cod_postal);
            $("#new_telefono_personal").val(obj.telefono);
            $("#new_curp").val(obj.curp);
                    
            if(obj.sexo == "M"){
                $("#new_genero_1").prop({checked:true,disabled:true});
                $("#new_genero_2").prop({checked:false,disabled:true});
                $("#bg-m").addClass("badge-success");
            }else if(obj.sexo == "F"){
                $("#new_genero_2").prop({checked:true,disabled:true});
                $("#new_genero_1").prop({checked:false,disabled:true});
                $("#bg-f").addClass("badge-success");
            }
            
            $('#new_ambito option[value='+obj.idambito+']').prop('selected', 'selected').change();
            $('#new_departamento option[value='+obj.id_departamento+']').prop('selected', 'selected').change();
            $('#new_puesto option[value='+obj.id_puesto+']').prop('selected', 'selected').change();
            
            $("#new_cargo").val(obj.cargo);
            if(obj.fecha_alta != null){
                $("#new_fecha_alta").val(obj.fecha_alta).prop({disabled:false,readonly:true});
            }else{
                $("#new_fecha_alta").val(null).prop({disabled:true,readonly:true});
            }
            if(obj.fecha_baja != null){
                $("#new_fecha_baja").val(obj.fecha_baja).prop({disabled:false,readonly:true});
            }else{
                $("#new_fecha_baja").val(null).prop({disabled:true,readonly:true});
            }
            
            $("#new_especialista").val(obj.especialista);
            $("#new_email").val(obj.email);
            $("#new_telefono_empleo").val(obj.telefono_empleo);
        },
        complete: (function () {
            $("#form_btn_insert").hide();
            $("#form_btn_update").show();
            $("#form_btn_reset").hide();
            $("#new_employe").modal('show');
        })
    });
}
function updPersonal(){
    var id_empleado = $("#id_persona").data("idempleado"),
        id_persona = $("#id_persona").data("idpersona"),
        email_personal = $("#new_email_personal").val(),
        direccion = $("#new_direccion").val(),
        ciudad = $("#new_ciudad").val(),
        telefono_personal = $("#new_telefono_personal").val(),
        edo_prov = $("#new_edo_prov").val(),
        cod_postal = $("#new_cod_postal").val(),
        curp = $("#new_curp").val(),
        ambito = $("#new_ambito").val(),
        departamento = $("#new_departamento").val(),
        puesto = $("#new_puesto").val(),
        cargo = $("#new_cargo").val(),
        especialista = $("#new_especialista").val(),
        email = $("#new_email").val(),
        telefono_empleo = $("#new_telefono_empleo").val();
          
    $.post('json_update_propPersonal.php',{
        id_empleado:id_empleado,
        id_persona:id_persona,
        email_personal:email_personal,
        direccion:direccion,
        ciudad:ciudad,
        edo_prov:edo_prov,
        cod_postal:cod_postal,
        curp:curp,
        telefono:telefono_personal,
        ambito:ambito,
        departamento:departamento,
        puesto:puesto,
        cargo:cargo,
        especialista:especialista,
        email:email,
        telefono_empleo:telefono_empleo
        
    },function(result){
        if(result[0].result == "exito"){
            alert("Se guardo correctamente!");
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#article_new").modal("hide");
    });
}
function close_propiedadPersonal(){
    reset_form_personal();
    $("#form_btn_delete").hide();
    $("#form_btn_insert").hide();
    $("#form_btn_update").hide();
    $("#new_employe").modal('hide');
}
function get_ambito(){
    $.ajax({
    type: "GET",
    url: 'json_selectAmbito.php',
    dataType: "json",
    beforeSend: function (xhr){
        $("#new_ambito").append("");
    },
    success: function(data){
        $.each(data,function(key, registro) {
            $("#new_ambito").append("<option value='"+registro.id_ambito+"'>"+registro.ambito+"</option>");
        });
    },
    error: function(data){
      alert('error al cargar lista de Ambito');
    }
  });
}
function get_departamento(){
    $.ajax({
    type: "GET",
    url: 'json_selectDepartamento.php', 
    dataType: "json",
    beforeSend: function (xhr){
        $("#new_departamento").append("");
    },
    success: function(data){
        $.each(data,function(key, registro) {
            $("#new_departamento").append("<option value='"+registro.id_departamento+"'>"+registro.departamento+"</option>");
        });
    },
    error: function(data){
      alert('error al cargar lista de Departamento');
    }
  });
}
function get_puesto(){
    $.ajax({
    type: "GET",
    url: 'json_selectPuesto.php', 
    dataType: "json",
    beforeSend: function (xhr){
        $("#new_puesto").append("");
    },
    success: function(data){
        $.each(data,function(key, registro) {
            $("#new_puesto").append("<option value='"+registro.id_puesto+"'>"+registro.puesto+"</option>");
        });
    },
    error: function(data){
      alert('error al cargar lista de Puestos');
    }
  });
}
function reset_form_personal(){
    $("#form_personal :input").prop({disabled:false});
    $("#bg-m").removeClass("badge-success");
    $("#bg-f").removeClass("badge-success");
    $("#new_nombre").prop({disabled:false});
    $("#new_apellidos").prop({disabled:false});
    $("#new_fecha_alta").val(null).prop({disabled:true,readonly:true});
    $("#new_fecha_baja").val(null).prop({disabled:true,readonly:true});
    $("#new_genero_1").prop({checked:false,disabled:false});
    $("#new_genero_2").prop({checked:false,disabled:false});
    $("#id_persona").data({idpersona:'', idempleado:''});
    $('.form-select-input-personal').val(null).trigger('change');
    $('#form_personal')[0].reset();
}
function setPersonal(){
    var nombre = $("#new_nombre").val(),
        apellidos = $("#new_apellidos").val(),
        email_personal = $("#new_email_personal").val(),
        direccion = $("#new_direccion").val(),
        ciudad = $("#new_ciudad").val(),
        telefono_personal = $("#new_telefono_personal").val(),
        edo_prov = $("#new_edo_prov").val(),
        cod_postal = $("#new_cod_postal").val(),
        genero = $("input[name='radio-unstyled-inline-right']:checked").val(),
        curp = $("#new_curp").val(),
        fecha_alta = $("#new_fecha_alta").val(),
        ambito = $("#new_ambito").val(),
        departamento = $("#new_departamento").val(),
        puesto = $("#new_puesto").val(),
        cargo = $("#new_cargo").val(),
        especialista = $("#new_especialista").val(),
        email = $("#new_email").val(),
        telefono_empleo = $("#new_telefono_empleo").val();
          
    $.post('json_insert_propPersonal.php',{
        nombre:nombre,
        apellidos:apellidos,
        email_personal:email_personal,
        direccion:direccion,
        ciudad:ciudad,
        edo_prov:edo_prov,
        cod_postal:cod_postal,
        genero:genero,
        curp:curp,
        telefono:telefono_personal,
        fecha_alta:fecha_alta,
        ambito:ambito,
        departamento:departamento,
        puesto:puesto,
        cargo:cargo,
        especialista:especialista,
        email:email,
        telefono_empleo:telefono_empleo
        
    },function(result){
        if(result[0].result == "exito"){
            alert("Se guardo correctamente!");
            get_propPersonal(result[0].id_empleado);
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#article_new").modal("hide");
    });
}
function openModalNewEmployed(){
    get_ambito();
    get_departamento();
    get_puesto();
    reset_form_personal();
    $("#new_fecha_alta").prop({disabled:false,readonly:false});
    $("#form_btn_delete").hide();
    $("#form_btn_insert").show();
    $("#form_btn_update").hide();
    $("#form_btn_reset").show();
    $("#new_employe").modal('show');
}
function propiedadPersonalBaja(e){
    var obj = e.target;
    var idempleado = $(obj).data('idempleado');
    get_propPersonalBaja(idempleado);
}
function get_propPersonalBaja(idempleado){
    get_ambito();
    get_departamento();
    get_puesto();
    
    $.ajax({
        data:{idempleado:idempleado},
        url: 'json_propPersonal.php',
        type: 'POST',
        success: function (obj) {
            $("#id_persona").data({idpersona:obj.id_persona, idempleado:obj.id_empleado});
            $("#new_nombre").val(obj.nombre);
            $("#new_apellidos").val(obj.apellidos);
            $("#new_email_personal").val(obj.email_personal);
            $("#new_direccion").val(obj.direccion);
            $("#new_ciudad").val(obj.ciudad);
            $("#new_edo_prov").val(obj.edo_prov);
            $("#new_cod_postal").val(obj.cod_postal);
            $("#new_telefono_personal").val(obj.telefono);
            $("#new_curp").val(obj.curp);
                    
            if(obj.sexo == "M"){
                $("#new_genero_1").prop({checked:true});
                $("#new_genero_2").prop({checked:false});
                $("#bg-m").addClass("badge-success");
            }else if(obj.sexo == "F"){
                $("#new_genero_2").prop({checked:true});
                $("#new_genero_1").prop({checked:false});
                $("#bg-f").addClass("badge-success");
            }
            
            $('#new_ambito option[value='+obj.idambito+']').prop('selected', 'selected').change();
            $('#new_departamento option[value='+obj.id_departamento+']').prop('selected', 'selected').change();
            $('#new_puesto option[value='+obj.id_puesto+']').prop('selected', 'selected').change();
            
            $("#new_cargo").val(obj.cargo);
            if(obj.fecha_alta != null){
                $("#new_fecha_alta").val(obj.fecha_alta);
            }else{
                $("#new_fecha_alta").val(null);
            }
            if(obj.fecha_baja != null){
                $("#new_fecha_baja").val(obj.fecha_baja);
            }else{
                $("#new_fecha_baja").val(null);
            }
            
            $("#new_especialista").val(obj.especialista);
            $("#new_email").val(obj.email);
            $("#new_telefono_empleo").val(obj.telefono_empleo);
        },
        complete: (function () {
            $("#form_personal :input").prop({disabled:true});
            $("#new_fecha_baja").val(null).prop({disabled:false,readonly:false});
            $("#new_comentario_baja").val(null).prop({disabled:false,readonly:false});
            $("#form_btn_delete").show();
            $("#form_btn_insert").hide();
            $("#form_btn_update").hide();
            $("#form_btn_reset").hide();
            $("#new_employe").modal('show');
        })
    });
}
function delPersonal(){
    var fecha_baja = $("#new_fecha_alta").val(),
        comentario = $("#new_ambito").val(),
        id_empleado = $("#new_departamento").val();
          
    $.post('json_delete_propPersonal.php',{
        id_empleado:id_empleado,
        comentario:comentario,
        fecha_baja:fecha_baja
        
    },function(result){
        if(result[0].result == "exito"){
            alert("Se eliminó correctamente!");
            get_propPersonal(result[0].id_empleado);
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#article_new").modal("hide");
    });
}