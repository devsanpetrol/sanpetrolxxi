$(document).ready( function () {
    var user_session_id = $('#user_session_id').data("employeid");
    var table = $('#tabla_pedidos').DataTable();
    $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-800 text-primary-800'
    });
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ) {
            $(row).addClass('pointer font-weight-semibold text-blue-800');
            $('td', row).eq(1).addClass('resalta');
            $('td', row).eq(3).addClass('resalta');
            if(data[11] == 'Inmediato'){
                $('td', row).eq(0).addClass('text-orange-400');
            }else{
                $('td', row).eq(0).addClass('text-slate-800');
            }
        },
        columnDefs: [
            {targets: 0,width: '1%'},
            {targets: 3,visible: false},
            {targets: 4,visible: false},
            {targets: 5,visible: false},
            {targets: 6,visible: false},
            {targets:10,visible: false,searchable: false},
            {targets:11,visible: false,searchable: false},
            {targets:13,visible: false,searchable: false},
            {targets:14,visible: false,searchable: false}
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
        var id = this.id;
        
        $("#lay_out_solicitudesx tbody tr").addClass("ocultatodo");
        $("#"+id).removeClass("ocultatodo");
        if ($("#"+id).hasClass('sel-item')){
            $("#"+id).removeClass("sel-item");
            $("#lay_out_solicitudesx").slideDown();
            $('html, body').animate({
                scrollTop: $("#content_table_pedidos_list").data("scroll")
            }, 200);
            var t = $('#lay_out_solicitudesx').DataTable();
            t.draw( false );
            OnOff = true;
            $(".display-pedidos").remove();
            countNoRead();
        }else{
            $("#lay_out_solicitudesx").slideUp();
            
            $("#content_table_pedidos_list").data("scroll",$("html").scrollTop());
            $("#"+id).addClass("sel-item");
            setTimeout(function() {
                setPedidos(id);
            }, 500);
            OnOff = false;
        }
        $("#tools_menu_select").toggle("fast");
        $("#tools_menu_regresa").data("idrow",id);
        $(".ocultatodo").toggle("fast");
        $(".ocultatodo").removeClass("ocultatodo");
        
        return false;
    } );
    
    $('#tabla_pedidos tbody').on( 'click', 'tr', function () {
        var table = $('#tabla_pedidos').DataTable();
        var filas = table.rows().count();
        if (filas > 0){
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $("#btn_del_row_sel").slideUp("fast");
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $("#btn_del_row_sel").slideDown("fast");
            }
        }
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
function set_list_resp(id_empleado,nombre,apellidos){
    var apellidos_ = apellidos.replace(/ /g, "");
    $('.'+apellidos_+id_empleado).remove();
    $('#flex ul').append(
        $('<li>').addClass(apellidos_+id_empleado).append("<button type='button' class='btn btn-success btn-sm' ><i class='fa fa-user'></i> "+nombre+" "+apellidos+" <i class='fa fa-check-circle-o'></i></button>")
    );
}
function setPedidos(folio){
    var result;
    var array_btn_save = [];
    var notice = new PNotify();
    $.ajax({
        data:{folio:folio},
        url: 'json_list_pedido.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Recopilando información...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
        },
        success: function (obj) {
            result = obj;
            $.each(obj, function (index, value) {
                array_btn_save.push(value.id_pedido);
                obj_pedido(value);
            });
            var options = {
                text: "Completado!",
                addclass: 'bg-success border-success',
                type: 'info',
                icon: 'icon-checkmark4',
                delay: 1000,
                hide: true,
                buttons: {
                    closer: true,
                    sticker: false
                }
            };
            notice.update(options);
        },
        error: function (obj) {
            alert(obj.msg);
        }
    });
}
function regresar_lista(){
    var idrow = $("#tools_menu_regresa").data("idrow");
    $("#"+idrow+"").click();
}
function change_status(id_pedido,stat){
    var status = parseInt(stat);
    var badge  = $("#id_pedido_"+id_pedido);
    var borde  = $("#border_card_"+id_pedido);
    var guarda = $("#guarda_status_"+id_pedido);
    borde.attr("class","card border-left-3 rounded-left-0");
    badge.attr("class","badge align-top dropdown-toggle");
    switch (status){
        case 1:
          badge.addClass("bg-success");
          borde.addClass("border-left-success");
          guarda.data("status",1);
          badge.text("Aprobado");
          break;
        case 2:
          badge.addClass("bg-danger");
          borde.addClass("border-left-danger");
          guarda.data("status",2);
          badge.text("Cancelado");
          break;
        case 3:
          badge.addClass("bg-warning");
          borde.addClass("border-left-warning");
          guarda.data("status",3);
          badge.text("En revisión");
          break;
        case 4:
          badge.addClass("bg-purple");
          borde.addClass("border-left-purple");
          guarda.data("status",4);
          badge.text("Enviado a compra");
          break;
        case 5:
          badge.addClass("bg-primary");
          borde.addClass("border-left-primary");
          guarda.data("status",5);
          badge.text("Listo entrega");
          break;
        case 6:
          badge.addClass("bg-secondary");
          borde.addClass("border-left-secondary");
          guarda.data("status",6);
          badge.text("Entregado");
          break;
        case 8:
          badge.addClass("bg-pink-400");
          borde.addClass("border-left-pink-400");
          guarda.data("status",8);
          badge.text("Compra autorizada");
          break;
        case 9:
          badge.addClass("bg-violet-400");
          borde.addClass("border-left-violet-400");
          guarda.data("status",9);
          badge.text("Compra no autorizada");
          break;
        case 10:
          badge.addClass("bg-indigo-800");
          borde.addClass("border-left-indigo-800");
          guarda.data("status",10);
          badge.text("Material recibido");
          break;
    }
}
function change_edita_cantidad(id_pedido){
    $.post( "json_selectStatPedidoMan.php",{ id_pedido:id_pedido }).done(function( data ) {
        var status = parseInt(data[0]["aprobacion"]);
        var badge  = $("#edita_cantidad"+id_pedido);
        switch (status){
            case 0:
              badge.show();
              break;
            default:
              badge.hide();
              break;
        }
    });
    
}
function disable_class_btn(id_pedido,disabled){
    $("#status_icon_a_"+id_pedido).prop( "disabled", disabled );
    $("#status_icon_d_"+id_pedido).prop( "disabled", disabled );
    $("#status_icon_r_"+id_pedido).prop( "disabled", disabled );
}
function reset_class_btn(id_pedido){
    $("#status_icon_a_"+id_pedido).attr("class","btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm  btn-status-pedido");
    $("#status_icon_d_"+id_pedido).attr("class","btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm  btn-status-pedido");
    $("#status_icon_r_"+id_pedido).attr("class","btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm  btn-status-pedido");
}
function change_status_manager(id_pedido,aprobado){ // AUTORIZADO, CANCELADO Y REVISION
    var status = parseInt(aprobado);
    var sel_st = $(".menu_items_status_"+id_pedido);
    var autoriza = $("#autoriza_"+id_pedido);
    var grupo = $(".btn-status-pedido-"+id_pedido);
    sel_st.addClass('disabled');
    reset_class_btn(id_pedido);
    
    switch ( status ){
        case 0:
            autoriza.hide();//Nombre del quien autoriza
            break;
        case 1://status APROBADO
            var aprobe = $("#status_icon_a_"+id_pedido);
            aprobe.removeClass("text-slate-400").addClass("text-pink");
            grupo.prop( "disabled", true );
            sel_st.removeClass('disabled');
            autoriza.show();
          break;
        case 2:// status CANCELADO
            var cancel = $("#status_icon_d_"+id_pedido);
            cancel.removeClass("text-slate-400").addClass("text-pink");
            grupo.prop( "disabled", true );
            autoriza.show();
          break;
        case 3:// status REVISION
            var revisi = $("#status_icon_r_"+id_pedido);
            revisi.removeClass("text-slate-400").addClass("text-pink");
            autoriza.show();
          break;
    }
}
function generic_guarda_status(id_pedido,status_pedido){
    var notice = new PNotify();
    $.ajax({
        data:{id_pedido:id_pedido,status_pedido:status_pedido},
        url: 'json_update_pedido.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Actualizando...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
            disable_class_btn(id_pedido,true);
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-success border-success',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
                change_status_manager(id_pedido,status_pedido);
                change_status(id_pedido,status_pedido);
            }else{
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-danger border-danger',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
            }
        },
        complete: function (jqXHR, textStatus) {
            disable_class_btn(id_pedido,false);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });

}
function generic_guarda_status_other(id_pedido,status_pedido){
    var notice = new PNotify();
    $.ajax({
        data:{id_pedido:id_pedido,status_pedido:status_pedido},
        url: 'json_update_pedido.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Actualizando...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
            disable_class_btn(id_pedido,true);
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-success border-success',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
                change_status(id_pedido,status_pedido);
            }else{
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-danger border-danger',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
            }
        },
        complete: function (jqXHR, textStatus) {
            disable_class_btn(id_pedido,false);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });

}
function save_aprobado(id_pedido){
    var btn_guarda_a = $("#status_icon_a_"+id_pedido);
    if (btn_guarda_a.hasClass("text-slate-400")){
        generic_guarda_status(id_pedido,1);
    }else{
        generic_guarda_status(id_pedido,0);
    }
}
function save_cancela(id_pedido){
    var btn_guarda_c = $("#status_icon_d_"+id_pedido);
    if (btn_guarda_c.hasClass("text-slate-400")){
        generic_guarda_status(id_pedido,2);
    }else{
        generic_guarda_status(id_pedido,0);
    }
}
function save_revisa(id_pedido){
    var btn_guarda_r = $("#status_icon_r_"+id_pedido);
    if (btn_guarda_r.hasClass("text-slate-400")){
        generic_guarda_status(id_pedido,3);
    }else{
        generic_guarda_status(id_pedido,0);
    }
}
function obj_pedido(objeto){
    var user_session_id = $("#user_session_id").data("employeid");
    var activo = "disabled";
    
    console.log("user_session_id: " + user_session_id +"; objeto.id_autoriza "+objeto.id_autoriza +"; activo: " + activo);
    var detalle = "style='display: none;'";
    if(objeto.detalle_articulo.length){
        detalle = "";
    }
   
    this.elemento = "<div class='col-lg-12 display-pedidos' style='display: none;' id='folio-"+objeto.folio+"'>\
                        <div class='card border-left-3 border-left-danger rounded-left-0' id='border_card_"+objeto.id_pedido+"'>\
                            <div class='card-body'>\
                                <div class='d-sm-flex align-item-sm-center flex-sm-nowrap'>\
                                    <div>\
                                        <h6 class='font-weight-semibold'>"+objeto.articulo+"</h6>\
                                        <ul class='list list-unstyled mb-0'>\
                                            <li "+detalle+">Detalle articulo : <span class='font-weight-semibold'>"+objeto.detalle_articulo+"</span></li>\
                                            <li>Justificación : <span class='font-weight-semibold'>"+objeto.justificacion+"</span></li>\
                                            <li>Categoria: <span class='font-weight-semibold'>"+objeto.categoria+"</span></li>\
                                        </ul>\
                                    </div>\
                                    <div class='text-sm-right mb-0 mt-3 mt-sm-0 ml-auto'>\
                                        <h6 class='font-weight-semibold' id='cantidad_unidad_edit"+objeto.id_pedido+"' data-unidad='"+objeto.unidad+"'>"+objeto.cantidad+" "+objeto.unidad+" \
                                            <input type='number' class='font-weight-semibold text-blue-800' step='1' value='"+objeto.cantidad+"' min='0' id='cantidad_"+objeto.id_pedido+"' required='true' style='width: 75px; display: none;'>\
                                            <button type='button' class='btn btn-icon btn-sm' id='guarda_cantidad"+objeto.id_pedido+"' onclick='save_cantidad("+objeto.id_pedido+")' style='display: none;'><i class='icon-floppy-disk'></i></button>\
                                            <button type='button' class='btn btn-icon btn-sm' id='edita_cantidad"+objeto.id_pedido+"' onclick='edita_cantidad("+objeto.id_pedido+")'><i class='icon-pencil7'></i></button>\
                                        </h6>\
                                        <ul class='list list-unstyled mb-0'>\
                                            <li>Area/Equipo: <span class='font-weight-semibold'>"+objeto.destino+"</span></li>\
                                            <li>Programado para: <span class='font-weight-semibold'>"+objeto.fecha_requerimiento+"</span></li>\
                                            <li class='dropdown' disabled>\
                                                Status: &nbsp;\
                                                <a href='#' class='badge align-top dropdown-toggle' data-toggle='dropdown' id='id_pedido_"+objeto.id_pedido+"'>Sin seguimiento</a>\
                                                <div class='dropdown-menu dropdown-menu-right'>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='4' onclick='generic_guarda_status_other("+objeto.id_pedido+",4)'><i class='icon-cart-add'></i> Enviar a compra</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='10' onclick='generic_guarda_status_other("+objeto.id_pedido+",10)'><i class='icon-box-add'></i> Material recibido</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='5' onclick='generic_guarda_status_other("+objeto.id_pedido+",5)'><i class='icon-bell3'></i> Listo entrega</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='6' onclick='generic_guarda_status_other("+objeto.id_pedido+",6)'><i class='icon-clipboard2'></i> Entregado</a>\
                                                    <div class='dropdown-divider'></div>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='9' onclick='generic_guarda_status_other("+objeto.id_pedido+",9)'><i class='icon-exclamation'></i> Compra no autorizada</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='8' onclick='generic_guarda_status_other("+objeto.id_pedido+",8)'><i class='icon-stamp'></i> Compra autorizada</a>\
                                                </div>\
                                            </li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class='card-footer d-sm-flex justify-content-sm-between align-items-sm-center'>\
                                <span>\
                                    <span class='badge badge-mark border-danger mr-2'></span>\
                                    <span class='font-weight-semibold'>"+objeto.fecha_solicitud+"</span>\
                                    <div class='text-primary-700 font-size-sm' id='autoriza_"+objeto.id_pedido+"'><span class='badge badge-mark border-danger mr-2'></span>Revisó: "+objeto.autoriza+"</div>\
                                </span>\
                                <ul class='list-inline list-inline-condensed mb-0 mt-2 mt-sm-0'>\
                                    <li class='list-inline-item' style='display: none;'>\
                                        <a href='' class='text-default' data-status='0' data-comentario='' onclick='guarda_status("+objeto.id_pedido+")' id='guarda_status_"+objeto.id_pedido+"'><i class='icon-floppy-disk'></i></a>\
                                    </li>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_a_"+objeto.id_pedido+"' onclick='save_aprobado("+objeto.id_pedido+")'><i class='icon-thumbs-up2'></i></button>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_d_"+objeto.id_pedido+"' onclick='save_cancela("+objeto.id_pedido+")'><i class='icon-thumbs-down2'></i></button>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_r_"+objeto.id_pedido+"' onclick='save_revisa("+objeto.id_pedido+")'><i class='icon-eye8'></i></button>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_s_"+objeto.id_pedido+"'><i class='icon-clipboard2'></i></button>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>";
    
    $("#tabla_visor_solicitudes").after(this.elemento);
    change_status(objeto.id_pedido,objeto.status_pedido);
    change_edita_cantidad(objeto.id_pedido);
    if (user_session_id == objeto.id_autoriza){
       $(".btn-status-pedido").prop( "disabled", false );
    }else{
        $(".btn-status-pedido").prop( "disabled", true );
    }
    change_status_manager(objeto.id_pedido,objeto.aprobacion);
    if(objeto.comentario.length){
        $.post( "json_selectPedidoComentario.php",{ id_pedido: objeto.id_pedido }).done(function( data ) {
            $( "#post_nombre_man"+objeto.id_pedido).append(data[0]["supervisor"]);
        });
    }
    $("#folio-"+objeto.folio).slideDown();
    
}
function save_cantidad(id_pedido){
    var notice = new PNotify();
    var cantidad = $("#cantidad_"+id_pedido).val();
    $.ajax({
        data:{id_pedido:id_pedido,cantidad:cantidad},
        url: 'json_update_cantidad.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Actualizando...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                var options = {
                    title: 'Listo!',
                    text: 'Información actualizada',
                    addclass: 'bg-success border-success',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
                addNuewElemet(cantidad,id_pedido);
            }else{
                var options = {
                    title: 'Error',
                    text: 'Ocurrio un error durante la operación!',
                    addclass: 'bg-danger border-danger',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-close2',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
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
function addNuewElemet(cantidad,id_pedido){
    var unidad = $("#cantidad_unidad_edit"+id_pedido).data("unidad");
    $("#cantidad_unidad_edit"+id_pedido).empty();
    $("#cantidad_unidad_edit"+id_pedido)
        .append(cantidad+" "+unidad+" \
            <input type='number' class='font-weight-semibold text-blue-800' step='1' value='"+cantidad+"' min='0' id='cantidad_"+id_pedido+"' required='true' style='width: 75px; display: none;'>\
            <button type='button' class='btn btn-icon btn-sm' id='guarda_cantidad"+id_pedido+"' onclick='save_cantidad("+id_pedido+")' style='display: none;'><i class='icon-floppy-disk'></i></button>\
            <button type='button' class='btn btn-icon btn-sm' id='edita_cantidad"+id_pedido+"' onclick='edita_cantidad("+id_pedido+")'><i class='icon-pencil7'></i></button>");
}
function statusc(){
    alert($("#area_aquipo").val());
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