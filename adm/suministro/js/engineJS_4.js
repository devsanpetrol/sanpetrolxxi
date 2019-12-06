$(document).ready( function () {
    
    $('#lay_out_solicitudesx').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        bInfo: false,
        processing: true,
        selected: true,
        serverSide: true,
        serverMethod: 'post',
        ajax: {
            url: "json_selectSolicitudBandeja_paraVobo.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        createdRow: function ( row, data, index ) {
            $("#total_pedidos_mostrado").text(index+1);
            $(row).attr('id',data['folio']);
            $(row).addClass('unread');
            $(row).data('scroll');
            $('td', row).eq(0).addClass('table-inbox-name');
            $('td', row).eq(1).addClass('table-inbox-message');
            $('td', row).eq(2).addClass('table-inbox-time');
        },
        columns: [
            {data : 'star'},
            {data : 'pedidos'},
            {data : 'fecha'}
        ],
        language: {
            zeroRecords: "Ningun elemento seleccionado"
        }
    });
    $('#dt_for_vobo').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-footer"><"datatable-scroll-wrap"t>',
        createdRow: function ( row, data, index ) {
            //$(row).attr("id","id_row_"+data[3]);
        },
        columnDefs: [
            {targets: 0, width: '4%'},
            {targets: 1, width: '4%'},
            {targets: 2, width: '31%'},
            {targets: 3, width: '28%'},
            {targets: 4, width: '28%'},
            {targets: 5, width: '5%'}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        }
    });
    //--------TIEMPO REAL ---------
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
        }else{
            $("#lay_out_solicitudesx").slideUp();
            
            $("#content_table_pedidos_list").data("scroll",$("html").scrollTop());
            $("#"+id).addClass("sel-item");
            setTimeout(function() {
                detalle_vale_salida(id);
                setPedidos(id);
            }, 500);
        }
        $("#tools_menu_select").toggle("fast");
        $("#tools_menu_regresa").data("idrow",id);
        $(".ocultatodo").toggle("fast");
        $(".ocultatodo").removeClass("ocultatodo");
        
        return false;
    } );
    
    $('#usuario').select();
    $("#usuario").keydown(function(){
            $('#msj_alert').hide();
            $('#password').val('');
    });
    $("#password").keydown(function(){
            $('#msj_alert').hide();
    });
    $("#usuario").on('keyup', function (e) {
        if (e.keyCode === 13) {
           $('#password').focus();
        }
    });
    $("#password").on('keyup', function (e) {
        if (e.keyCode === 13) {
            log_autentic();
        }
    });
} );
function set_list_resp(id_empleado,nombre,apellidos){
    var apellidos_ = apellidos.replace(/ /g, "");
    $('.'+apellidos_+id_empleado).remove();
    $('#flex ul').append(
        $('<li>').addClass(apellidos_+id_empleado).append("<button type='button' class='btn btn-success btn-sm' ><i class='fa fa-user'></i> "+nombre+" "+apellidos+" <i class='fa fa-check-circle-o'></i></button>")
    );
}
function regresar_lista(){
    var idrow = $("#tools_menu_regresa").data("idrow");
    $("#"+idrow+"").click();
}
function detalle_vale_salida(folio_vale){
    $.ajax({
        data:{folio_vale:folio_vale},
        url: 'json_get_folio_detail.php',
        type: 'POST',
        success: function (obj) {
            $("#folio_pase_salida").text(obj.folio_vale);
            $("#firma_almacenista").val(obj.nombre_encargado+" "+obj.apellido_encargado);
            $("#firma_vobo").val(obj.nombre_vobo+" "+obj.apellido_vobo).data("idempleado",obj.visto_bueno);
            $("#vale_observacion").val(obj.observacion);
            if(obj.status_vale == '1'){
                $("#btn_envia_guarda_valesalida").attr("disabled",true);
            }else if(obj.status_vale == '0'){
                $("#btn_envia_guarda_valesalida").attr("disabled",false);
            }
            if(obj.visto_bueno != ''){
                $("#id_firma_vobo").attr("disabled",true);
            }else{
                $("#id_firma_vobo").attr("disabled",false);
            }
        },
        error: function (obj) {
            alert(obj.msg);
        }
    });
}
function setPedidos(folio){
    var t = $('#dt_for_vobo').DataTable();
    var notice = new PNotify();
    $.ajax({
        data:{folio:folio},
        url: 'json_list_pedido_salida.php',
        type: 'POST',
        beforeSend: function (xhr) {
            t.clear().draw();
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
            $.each(obj, function (index, value) {
                t.row.add( [
                    value.cantidad_surtir,
                    value.unidad,
                    value.articulo,
                    value.destino,
                    value.justificacion,
                    value.autorizacion
                ] ).draw( false );
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
function log_autentic(){
     var firma = $("#mod_log_acces").data("firmax");
     var password = $("#password").val();
     var usuario  = $("#usuario").val();
     var tokenid  = $("#"+firma).data("tokenid");
     $.ajax({
        data:{password:password,usuario:usuario,tokenid:tokenid},
        url: 'json_aut_almacen.php',
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
 function firma_almacen(firmax){
    $("#log_autentic_almacenista").trigger("reset");
    $("#mod_log_acces").data("firmax",firmax);
    $("#mod_log_acces").modal("show");
 }
 
 function aplica_firma(objeto,valor,id_empleado){
    $("#"+objeto).val(valor).data("idempleado",id_empleado);
    if(id_empleado == ""){
       $("#"+objeto+"_check").slideUp();
    }else{
       $("#"+objeto+"_check").slideDown(); 
    }
 }
 function cambiar_elementos(firma){
    if(firma == "firma_almacenista"){
        $("#btn_envia_valesalida").attr("disabled",false);
    }else if(firma == "firma_vobo"){
        $(".input-surtido-genera").each(function(){
            $(this).attr("disabled",true);
        });
        $(".remover-item-pase").each(function(){
            $(this).remove();
        });
        $(".card-pedidos-xsurtir").slideUp();
    }
 }
 function guarda_cambios(){
    var aut = $("#firma_vobo").data("idempleado");
    var td = $('#dt_for_vobo').DataTable();
    
    var notice = new PNotify();
    if (aut != ""){
        $(".custom-control-input").each(function(){
           var id_pedido = $(this).data("idpedido");
           var cod_articulo = $(this).data("codarticulo");
           var cantidad_surtir = $(this).data("cantidadsurtir");
           var id_valesalida_pedido = $(this).attr("id");
           var status = (this.checked) ? "si" : "no";
           $.ajax({
               data:{id_pedido:id_pedido,cod_articulo:cod_articulo,cantidad_surtir:cantidad_surtir,id_valesalida_pedido:id_valesalida_pedido,status:status},
               url: 'json_update_pase_salida_valida.php',
               type: 'POST',
               beforeSend: function (xhr) {
                    td.clear().draw();
                    var options = {
                        text: "Recopilando información...",
                        addclass: 'bg-primary border-primary',
                        type: 'info',
                        icon: 'icon-spinner4 spinner',
                        hide: false
                    };
                    notice.update(options);
                },
               success:(function(res){
                   if(res.result == "exito"){
                        var options = {
                            text: "Enviado con exito!",
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
                   }else{
                       var options = {
                        text: "Ocurrio un error al procesar la información",
                        addclass: 'bg-danger border-danger',
                        type: 'info',
                        icon: 'icon-close2',
                        delay: 1000,
                        hide: true
                    };
                    notice.update(options);
                   }
               }),
               complete: (function () {
                    $("#btn_envia_guarda_valesalida").attr("disabled",true);
               })
           });
        });
    }else{
        var options = {
            text: "Accion no autorizada",
            addclass: 'bg-danger border-danger',
            type: 'info',
            icon: 'icon-close2',
            delay: 1000,
            hide: true
        };
        notice.update(options);
    }
 }

