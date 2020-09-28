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
            var table = $("#almacen_tabla").DataTable();
            table.ajax.reload();
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
            var table = $("#almacen_tabla").DataTable();
            table.ajax.reload();
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