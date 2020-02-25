$(document).ready( function () {
    var user_session_id = $('#user_session_id').data("employeid");
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        info: false,        
        createdRow: function ( row, data, index ){
            $(row).addClass('pointer font-weight-semibold text-grey');
        },
        columnDefs: [
            {targets:0,className: "dt-center"}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
        }
    });
    $('#tabla_pedidos_comentario').DataTable({
        scrollY:        '60vh',
        scrollY:        '60vh',
        scrollCollapse: true,
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        info: false,
        createdRow: function ( row, data, index ){
            $(row).addClass('pointer font-weight-semibold text-grey');
        },
        columnDefs: [
            
        ],
        language: {
            zeroRecords: "No hay comentarios para mostrar"
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
            url: "json_selectSolicitudBandeja_coordTest.php",
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
            
            $('td', row).eq(2).addClass('table-inbox-message');
            
        },
        columns: [
            {data : 'solicita'},
            {data : 'status'},
            {data : 'pedidos'},
            {data : 'fecha'}
        ],
        language: {
            zeroRecords: "Ningun elemento seleccionado"
        }
    });

    $('#lay_out_solicitudesx tbody').on('click', 'tr', function () {
        var folio = this.id;
        $('#tabla_pedidos').data("folio",folio);
        openModalSolicitudDetail(folio);
        return false;
    } );
    
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        table.row('.selected').remove().draw( false );
        $("#btn_del_row_sel").slideUp();
    } );
    $('#tabla_pedidos tbody').on( 'click', 'tr', function () {
        var table = $('#tabla_pedidos').DataTable();
        var table_coment = $('#tabla_pedidos_comentario').DataTable();
        var filas = table.rows().count();
        table_coment.clear().draw();
        $("#text_comentario").attr("disabled",true);
        if (filas > 0){
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else{
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                get_comentario($(this).attr("id"));
                $("#text_comentario").attr("disabled",false);
                $("#text_comentario").data("idpedido",$(this).attr("id"));
            }
        }
    } );
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        var id_pedido = table.row('.selected').id();
        console.log(id_pedido);
    } );
} );
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
function openModalSolicitudDetail(folio){
    getSolicitudDetail(folio);
    getSolicitudDetail_pedido(folio);
    $("#modal_detail_solicitud").toggle(400);
    $("#tabla_visor_solicitudes").toggle(400);
    $("#expand_menu_lateral").click();
}
function closeModalSolicitudDetail(){
    var table_pedido = $('#tabla_pedidos').DataTable();
    var table_coment = $('#tabla_pedidos_comentario').DataTable();
        table_coment.clear().draw();
        table_pedido.clear().draw();
    $("#modal_detail_solicitud").toggle(400);
    $("#tabla_visor_solicitudes").toggle(400);
    $("#expand_menu_lateral").click();
}
function guardarCambios(){
    $('.input-cantidad-coord').each( function () {
        var cantidad = $(this).val();
        var idpedido = $(this).data("idpedido");
        guarda_cantidad_coord(idpedido,cantidad);
    });
    var folio = $('#tabla_pedidos').data("folio");
    getSolicitudDetail_pedido(folio);
    set_firma_coord();
    $('#lay_out_solicitudesx').DataTable().ajax.reload();
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
            $("#solicitante").val(data.nombre_solicitante);
            $("#puesto").val(data.puesto_solicitante);
            $("#fecha_actual").val(data.fecha);
            $("#area_aquipo").val(data.nombre_generico);
            $("#sitio").val(data.sitio_operacion);
            $("#name_coordinacion").html(data.coordinacion_up + ":");
            if(data.firm_coordinacion == 0){
                $("#firm_coordinacion")
                    .removeClass("badge-success badge-danger")
                    .addClass("border-primary-300 alpha-primary text-primary-800")
                    .data({idempleado:data.firm_coordinacion,nuevafirma:""})
                    .text("Firmar solicitud");
                $("#guarda_cambios_solicitud").show();
            }else{
                $("#firm_coordinacion")
                    .removeClass("badge-danger border-primary-300 alpha-primary text-primary-800")
                    .addClass("badge-success")
                    .data({idempleado:data.firm_coordinacion,nuevafirma:""})
                    .text("Revisado");
                $("#guarda_cambios_solicitud").hide();
            }
            if(obj[0]["firm_planeacion"] == 0){
                $("#firm_planeacion")
                    .removeClass("badge-success badge-danger")
                    .addClass("badge-danger")
                    .text("Pendiente");
            }else{
                $("#firm_planeacion")
                    .removeClass("badge-danger badge-success")
                    .addClass("badge-success")
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
    $.ajax({
        data:{folio:folio},
        url: 'json_selectSolicitudDetail_pedidos.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw();
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.cantidad_coord,
                    value.unidad,
                    value.articulo,
                    value.justificacion,
                    value.nombre_sub_area
                ]).node().id = value.id_pedido;
                t.draw( false );
            });
        },
        error: function (obj) {
            
        },
        complete: (function () {
            if( $("#firm_coordinacion").data("idempleado") > 0 ){
                $(".input-cantidad-coord").attr('disabled', true);
                if( $("#firm_coordinacion").data("nuevafirma") == "new" ){
                    $("#guarda_cambios_solicitud").show();
                }else{
                    $("#guarda_cambios_solicitud").hide();
                }
            }
        })
    });
}
function guarda_cantidad_coord(id_pedido,cantidad){
    var columna = "cantidad_coord";
    $.post( "json_update_cantidad.php",{ id_pedido:id_pedido, cantidad:cantidad, columna:columna }).done(function( data ) {
        console.log("Guardo exitoso: id_pedido:" + id_pedido + " , cantidad:" + cantidad + " , columna:" + columna + " data:" + data);
    });
}
function firma_solicitud(){
    if($("#firm_coordinacion").data("idempleado") == 0){
        $("#form_log_autentic").trigger("reset");
        $("#mod_log_acces").modal("show");
    }
}
 function log_autentic(){
     var password = $("#password").val();
     var usuario  = $("#usuario").val();
     var tokenid  = $("#mod_log_acces").data("firmax");
     $.ajax({
        data:{password:password,usuario:usuario,tokenid:tokenid},
        url: 'json_aut_firma.php',
        type: 'POST',
        success:(function(res){
            if(res.result == "error_acount"){
                $("#msj_alert").html("<span class='font-weight-semibold'>Error en los datos de la cuenta</span>").show(200);
            }else if(res.result == "acount_denied"){
                $("#msj_alert").html("<span class='font-weight-semibold'>¡Acceso denegado!</span>").show(200);
            }else if(res.result == "aprobado"){
                aplica_firma(res.id_empleado);
                $("#mod_log_acces").modal("hide");
            }
        })
    });
 }
 function aplica_firma(id_empleado){
    $("#firm_coordinacion")
            .data({idempleado:id_empleado,nuevafirma:"new"})
            .removeClass("badge-danger border-primary-300 alpha-primary text-primary-800")
            .addClass("badge-success")
            .text("Revisado");
 }
function get_comentario(id_pedido){
    var t = $('#tabla_pedidos_comentario').DataTable();
    $.post( "json_getComentarioPedido.php",{ id_pedido:id_pedido}).done(function( data ) {
        $.each(data, function (index, value) {
            t.row.add([
                value.comentario
            ]).draw( false );
        });
    });
}
function set_firma_coord(){
    if($('#firm_coordinacion').data('nuevafirma') == 'new'){
        var firma       = $('#firm_coordinacion').data('idempleado');
        var folio       = $('#tabla_pedidos').data('folio');
        var column_firm = 'firm_coordinacion';
        var column_date = 'fecha_firm_coordinacion';
        
        $.post('json_update_firma_coord.php',{firma:firma,folio:folio,column_firm:column_firm,column_date:column_date}).done(function( data ) {
            if(data.result = "exito"){
                alert("La solicitud fue enviada correctamente al Depto. de Planeación!");
                $('#firm_coordinacion')
                    .removeClass('border-primary-300 alpha-primary text-primary-800')
                    .addClass('badge-success')
                    .data('nuevafirma','')
                    .text('Revisado');
            }
        });
    }
}
function send_comentario(){
    var txt_comt = $("#text_comentario");
    var comentario = txt_comt.val();
    if(comentario != ""){
        var id_pedido = txt_comt.data("idpedido");
        var id_empleado = $('#user_session_id').data("employeid");
        var tabla = $('#tabla_pedidos_comentario').DataTable();

        $.post('json_insertComentario.php',{comentario:comentario,id_empleado:id_empleado,id_pedido:id_pedido}).done(function( data ) {
            if(data.result = "ok"){
                tabla.clear().draw();
                txt_comt.val("");
                get_comentario(id_pedido);
            }else{
                alert("Error al guardar comentario");
            }
        });
    }
}

