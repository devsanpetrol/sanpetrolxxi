$(document).ready( function () {
    $(".nuevas-entradas-inbox").hide();
    $(".almacen_salida_aprobada").addClass("active");
    $(".almacen_salida_aprobada i").addClass("text-orange-800");
    $('#datatable_almacen_salida').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        processing: true,
        dom: '<"datatable-scroll-wrap"t><"datatable-footer"i>',
        ajax: {
            url: 'json_selectAlmacenValeSalida.php',
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
            {data : 'status_valesalida'},
            {data : 'destino'},
            {data : 'nombre_solicitante'},
            {data : 'recibe'},
            {data : 'accion'}
        ],
        columnDefs: [
            {targets: 0, width: '5%',className:'text-center'},
            {targets: 1, width: '15%',className:'text-center'},
            {targets: 2, width: '5%'},
            {targets: 3, width: '30%'},
            {targets: 4, width: '20%'},
            {targets: 5, width: '20%'},
            {targets: 6, width: '5%',className:'text-center'}
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
            $(row).addClass('pointer font-weight-semibold text-slate-800');
        },
        columnDefs: [
            {targets:2,className: "dt-center"},
            {targets:3,className: "dt-center"},
            {targets:5,className: "dt-center",visible: false}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
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
    reset_modal();
    $("#card_almacen_pase").toggle(400).promise().done(function(){
        $('#datatable_almacen_salida').DataTable().ajax.reload();
    });
    $("#card_solicitud_detail").toggle(400);
    
}
function getSolicitudDetail(folio){
    $.ajax({
        data:{folio:folio},
        url: 'json_selectSolicitudDetail_valesalida.php',
        type: 'POST',
        beforeSend: function (xhr){
            console.log("Actualizando...");
        },
        success: function (obj) {
            var data = obj[0];
            $("#solicitante").html(data.nombre_solicitante + " ("+ data.puesto_solicitante + ")");
            $("#area_aquipo").html(data.nombre_generico + ", " + data.sitio_operacion);
            $("#folio_vale").html(data.folio_vale_salida);
            $("#recibio_surtido").html(data.recibe);
            if(data.status_valesalida == 0){
                $("#s_pendiente").show();
                $("#s_completado").hide();
                $("#guarda_cambios_solicitud").show();
            }else if(data.status_valesalida == 1){
                $("#s_pendiente").hide();
                $("#s_completado").show();
                $("#guarda_cambios_solicitud").hide();
            }
            
            
            $("#modal_large").data("idequipo",data.id_equipo);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function getSolicitudDetail_pedido(folio){
    $('#tabla_pedidos').data("folio",folio);
    rellenaTablaPedidos();
    
}
function rellenaTablaPedidos(){
    var t = $('#tabla_pedidos').DataTable();
    var folio = $("#tabla_pedidos").data("folio");
    $.ajax({
        data:{folio:folio},
        url: 'json_selectSolicitudDetail_pedidos_valesalida.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw(false);
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.articulo,
                    value.justificacion,
                    value.cantidad_surtida,
                    value.unidad,
                    value.recibe,
                    value.status_surtido
                ]).node().id = value.id_pedido;
                t.draw( false );
            });
        }
    });
}
function guarda_valesalida(){
    var folio = $("#tabla_pedidos").data("folio");
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
}
function guarda_itemsentrega(){
    if (confirm('¿Desea finalizar esta entrega?')) {
        $("#btn_envia_guarda_valesalida").attr("disabled",true);
        var folio_vale_salida = $("#folio_vale").html();
        var recibe_vale = $("#nombre_recibe").val();
        var status_vale = 1
        $(".input-recibidores").each(function(){
            var idpedidovalesalida = $(this).data("idpedidovalesalida");
            var recibe = $(this).val();
            var status  = 1;

            $.ajax({
                data:{idpedidovalesalida:idpedidovalesalida,recibe:recibe,status:status},
                url: 'json_updateValeSalida_status.php',
                type: 'POST',
                success:(function(res){
                    if(res[0].result == "exito"){
                        console.log("Finalizó con exito!: idpedidovalesalida = " + idpedidovalesalida);
                    }else{
                        console.log("Oh! oh!... ocurrió un error. idpedidovalesalida = " + idpedidovalesalida);
                    }
                })
            });
         }).promise().done(function () {
            $.ajax({
                data:{folio_vale_salida:folio_vale_salida,recibe_vale:recibe_vale,status_vale:status_vale},
                url: 'json_updateValeSalida_status_vale.php',
                type: 'POST',
                success:(function(res){
                    if(res[0].result == "exito"){
                        console.log("Finalizó con exito!: folio_vale_salida_vale = " + folio_vale_salida);
                    }else{
                        console.log("Oh! oh!... ocurrió un error. folio_vale_salida_vale = " + folio_vale_salida);
                    }
                }),
                complete: (function () {
                    rellenaTablaPedidos();
                    alert("Proceso finalizado");
                })
            });
        });
    }
    
 }
 function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}
function mybind(event){
    var regex = new RegExp("^[0-9 ]|[\.]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
}
function reset_modal(){
    $("#recibio_surtido").html("");
    $("#nombre_recibe").val("");
}
function imprimir(){
   var folio_vale = $("#folio_vale").html();
    windows.open("print_vale_salida.php?folio_vale="+folio_vale); 
}
function envia(){
    var folio_vale = $("#folio_vale").html();
    $.post('print_vale_salida.php', { folio_vale: folio_vale }, function (result) {
        WinId = window.open('', 'newwin', 'width=800,height=500');//resolucion de la ventana
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}