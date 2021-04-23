$(document).ready( function () {
    get_categoria();
    main_clasificados();
    fecha_actual();
    empleado_list();
    $('#filtro').val("");
    $('.form-control-select2').select2();
    $("body").addClass("sidebar-xs");
    $(".inventario").addClass("active");
    $(".inventario i").addClass("text-orange-800");
    $('#mov_fecha_movimiento_multi').val(moment().format('YYYY-MM-DD'));
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                },
                pageSize: 'LETTER',
                orientation: 'landscape',
                customize: function (doc) {
                    doc.content[1].table.widths = ['13%','13%','36%','10%','4%','4%','4%','16%'];
                    doc.pageMargins = [5,5,5,5];
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 8;
                }
            },
            {
                extend: 'excelHtml5'
            },
            {
                extend: 'copyHtml5'
            }
        ],
        pageLength : 30,
        lengthMenu: [[30, 40, 50, -1], [30, 40, 50, 'Todos']],
        ajax: {
            url: "json_selectInventario.php",
            type:"POST",
            data:{filtro:function(){return $('#filtro').val();}},
            dataSrc:function ( json ) {
                return json;
            }
        },
        columnDefs: [
           {targets:0,className: "font-size-xs font-weight-semibold"},
           {targets:1,className: "font-size-xs font-weight-semibold"},
           {targets:2,className: "font-size-xs font-weight-semibold"},
           {targets:3,className: "font-size-xs font-weight-semibold"},
           {targets:4,className: "text-white"},
           {targets:5,className: "text-white"},
           {targets:6,className: "text-white"},
           {targets:7,className: "font-size-xs font-weight-semibold"}
        ],
        columns: [
            {data : 'no_inventario'},
            {data : 'no_serie'},
            {data : 'descripcion'},
            {data : 'marca'},
            {data : 'status'},
            {data : 'disponible'},
            {data : 'operable'},
            {data : 'grupo'},
            {data : 'accion'}
        ],
        rowGroup: {
            dataSrc: 'nombre_categoria'
        },
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Busqueda...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $("#filtro").bind("change", function() { 
        refrescarTablaInventario();
    }); 
    $('#movimiento_tabla_aplica').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        rowGroup: {
            //dataSrc: 'grupo'
        },
        columnDefs: [
            {targets:0, visible:false}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Buscar proveedor...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $('#movimiento_tabla_aplica_multi').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[-1], ['Todo']],//-1 = all
        rowGroup: {
            //dataSrc: 'grupo'
        },
        columnDefs: [
            //{targets:0, visible:false}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Buscar proveedor...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $('#table_DetailDocumento').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        info: false,        
        createdRow: function ( row, data, index ){
            $('td', row).eq(3).addClass('text-right');
            $('td', row).eq(4).addClass('text-right');
            $(row).addClass('pointer font-weight-semibold text-grey');
        },
        columnDefs: [
            {targets:0,className: "dt-left"},
            {targets:1,className: "dt-center"},
            {targets:2,className: "dt-center"}
        ],
        language: {
            zeroRecords: "Ningun elemento relaciondo"
        }
    });
    $('#proveedor_tabla_aplica').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        ajax: {
            url: "json_proveedor_aplica.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'nombre'},
            {data : 'rfc'},
            {data : 'accion'}
        ],
        rowGroup: {
            //dataSrc: 'grupo'
        },
        columnDefs: [
            //{targets:0, visible:false}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Buscar proveedor...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $('#select_categoria').change(function(){
        var id_categoria = $(this).val();
        $.ajax({
            url: 'json_inventariar_cat.php',
            data:{ id_categoria:id_categoria },
            type: 'POST',
            success:(function(res){
                $('#new_cod_inventario').val(res.cod_articulo);
            })
        });
    });
} );
 function  fecha_actual(){
    $.post('json_now.php',function(res){$('#fecha_asignacion').val(res.fecha_corta);});
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
    $.post('json_propInventario.php',{ cod_articulo: cod_articulo },function(res){
        $("#upd_codigobarra").val(res.cod_barra);
        $('#upd_tipounidad').val(res.tipo_unidad);
        $('#upd_categoria').val(res.nombre_categoria);
        $("#upd_cod_inventario").val(res.cod_articulo);
        $("#upd_descripcion").val(res.descripcion);
        $("#upd_especificacion").val(res.especificacion);
        $("#upd_marca").val(res.marca);
        $("#upd_fecha_adquisicion").val(res.fecha_alta);
        $("#upd_fecha_baja").val(res.fecha_baja);
        $("#upd_tiempo_utilidad").val(res.tiempo_utilidad);
        $("#upd_costo").val(res.costo);
        $("#upd_noinventario").val(res.no_inventario);
        $("#upd_noserie").val(res.no_serie);
        $("#upd_idarticulo").val(res.id_articulo);
        
        if(res.status == 1){
            $("#upd_status").prop("checked", true);
            $("#upd_fecha_baja").val('0000-00-00').prop('disabled',true);
        }
        else{
            $("#upd_status").prop("checked", false);
            $("#upd_fecha_baja").val(res.fecha_baja).prop('disabled',false);
        }
        if(res.disponible == 1){$("#upd_disponible").prop("checked", true);}
        else{$("#upd_disponible").prop("checked", false);}
        if(res.operable == 1){$("#upd_operable").prop("checked", true);}
        else{$("#upd_operable").prop("checked", false);}
        if(res.salida_rapida == 1){$("#upd_salida_rapida").prop("checked", true);}
        else{$("#upd_salida_rapida").prop("checked", false);}
                
    }).done(function() {
        reset_upd_article();
        $("#article_upd").modal("show");
    });
}
function updArticle(){
    var cod_barra     = $("#upd_codigobarra").val(),
        cod_articulo  = $("#upd_cod_inventario").val(),
        id_articulo   = $("#upd_idarticulo").val(),
        descripcion   = $("#upd_descripcion").val(),
        especificacion= $("#upd_especificacion").val(),
        marca         = $("#upd_marca").val(),
        fecha_adquisicion = $("#upd_fecha_adquisicion").val(),
        tiempo_utilidad   = $("#upd_tiempo_utilidad").val(),
        fecha_baja    = $("#upd_fecha_baja").val(),
        costo         = $("#upd_costo").val(),
        no_inventario = $("#upd_noinventario").val(),
        no_serie      = $("#upd_noserie").val(),
        salida_rapida,
        disponible,
        operable,
        status;

        if($("#upd_salida_rapida").is(':checked')) { salida_rapida = 1; 
        } else { salida_rapida = 0; }
        
        if($("#upd_disponible").is(':checked')) { disponible = 1; 
        } else { disponible = 0; }
        
        if($("#upd_operable").is(':checked')) { operable = 1; 
        } else { operable = 0; }
        
        if($("#upd_status").is(':checked')) { status = 1;
        } else { status = 0; } 
    
    $.post('json_update_propActivo.php',{
        cod_articulo:cod_articulo,
        id_articulo:id_articulo,
        cod_barra:cod_barra,
        descripcion:descripcion,
        especificacion:especificacion,
        marca:marca,
        fecha_adquisicion:fecha_adquisicion,
        tiempo_utilidad:tiempo_utilidad,
        fecha_baja:fecha_baja,
        costo:costo,
        no_inventario:no_inventario,
        no_serie:no_serie,
        status:status,
        disponible:disponible,
        operable:operable,
        salida_rapida:salida_rapida
    },function(result){
        if(result[0].result == "exito"){
            refrescarTablaInventario();
            alert("Se guardo correctamente!");
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#form_activo_upd")[0].reset();
        $("#article_upd").modal("hide");
    });
}
function cerrarArticle(){
    $("#form_activo")[0].reset();
    $("#article_new").modal("hide");
}
function cerrarArticle_upd(){
    $("#form_activo_upd")[0].reset();
    $("#article_upd").modal("hide");
}
function get_categoria(){
    $.ajax({
    type: "POST",
    url: 'json_selectCategoria.php',
    data:{ tipo:2 },
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
function get_grupos_activo(e){
    $.ajax({
    url: 'json_selectListMain.php',
    dataType: "json",
    beforeSend: function (xhr){
        $('#grupo_activo').empty();
    },
    success: function(data){
        $.each(data,function(key, registro) {
            $('#grupo_activo').append("<optgroup label='"+registro.main_name+"' id='optg"+registro.id_main+"' class='myoptgroup'></optgroup>");
        });
    },
    error: function(data){
      alert('error');
    },
    complete: (function () {
        get_grupos_activo_XYXY(e);
    })
  });
}
function get_grupos_activo_XYXY(e){
    $.ajax({
    url: 'json_selectGrupoActivo.php',
    dataType: "json",
    beforeSend: function (xhr){
        $('.myoptgroup').empty();
    },
    success: function(data){
        $.each(data,function(key, registro) {
            if(registro.id_grupo_activo == 1){
                $('#optg'+registro.id_main).append("<option value='"+registro.id_grupo_activo+"'>(Ningun Grupo)</option>");
            }else{
                $('#optg'+registro.id_main).append("<option value='"+registro.id_grupo_activo+"'>"+registro.grupo_nombre+"</option>");
            }
            
        });
        var id = e.target.id;
        var id_grupo = $("#"+id).data("idgrupo");
        var cod_articulo = $("#"+id).data("codarticulo");
        $("#cod_articulo_move").html(cod_articulo);
        if(id_grupo > 1 ){
            $("#grupo_activo option[value='" + id_grupo + "']").attr("selected", "selected");
        }
    },
    error: function(data){
      alert('error');
    }
  });
    
}
function close_alert2(){
    $('#msj_alert2').hide();
}
function hide_showNewMovimiento(){
    $("#cardnewtraza" ).toggle("fast","swing");
    $("#btnmouestranewpro" ).toggle("fast","swing");
    $("#formnewtraza")[0].reset();
    close_alert2();
}
function hide_showModalNewProv(){
    $("#modal_trazabilidad" ).modal("hide");
    $("#btnmouestranewpro" ).show();
    $("#formnewtraza")[0].reset();
    close_alert2();
}
function guarda_new_prov(){
    if (confirm('¿Guardar los cambios realizado al Nuevo Proveedor?')) {
        var cod_articulo = $("#mov_codarticulo").val();
        var fecha_movimiento = $("#mov_fecha_movimiento").val();
        var motivo = $("#mov_motivo").val();
        var responsable = $("#mov_responsable").val();
        var ubicacion = $("#mov_ubicacion").val();
        var condicion = $("#mov_condicion").val();

        $.ajax({
            data:{fecha_movimiento:fecha_movimiento,motivo:motivo,responsable:responsable,ubicacion:ubicacion,condicion:condicion,cod_articulo:cod_articulo},
            url: 'json_set_newTrazabilidad.php',
            type: 'POST',
            success:(function(res){
                if(res[0].result == "vacio"){
                    $('#msj_alert2').show(200);
                }else if(res[0].result == true){
                    alert("Se guardo exitosamente");
                    openTrazabilidadLoad(cod_articulo);
                    hide_showNewMovimiento();
                }else if(res[0].result == false){
                    alert("Error al guardar");
                }
            })
        });
    }
}

function openTrazabilidad(e){
    var id = e.target.id;
    var cod_articulo = $("#"+id).data("codarticulo");
    openTrazabilidadLoad(cod_articulo);
    $("#modal_trazabilidad").modal("show");
}
function openTrazabilidadLoad(cod_articulo){
    var t = $('#movimiento_tabla_aplica').DataTable();
    $.ajax({
        data:{cod_articulo:cod_articulo},
        url: 'json_movimiento_aplica.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw();
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.ubicacion,
                    value.fecha,
                    value.responsable,
                    value.condicion
                ]).node().id = value.id_traza;
                t.draw( false );
            });
        },
        complete: (function () {
            $("#mov_codarticulo").val(cod_articulo);
        })
    });
}
function inventario_new(){
    reset_new_article();
    $("#article_new").modal("show");
}
function reset_new_article(){
    $("#select_categoria").prop("disabled",false);
    $("#form_activo")[0].reset();
    $('#set_activo').show();
    $('#upd_activo').hide();
}
function reset_upd_article(){
    $("#select_categoria").prop("disabled",true);
    $('#set_activo').hide();
    $('#upd_activo').show();
}
function setArticle(){
    var cod_barra     = $("#new_codigobarra").val(),
        cod_articulo  = $("#new_cod_inventario").val(),
        tipo_unidad   = $('#new_tipounidad').val(),
        id_categoria  = $('#select_categoria').val(),
        descripcion   = $("#new_descripcion").val(),
        especificacion= $("#new_especificacion").val(),
        marca         = $("#new_marca").val(),
        fecha_adquisicion = $("#new_fecha_adquisicion").val(),
        tiempo_utilidad   = $("#new_tiempo_utilidad").val(),
        costo         = $("#new_costo").val(),
        no_inventario = $("#new_noinventario").val(),
        no_serie      = $("#new_noserie").val(),
        salida_rapida,
        disponible,
        operable,
        status;

        if($("#new_salida_rapida").is(':checked')) { salida_rapida = 1; 
        } else { salida_rapida = 0; }
        
        if($("#new_disponible").is(':checked')) { disponible = 1; 
        } else { disponible = 0; }
        
        if($("#new_operable").is(':checked')) { operable = 1; 
        } else { operable = 0; }
        
        if($("#new_status").is(':checked')) { status = 1;
        } else { status = 0; } 
    
    $.post('json_insert_propActivo.php',{
        cod_articulo:cod_articulo,
        cod_barra:cod_barra,
        descripcion:descripcion,
        especificacion:especificacion,
        tipo_unidad:tipo_unidad,
        marca:marca,
        id_categoria:id_categoria,
        fecha_adquisicion:fecha_adquisicion,
        tiempo_utilidad:tiempo_utilidad,
        costo:costo,
        no_inventario:no_inventario,
        no_serie:no_serie,
        status:status,
        disponible:disponible,
        operable:operable,
        salida_rapida:salida_rapida
    },function(result){
        if(result[0].result == "exito"){
            refrescarTablaInventario();
            alert("Se guardo correctamente!");
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#form_activo")[0].reset();
        $("#article_new").modal("hide");
    });
}
function openModalFacturaDetail(e){
    var obj = e.target;
    var id_factura = $(obj).data('idfactura');
    getFacturaDetail(id_factura);
    getFacturaDetail_list(id_factura);   
}
function getFacturaDetail(id_factura){
    $.ajax({
        data:{id_factura:id_factura},
        url: 'json_selectFacturaInf.php',
        type: 'POST',
        beforeSend: function (xhr){
            console.log("Actualizando..." + id_factura);
        },
        success: function (obj) {
            var data = obj[0];
            
            $("#view_date_insert").html(data.date_insert);
            $("#view_fecha_emision").html(data.fecha_emision);
            $("#view_lugar_emision").html(data.lugar_emision);
            $("#view_nombre").html(data.nombre);
            $("#view_rfc").html(data.rfc);
            $("#view_direccion").html(data.direccion);
            $("#view_num_telefono").html(data.num_telefono);
            $("#view_email").html(data.email);
            $("#view_pagina_web").html(data.pagina_web);
            $("#view_serie_folio").html(data.serie_folio);
            $("#view_uuid").html(data.uuid);
            $("#view_total").html(data.total);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function getFacturaDetail_list(id_factura){
    var t = $('#table_DetailDocumento').DataTable();
    $.ajax({
        data:{id_factura:id_factura},
        url: 'json_selectFacturaInfDetail.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw();
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.articulo,
                    value.cantidad,
                    value.unidad,
                    value.precio_unidad,
                    value.total
                ]);
                t.draw( false );
                console.log("Agrego: "+index);
            });
        },
        complete: (function () {
            $('#invoice').modal('show');
        })
    });
}
function exitDetailFactura(){
    $('#invoice').modal('hide');
    $("#view_date_insert").html("");
    $("#view_fecha_emision").html("");
    $("#view_lugar_emision").html("");
    $("#view_nombre").html("");
    $("#view_rfc").html("");
    $("#view_direccion").html("");
    $("#view_num_telefono").html("");
    $("#view_email").html("");
    $("#view_pagina_web").html("");
    $("#view_serie_folio").html("");
    $("#view_uuid").html("");
    $("#view_total").html("");
    var t = $('#table_DetailDocumento').DataTable();
    t.clear().draw();
}
function add_documento(){
    if (confirm('¿Guardar los cambios realizados?')) {
        
        var serie_folio = $("#add_serie_folio").val();
        var fecha_emision = $("#add_fecha_emision").val();
        var lugar_emision = $("#add_lugar_emision").val();
        var uuid = $("#add_uuid").val();
        var total = $("#total").data("total");
        var id_proveedor = $("#rfc").data("idproveedor");
        
        $.ajax({
            data:{serie_folio:serie_folio,fecha_emision:fecha_emision,lugar_emision:lugar_emision,uuid:uuid,total:total,id_proveedor:id_proveedor},
            url: 'json_addDocumento.php',
            type: 'POST',
            success:(function(res){
                if(res.stat == "ok"){
                    console.log("ok:" + res.result);
                    recorreDataTable(res.result);
                }else if(res.stat == "fail"){
                    console.log("Pr:" + $("#rfc").data("idproveedor"));
                    console.log("fail");
                }
            })
        });
    } else {
        alert('NO confirmado');
    }
}
function guardaPedido(cod_articulo, cantidad,precio_unidad,total,id_factura){
    $.ajax({
        data:{cantidad:cantidad, precio_unidad:precio_unidad, total:total, id_factura:id_factura, cod_articulo:cod_articulo},
        type: 'post',
        url: 'json_addDocumento_detail.php',
        dataType: 'json',
        success: function(data){
            //$.each(data,function(key, registro){
            //});
            if(data.stat == "ok"){
                console.log('add:' + cod_articulo + ', OK');
            }else{
                console.log('Fail add:' + cod_articulo + ', ERROR');
            }
        },
        error: function(data){
          console.log('error'+data);
        }
    });
}
function get_proveedor(e){
    var obj = e.target;
    var id = $(obj).data('id');
    var nombre = $(obj).data('nombre');
    var rfc = $(obj).data('rfc');
    $("#rfc").val(rfc);
    $("#rfc").data("idproveedor",id);
    $("#nombreempresa").val(nombre);
}

function selectItems(e){
    
}
function main_clasificados(){
    $.ajax({
        url: 'json_selectListMain.php',
        beforeSend: function (xhr){
            $(".all-main").remove();
        },
        success: function (res) {
            $.each(res, function (index, value) {//value.nombre
                $("#card_filtro").after(value.main);
                $("#grupo_main").append("<option value='"+value.id_main+"'>"+value.main_name+"</option>");
                $("#grupo_main_edit").append("<option value='"+value.id_main+"'>"+value.main_name+"</option>");
            });
        },
        complete: (function () {
            grupos_clasificados();
        })
    });
 }
function grupos_clasificados(){
    $.ajax({
        url: 'json_selectListGrupos.php',
        beforeSend: function (xhr){
            $(".misgrupos").empty();
        },
        success: function (res) {
            $.each(res, function (index, value) {//value.nombre
                $(".main-"+value.id_main).append(value.menu);
            });
        },
        complete: (function () {
            
        })
    });
 }
 function main_group(){
    $.ajax({
        url: 'json_selectListMain.php',
        beforeSend: function (xhr){
            $(".all-main").remove();
        },
        success: function (res) {
            $.each(res, function (index, value) {//value.nombre
                $("#card_filtro").before(value.main);
                $("#grupo_main").append("<option value='"+value.id_main+"'>"+value.main_name+"</option>");
            });
        },
        complete: (function () {
            grupos_clasificados();
        })
    });
 }
 function colapsed(id){
     $(".card-id"+id).slideToggle('fast');
 }
function abre_grupo(){
    $("#modal_grupo").modal("show");
}
function nuevo_cancel(){
    $("#modal_grupo").modal("hide");
}
function nuevo_guarda(){
    var nuevo_grupo = $("#nuevo_grupo").val();
    var id_main = $("#grupo_main").val();
    $.post('json_nuevo_grupo.php',{
        nuevo_grupo:nuevo_grupo,id_main:id_main
    },function(result){
        if(result[0].type == "exito"){
            grupos_clasificados();
        }else{
            alert("Ocurrio realizar la operación. "+result[0].type);
        }
        
    }).done(function() {
        $("#modal_grupo").modal("hide");
    });
}
function load_main(){
    $("#filtro").val("").trigger('change');
    $(".subgrupos").removeClass("font-weight-bold active");
    $(".icono-grupo").removeClass("icon-folder-open").addClass("icon-folder2");
}
function load_main_baja(){
    $("#filtro").val("WHERE status = 0").trigger('change');
    $(".subgrupos").removeClass("font-weight-bold active");
    $(".icono-grupo").removeClass("icon-folder-open").addClass("icon-folder2");
}
function load_main_disponible(){
    $("#filtro").val("WHERE status = 1 AND disponible = 1").trigger('change');
    $(".subgrupos").removeClass("font-weight-bold active");
    $(".icono-grupo").removeClass("icon-folder-open").addClass("icon-folder2");
}
function load_main_grupos(e){
    $(".subgrupos").removeClass("font-weight-bold active");
    $(".icono-grupo").removeClass("icon-folder-open").addClass("icon-folder2");
    
    var obj = e.target;
    var idicon = $(obj).data("idgrupo");
    $(obj).addClass("font-weight-bold active");
    $("#"+idicon+"i").removeClass("icon-folder2").addClass("icon-folder-open");
    
    $("#filtro").val("WHERE id_grupo_activo = " + idicon ).trigger('change');
}
function mofificar_grupo(e){
    get_grupos_activo(e);
    $("#modal_asignar_grupo").modal("show");
}
function cerrar_modalMover(){
    $("#modal_asignar_grupo").modal("hide");
}
function mover_a_grupo(){
    var id_grupo_activo = $("#grupo_activo").val();
    var cod_articulo = $("#cod_articulo_move").html();
    $.post('json_grupo_mover.php',{
        id_grupo_activo:id_grupo_activo,cod_articulo:cod_articulo
    },function(result){
        if(result[0].type == "exito"){
            console.log("Movimiento exitoso!");
        }else{
            alert("Ocurrio realizar la operación. "+result[0].type);
        }        
    }).done(function() {
        refrescarTablaInventario();
        grupos_clasificados();
        cerrar_modalMover();
    });
}
function hola(e){
    var obj = e.target;
    var idgrupo = $(obj).data("idgrupo");
    var idmain = $(obj).data("idmain");
    var grupo = $(obj).data("grupo");
    
    $("#modifica_grupo").data("idgrupo",idgrupo);
    $("#modifica_grupo").data("idmain",idmain);
    $("#modifica_grupo").data("grupo",grupo);
    $("#modifica_grupo").val(grupo);
    $("#grupo_main_edit").val(idmain).trigger('change');
    $("#modal_modificar_grupo").modal("show");
}
function modal_grupo_edita_cierra(){
    $("#grupo_main_edit").val(null).trigger('change');
    $("#modal_modificar_grupo").modal("hide");
}
function guardar_cambio_grupo(){
    var id_grupo = $("#modifica_grupo").data("idgrupo");
    var id_main  = $("#grupo_main_edit").val();
    var grupo = $("#modifica_grupo").val();
    edita_grupo("upd",id_grupo,id_main,grupo);
}
function guardar_elimina_grupo(){
    var id_grupo = $("#modifica_grupo").data("idgrupo");
    var grupo = $("#modifica_grupo").val();
    if (confirm('¿Está de seguro de eliminar el grupo?')) {
        edita_grupo("del",id_grupo,0,grupo);
    }
}
function edita_grupo(tipo,id_grupo,id_main,grupo){
    $.post('json_edita_grupo.php',{
        id_grupo:id_grupo,grupo:grupo,tipo:tipo,id_main:id_main
    },function(result){
        if(result[0].type == "exito"){
            console.log("Operación exitosa!");
        }else{
            alert("Ocurrio realizar la operación. "+result[0].type);
        }
    }).done(function() {
        refrescarTablaInventario();
        grupos_clasificados();
        modal_grupo_edita_cierra();
    });
}
function abre_traza_multi(){
    $("#modal_trazabilidad_multi").modal("show");
}
function cierra_traza_multi(){
    $("#modal_trazabilidad_multi").modal("hide");
}
function abre_modal_asigna(e){
    var id = e.target.id;
    var cod_articulo = $("#"+id).data("codarticulo");
    var equipo = $("#"+id).data("descripcion");
    
    $("#cod_articulo_asignar").val(cod_articulo);
    $("#cod_articulo_asignar").data("equipo",equipo);
    $("#modal_asignacion").modal("show");
}
function cierra_modal_asigna(){
    $("#modal_asignacion").modal("hide");
}
function asignar_operacion(){
    var cod_articulo = $("#cod_articulo_asignar").val();
    var equipo_asigna = $("#cod_articulo_asignar").data("equipo");
    var id_empleado  = $("#asigna_empleado").val();
    var fecha = $('#fecha_asignacion').val();
        
    var data = $('#asigna_empleado').select2('data');
    //alert(data[0].text);
    //alert(data[0].id);
    
    if(id_empleado > 0){
        if (confirm('Asignar : "' + equipo_asigna + '" a ' + data[0].text + ',\n\n¿Continuar con la operación?')) {
            guardaAsignacion(cod_articulo,fecha,id_empleado);
        }
    }
}
function guardaAsignacion(cod_articulo,fecha,id_empleado){
    $.ajax({
        data:{cod_articulo:cod_articulo,fecha:fecha,id_empleado:id_empleado},
        url: 'json_insertAsignacion.php',
        type: 'POST',
        success:(function(res){
            if(res[0].result == "exito"){
                console.log("exito:" + res[0].result);
                alert("La asignación se generó correctamente!");
                refrescarTablaInventario();
                cierra_modal_asigna();
            }else if(res[0].result == "no guardo"){
                console.log("no guardo");
                alert("Ocurrio un error al guardar la información. Revise que el formulario sea llenado correctamente.");
            }
        })
    });
}
 function empleado_list(){
    $.ajax({
        url: 'json_selectListEmpleado.php',
        beforeSend: function (xhr){
            $(".empleados").empty();
            $("#asigna_empleado").append("<option value='0'>&nbsp;</option>");
        },
        success: function (res) {
            $.each(res, function (index, value) {//value.nombre
                $("#asigna_empleado").append("<option value='"+value.id_empleado+"'>"+value.nombre+"</option>");
            });
        },
        complete: (function () {
            
        })
    });
 }
 function refrescarTablaInventario(){
    var table = $('#almacen_tabla').DataTable();
    table.ajax.reload();
 }