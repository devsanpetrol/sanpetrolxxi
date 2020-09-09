$(document).ready( function () {
    get_categoria();
    $('.form-control-select2').select2();
    $("body").addClass("sidebar-xs");
    $(".inventario").addClass("active");
    $(".inventario i").addClass("text-orange-800");
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        ajax: {
            url: "json_selectInventario.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columnDefs: [
            //{targets:5,className: "text-center"}
        ],
        columns: [
            {data : 'cod_articulo'},
            {data : 'no_inventario'},
            {data : 'descripcion'},
            {data : 'status'},
            {data : 'disponible'},
            {data : 'operable'},
            {data : 'costo'},
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
} );
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
    $.post('json_propInventario.php',{ cod_articulo: cod_articulo },function(res){
        //res[0].status,
        $("#new_codigobarra").val(res.cod_barra);
        $("#new_cod_inventario").val(res.cod_articulo);
        $('#new_tipounidad option[value='+res.tipo_unidad+']').prop('selected', 'selected').change();
        $('#select_categoria option[value='+res.id_categoria+']').prop('selected', 'selected').change();
        $("#new_descripcion").val(res.descripcion);
        $("#new_especificacion").val(res.especificacion);
        $("#new_marca").val(res.marca);
        $("#new_fecha_adquisicion").val(res.fecha_alta);
        $("#new_fecha_baja").val(res.fecha_baja);
        $("#new_tiempo_utilidad").val(res.tiempo_utilidad);
        $("#new_costo").val(res.costo);
        $("#new_noinventario").val(res.no_inventario);
        $("#new_noserie").val(res.no_serie);
        $("#new_idarticulo").val(res.id_articulo);
        
        if(res.status == 1){
            $("#new_status").prop("checked", true);
            $("#new_fecha_baja").val('000-00-00').prop('disabled','disabled');
        }
        else{
            $("#new_status").prop("checked", false);
            $("#new_fecha_baja").val(res.fecha_baja).prop('disabled',false);
        }
        if(res.disponible == 1){$("#new_disponible").prop("checked", true);}
        else{$("#new_disponible").prop("checked", false);}
        if(res.operable == 1){$("#new_operable").prop("checked", true);}
        else{$("#new_operable").prop("checked", false);}
        if(res.salida_rapida == 1){$("#new_salida_rapida").prop("checked", true);}
        else{$("#new_salida_rapida").prop("checked", false);}
        
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
        id_articulo   = $("#new_idarticulo").val(),
        tipo_unidad   = $('#new_tipounidad').val(),
        id_categoria  = $('#select_categoria').val(),
        descripcion   = $("#new_descripcion").val(),
        especificacion= $("#new_especificacion").val(),
        marca         = $("#new_marca").val(),
        fecha_adquisicion = $("#new_fecha_adquisicion").val(),
        tiempo_utilidad   = $("#new_tiempo_utilidad").val(),
        fecha_baja    = $("#new_fecha_baja").val(),
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
    
    $.post('json_update_propActivo.php',{
        cod_articulo:cod_articulo,
        id_articulo:id_articulo,
        cod_barra:cod_barra,
        descripcion:descripcion,
        especificacion:especificacion,
        tipo_unidad:tipo_unidad,
        marca:marca,
        id_categoria:id_categoria,
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
            var table = $("#almacen_tabla").DataTable();
            table.ajax.reload();
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
    $("#cardnewtraza" ).modal("hide");
    $("#btnmouestranewpro" ).show();
    $("#formnewtraza")[0].reset();
    close_alert2();
}
function guarda_new_prov(){
    if (confirm('¿Guardar los cambios realizado al Nuevo Proveedor?')) {
        var rfc = $("#new_rfc").val();
        var nombre = $("#new_nombre").val();
        var direccion = $("#new_direccion").val();
        var num_telefono = $("#new_num_telefono").val();
        var email = $("#new_email").val();
        var pagina_web = $("#new_pagina_web").val();
        var actividad_comercial = $("#new_actividad_comercial").val();

        $.ajax({
            data:{rfc:rfc,nombre:nombre,direccion:direccion,num_telefono:num_telefono,email:email,pagina_web:pagina_web,actividad_comercial:actividad_comercial},
            url: 'json_set_newprov.php',
            type: 'POST',
            success:(function(res){
                if(res[0].result == "vacio"){
                    $('#msj_alert2').show(200);
                }else if(res[0].result == true){
                    alert("Se guardo exitosamente");
                    var table = $('#proveedor_tabla_aplica').DataTable();
                    table.ajax.reload();
                    hide_showNewProveedor();
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
            $("#modal_trazabilidad").modal("show");
        })
    });
}