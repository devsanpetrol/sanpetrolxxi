$(document).ready( function () {
    var user_session_id = $('#user_session_id').data("employeid");
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ){
            $(row).addClass('pointer font-weight-semibold text-grey');
        },
        columnDefs: [
            {targets:0,className: "dt-center"},
            {targets:1,className: "dt-center"}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
        }
    });
    
    $('#lay_out_solicitudesx').DataTable({
        paging: false,
        ordering: false,
        bDestroy: true,
        processing: true,
        selected: true,
        serverSide: true,
        dom: '<"datatable-scroll-wrap"t>',
        ajax: {
            url: "json_selectSolicitudBandeja.php",
            data:{user_session_id:user_session_id},
            type: 'POST',
            dataSrc:function ( json ) {
                return json;
            }
        },
        createdRow: function ( row, data, index ) {
            $(row).attr('id',data['folio']);
            //if(data['leido'] == "0"){
                $(row).addClass('unread');
                $(row).css("cursor","pointer");
            //}
            
            $(row).data('scroll');
            $('td', row).eq(0).addClass('table-inbox-name');
            $('td', row).eq(1).addClass('table-inbox-message');
            $('td', row).eq(2).addClass('table-inbox-time');
        },
        columns: [
            {data : 'solicita'},
            {data : 'pedidos'},
            {data : 'fecha'}
        ],
        columnDefs: [
            {targets: 0,width: '30%'},
            {targets: 1,width: '50%'},
            {targets: 2,width: '20%'}
        ],
        language: {
            zeroRecords: "Ningun elemento seleccionado"
        }
    });

    $('#lay_out_solicitudesx tbody').on('click', 'tr', function () {
        var folio = this.id;
        openModalSolicitudDetail(folio);
        return false;
    } );
    
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        table.row('.selected').remove().draw( false );
        $("#btn_del_row_sel").slideUp();
    } );
    
    $('#btn_send_pedido').on('click', function () {});
    
    $('#buscar_en_tabla_layoutx').on( 'change paste keyup', function () {
        var table = $('#lay_out_solicitudesx').DataTable();
        table
            .search( this.value )
            .draw();
    });
    
} );
function  no_read_inbox(){
    $.post('json_count_no_read_inbox.php',function(res){
        var count = parseInt(res.noread), badge = $(".nuevas-entradas-inbox");
        if(count >= 100){
            badge.text("99+").removeClass("bg-success").addClass("bg-danger");
            badge.show();
        }else if(count > 0 && count < 100){
            badge.text(count).removeClass("bg-danger").addClass("bg-success");
            badge.show();            
        }else{
            badge.hide();
        }
    });
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
function set_list_resp(id_empleado,nombre,apellidos){
    var apellidos_ = apellidos.replace(/ /g, "");
    $('.'+apellidos_+id_empleado).remove();
    $('#flex ul').append(
        $('<li>').addClass(apellidos_+id_empleado).append("<button type='button' class='btn btn-success btn-sm' ><i class='fa fa-user'></i> "+nombre+" "+apellidos+" <i class='fa fa-check-circle-o'></i></button>")
    );
}
function save_cantidad(id_pedido){
    var cantidad = $("#cantidad_"+id_pedido).val();
    $.ajax({
        data:{id_pedido:id_pedido,cantidad:cantidad},
        url: 'json_update_cantidad.php',
        type: 'POST',
        beforeSend: function (xhr){
            console.log("Actualizando...");
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                console.log("Información actualizada");
            }else{
                console.log("Ocurrio un error durante la operación!");
            }
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function edita_cantidad(id_pedido){
    $("#guarda_cantidad"+id_pedido).toggle();
    $("#cantidad_"+id_pedido).toggle();
}
function countNoRead(){
    var count = $(".unread").length;
    var badge = $("#total_pedidos_mostrado");
    badge.hide();
    if(count >= 100){
        badge.text("99+").removeClass("bg-success").addClass("bg-danger");
        badge.show();
        console.log("count >= 100");
    }else if(count > 0 && count < 100){
        badge.text(count).removeClass("bg-danger").addClass("bg-success");
        badge.show();
        console.log("count > 0 || count < 100");
    }
}
function openModalSolicitudDetail(folio){
    getSolicitudDetail(folio);
    getSolicitudDetail_pedido(folio);
    $("#modal_detail_solicitud").modal("show");
}
function closeModalSolicitudDetail(){
    $("#modal_detail_solicitud").modal("hide");
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
            $("#solicitante").val(obj[0]["nombre_solicitante"]);
            $("#puesto").val(obj[0]["puesto_solicitante"]);
            $("#fecha_actual").val(obj[0]["fecha"]);
            $("#area_aquipo").val(obj[0]["nombre_generico"]);
            $("#sitio").val(obj[0]["sitio_operacion"]);
            $("#modal_detail_solicitud").data("solicitud", obj[0]["sitio_operacion"]);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function getSolicitudDetail_pedido(folio){
    var t = $('#tabla_pedidos').DataTable();
    $.ajax({
        data:{folio:folio},
        url: 'json_selectSolicitudDetail_pedidos.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw();
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add( [
                    value.cantidad_coord,
                    value.unidad,
                    value.articulo,
                    value.justificacion,
                    value.nombre_sub_area
                ] ).draw( false );
            });
        },
        error: function (obj) {
        },
        complete: (function () {
           
        })
    });
}
function firma_almacen(firmax){
    $("#log_autentic_almacenista").trigger("reset");
    $("#mod_log_acces").data("firmax",firmax);
    $("#mod_log_acces").modal("show");
}
 function log_autentic(){
     var password = $("#password").val();
     var usuario  = $("#usuario").val();
     var tokenid  = $("#mod_log_acces").data("firmax");
     var id_solicitud = $("#modal_detail_solicitud").data("solicitud");
     $.ajax({
        data:{password:password,usuario:usuario,id_solicitud:id_solicitud,tokenid:tokenid},
        url: 'json_aut_firma.php',
        type: 'POST',
        success:(function(res){
            if(res.result == "error_acount"){
                $("#msj_alert").html("<span class='font-weight-semibold'>Error en los datos de la cuenta</span>").show(200);
            }else if(res.result == "acount_denied"){
                $("#msj_alert").html("<span class='font-weight-semibold'>¡Acceso denegado!</span>").show(200);
            }else if(res.result == "ok"){
                var nombrex = res.nombre+" "+res.apellidos;
                aplica_firma(firma,nombrex,res.id_empleado);
                cambiar_elementos(firma);
                $("#mod_log_acces").modal("hide");
            }
        })
    });
 }
 function aplica_firma(objeto,valor,id_empleado){
    $("#"+objeto).val(valor).data("idempleado",id_empleado);
    if(id_empleado == ""){
       $("#"+objeto+"_check").slideUp();
    }else{
       $("#"+objeto+"_check").slideDown(); 
    }
 }
 function guardarCambios(){
    $('.input-cantidad-coord').each( function () {
        var cantidad = $(this).val();
        var idpedido = $(this).data("idpedido");
        guarda_cantidad_coord(idpedido,cantidad);
    });
 }
function guarda_cantidad_coord(id_pedido,cantidad){
    var columna = "cantidad_coord";
    $.post( "json_update_cantidad.php",{ id_pedido:id_pedido, cantidad_coord:cantidad, columna:columna }).done(function( data ) {
        console.log("Guardo exitoso: id_pedido:" + id_pedido + " , cantidad:" + cantidad + " , columna:" + columna);
    });
}

