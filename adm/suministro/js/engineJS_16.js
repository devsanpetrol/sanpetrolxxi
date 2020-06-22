$(document).ready( function () {
    $("body").addClass("sidebar-xs");
    $(".almacen_salida").addClass("active");
    $(".almacen_salida i").addClass("text-orange-800");
    $('#datatable_almacen_salida').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        processing: true,
        dom: '<"datatable-scroll-wrap"t><"datatable-footer"i>',
        ajax: {
            url: 'json_selectAlmacenPase.php',
            dataSrc:function ( json ) {
                return json;
            }
        },
        createdRow: function ( row, data, index ) {
            //$(row).attr("id","id_row_"+data[6]);
            $(row).addClass('pointer font-weight-semibold text-primary-800');
        },
        columns: [
            {data : 'folio'},
            {data : 'fecha'},
            {data : 'nombre_generico'},
            {data : 'nombre_solicitante'},
            {data : 'avance'},
            {data : 'status'}
        ],
        columnDefs: [
            {targets: 0, width: '5%',className:'text-center'},
            {targets: 1, width: '15%',className:'text-center'},
            {targets: 2, width: '35%'},
            {targets: 3, width: '20%'},
            {targets: 3, width: '20%'},
            {targets: 4, width: '5%',className:'text-center'}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        }
    });
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        info: false,
        createdRow: function ( row, data, index ){
            if(data[1] == ""){
                $(row).addClass('pointer font-weight-semibold text-blue-800');
            }else{
                $(row).addClass('pointer font-weight-semibold text-slate-300');
            }
        },
        columnDefs: [
            {targets:0,className: "dt-center"}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
        }
    });
    $("#i_codigobarra").on('keyup', function (e) {
        if (e.keyCode === 13) {
           $('#i_cantidad').val(1);
           addElementToTable();
        }
    });
    $("#i_codigoinventario").on('keyup', function (e) {
        if (e.keyCode === 13) {
           $('#i_cantidad').focus();
        }
    });
    $("#i_cantidad").on('keyup', function (e) {
        if (e.keyCode === 13) {
           addElementToTable();
        }
    });
} );

function agrega_pase(){
    var tabla = $('#datatable_almacen_salida').DataTable();
    $.ajax({
        url: 'json_selectAlmacenPase.php',
        type: 'POST',
        success:(function(res){
            $.each(res,function(key, registro){
                tabla.row.add( [
                    registro.folio,
                    registro.fecha,
                    registro.nombre_generico,
                    registro.nombre_solicitante,
                    registro.avance,
                    registro.status
                ] ).draw( false );
            });
        })
    });
}
 function  fecha_actual(){
    $.post('json_now.php',function(res){$('#num_folio_vale_salida').text(getFolio(res.fecha_actual));});
 }
 function openModalSolicitudDetail(folio){
    getSolicitudDetail(folio);
    getSolicitudDetail_pedido(folio);
    $("#card_almacen_pase").toggle(400);
    $("#card_solicitud_detail").toggle(400);
}
function closeModalSolicitudDetail(){
    var table_pedido = $('#tabla_pedidos').DataTable();
    $("#card_almacen_pase").toggle(400).promise().done(function(){$('#datatable_almacen_salida').DataTable().ajax.reload();});
    $("#card_solicitud_detail").toggle(400);
    
}
function getSolicitudDetail(folio){
    $.ajax({
        data:{folio:folio},
        url: 'json_selectSolicitudDetail.php',
        type: 'POST',
        beforeSend: function (xhr){
            console.log("Actualizando...");
        },
        success: function (obj) {
            var data = obj[0];
            $("#solicitante").html(data.nombre_solicitante + " ("+ data.puesto_solicitante + ")");
            $("#area_aquipo").html(data.nombre_generico + ", " + data.sitio_operacion);
            $("#fecha_actual").html(data.fecha);
            $("#name_coordinacion").html(data.coordinacion_up + ":");
            $("#modal_large").data("idequipo",data.id_equipo);
            
            if(data.firm_planeacion == 0){
                $("#firm_planeacion")
                    .removeClass("badge-info badge-danger")
                    .addClass("border-primary-300 alpha-primary text-primary-800")
                    .data({idempleado:data.firm_planeacion,nuevafirma:""})
                    .text("Firmar solicitud");
            }else{
                $("#firm_planeacion")
                    .removeClass("badge-danger border-primary-300 alpha-primary text-primary-800")
                    .addClass("badge-info")
                    .data({idempleado:data.firm_planeacion,nuevafirma:""})
                    .text("Revisado");
            }
            
            if(data.firm_coordinacion == 0){
                $("#firm_coordinacion")
                    .removeClass("badge-info bg-orange")
                    .addClass("bg-orange")
                    .text("Pendiente");
            }else{
                $("#firm_coordinacion")
                    .removeClass("bg-orange badge-info")
                    .addClass("badge-info")
                    .text("Revisado");
            }
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function getSolicitudDetail_pedido(folio){
    var t = $('#tabla_pedidos').DataTable();
    $('#tabla_pedidos').data("folio",folio);
    $.ajax({
        data:{folio:folio},
        url: 'json_selectSolicitudDetail_pedidos_salida.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw(false);
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.cantidad,
                    value.cantidad_surtir,
                    value.unidad,
                    value.articulo,
                    value.status_pedido,
                    value.justificacion
                ]).node().id = value.id_pedido;
                t.draw( false );
            });
        },
        complete: (function () {
            
        })
    });
    
    
}
function addElementToTable(){
    var cantidad = parseFloat($("#i_cantidad").val());
    var cod_barra = $("#i_codigobarra").val();
    var cod_inventario = $("#i_codigoinventario").val();
    
    var cantidad_init = parseFloat($("."+cod_inventario).val());
    var cantidad_total = cantidad_init + cantidad;
    var maximo = $("."+cod_inventario).data("maximo");
    var id_pedido = $("."+cod_inventario).data("idpedido");
    
    if( cantidad_total > 0 && cantidad_total <= maximo){
        $("#"+id_pedido).addClass("text-warning-800").removeClass("text-slate-300");
        $("."+cod_inventario).val(cantidad_total);
        reset_addCodigo();
    }else if(cantidad_total == 0){
        $("#"+id_pedido).removeClass("text-warning-800").addClass("text-slate-300");
        $("."+cod_inventario).val(cantidad_total);
        reset_addCodigo();
    }else{
        alert("La cantidad asignada excede el maximo permitido. Intente nuevamente");
    }
}
function reset_addCodigo(){
    $("#i_cantidad").val("");
    $("#i_codigobarra").val("");
    $("#i_codigoinventario").val("");
}
function guarda_valesalida(){
    var folio = $("#tabla_pedidos").data("folio");
    if($(".input-cantidad-surtir").length > 0){
        $.ajax({
            data:{folio:folio},
            url: 'json_addValesalida.php',
            type: 'POST',
            success:(function(res){
                if(res.result > 0){
                    $("#folio_vale").html(res.result);
                    guarda_itemsentrega();
                }else{
                   alert("Ocurrio un error al guardar la informació"); 
                }
            }),
            complete: (function () {
                 $("#btn_envia_guarda_valesalida").attr("disabled",true);
            })
        });
    }else{
        alert("No hay elementos pendientes por procesar.");
    }
}
function guarda_itemsentrega(){
    $(".input-cantidad-surtir").each(function(){
           var folio_vale  = $("#folio_vale").html();
           var idpedido    = $(this).data("idpedido");
           var codarticulo = $(this).data("codarticulo");
           var cant_surtir = parseInt($(this).val());
           
           if( cant_surtir > 0 ){
                $.ajax({
                   data:{folio_vale:folio_vale,idpedido:idpedido,codarticulo:codarticulo,cant_surtir:cant_surtir},
                   url: 'json_insert_valesalida_detail.php',
                   type: 'POST',
                   success:(function(res){
                       if(res.result == "exito"){

                       }else{

                       }
                   })
                });
           }
        });
 }