$(document).ready( function () {
    $(".nuevas-entradas-inbox").hide();
    $(".almacen-aprobacion").addClass("active");
    $('#lay_out_solicitudesx').DataTable({
        paging: false,
        ordering: false,
        bDestroy: true,
        bInfo: false,
        dom: '<"datatable-scroll-wrap"t>',
        ajax: {
            url: "json_selectSolicitudBandeja_paraEntrega.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        rowGroup: {
            dataSrc: 'grupo'
        },
        createdRow: function ( row, data, index ) {
            $("#total_pedidos_mostrado").text(index+1);
            $(row).attr('id',data['folio']);
            $(row).attr('data-statusvale',data['status_vale']);
            
            if(data['status_vale'] ==  '1'){
                $(row).addClass('unread');
            }
            $(row).data('scroll');
            $('td', row).eq(0).addClass('table-inbox-time text-center');
            $('td', row).eq(1).addClass('table-inbox-time text-center');
            $('td', row).eq(2).addClass('table-inbox-message');
            $('td', row).eq(3).addClass('table-inbox-time text-center');
        },
        columns: [
            {data : 'revisado'},
            {data : 'fecha'},
            {data : 'pedidos'},
            {data : 'folio'}
        ],
        language: {
            zeroRecords: "Ningun elemento seleccionado"
        }
    });
    no_read_inbox();
    $('#dt_for_vobo').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-footer"><"datatable-scroll-wrap"t>',
        createdRow: function ( row, data, index ) {
            //$(row).attr("id","id_row_"+data[3]);
        },
        columnDefs: [
            {targets: 0, width: '6%',className:'text-center'},
            {targets: 1, width: '4%'},
            {targets: 2, width: '30%'},
            {targets: 3, width: '30%'},
            {targets: 4, width: '30%'}
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
            $('html, body').animate({
                scrollTop: $("#content_table_pedidos_list").data("scroll")
            }, 200);
            var t = $('#lay_out_solicitudesx').DataTable();
            t.ajax.reload();
            no_read_inbox();
            $("#panel_autoizacion_salida").slideUp();
            $("#lay_out_solicitudesx").slideDown();
        }else{
            $("#lay_out_solicitudesx").slideUp();
            $("#content_table_pedidos_list").data("scroll",$("html").scrollTop());
            $("#"+id).addClass("sel-item");
            setTimeout(function() {
                $("#panel_autoizacion_salida").slideDown();
                detalle_vale_salida(id);
                setPedidos(id);
            }, 500);
        }
        $("#tools_menu_select").toggle("fast");
        $("#tools_menu_regresa").data("idrow",id);
                
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
    $('#buscar_en_tabla_vobo').on( 'change paste keyup', function () {
        var table = $('#lay_out_solicitudesx').DataTable();
        table
            .search( this.value )
            .draw();
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
        url: 'json_get_folio_detail_recibe.php',
        type: 'POST',
        success: function (obj) {
            $("#panel_autoizacion_salida").data("foliovalesalida",obj.folio_vale);
            $("#panel_autoizacion_salida").data("statusvale",obj.status_vale);
            $("#firma_almacenista").val(obj.nombre_encargado+" "+obj.apellido_encargado);
            $("#firma_vobo").val(obj.nombre_vobo+" "+obj.apellido_vobo);
            $("#firma_recibe").val(obj.recibe_vale);
            
            if(obj.status_vale == '1'){
                $("#firma_recibe").attr("disabled",false);//firma-individual
                $("#btn_envia_guarda_valesalida").attr("disabled",false);
            }else if(obj.status_vale == '2'){
                $("#firma_recibe").attr("disabled",true);
                $("#btn_envia_guarda_valesalida").attr("disabled",true);
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
        url: 'json_list_pedido_salida_recibe.php',
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
                var temp =
                t.row.add( [
                    value.cantidad_surtir,
                    value.autorizacion,
                    value.articulo,
                    value.destino,
                    value.recibe
                ] ).node();
                t.draw( false );
                $(temp).attr("data-idvalesalidapedido", value.id_valesalida_pedido);
                $(temp).attr("data-cantidad_surtir_num", value.cantidad_surtir_num);
                
            });
            $.each(obj, function (index, value) {
                var id_valesalida_pedido = value.id_valesalida_pedido;
                
                $("#number_"+id_valesalida_pedido).bind('keyup mouseup', function () {
                var max = parseInt($("#number_"+id_valesalida_pedido).attr("max"));
                var val = parseInt($("#number_"+id_valesalida_pedido).val());
                if(val <= max ){
                    var por = (val*100)/max;
                    if(por >= 100){
                        $("#progress_"+id_valesalida_pedido).removeClass("progress-bar-animated").addClass("bg-success");
                    }else{
                        $("#progress_"+id_valesalida_pedido).addClass("progress-bar-animated").removeClass("bg-success");
                    }
                    $("#progress_"+id_valesalida_pedido).css("width",por+"%");
                }else{
                    if (!isNaN(val) ){
                        alert("El valor ingresado no es valido conforme a la solicitud");
                    }
                    $("#number_"+id_valesalida_pedido).val("");
                    $("#progress_"+id_valesalida_pedido).css("width","100%");
                }
                if(val > 0){
                    $("#"+id_valesalida_pedido).prop( "checked",true).attr("disabled",false);
                }else{
                    $("#"+id_valesalida_pedido).prop( "checked",false).attr("disabled",true);
                }
            });
            $("#number_"+id_valesalida_pedido).focusout(function() {
                var val = parseInt($("#number_"+id_valesalida_pedido).val());
                if (isNaN(val) ){
                    $("#number_"+id_valesalida_pedido).val("0");
                    $("#"+id_valesalida_pedido).prop( "checked",false);
                }else if(val == 0){
                    $("#"+id_valesalida_pedido).prop( "checked",false);
                }else if(val > 0){
                    $("#"+id_valesalida_pedido).prop( "checked",true);
                }
            });
            });
            var options = {
                delay: 500,
                hide: true,
                buttons: {
                    closer: true,
                    sticker: false
                }
            };
            notice.update(options);
        },
        error: function (obj) {
        var options = {
                text: obj.msg,
                addclass: 'bg-danger border-danger',
                type: 'info',
                icon: 'icon-close2',
                delay: 1000,
                hide: true
            };
            notice.update(options);
        },
        complete: (function () {
            var status_vale = $("#panel_autoizacion_salida").data("statusvale");
            if (status_vale == 1){
                $(".firma-individual").attr("disabled",false);
            }else if (status_vale == 2){
                $(".firma-individual").attr("disabled",true);
            }
        })
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
    var firma_recibe = $("#firma_recibe").val();
    var notice = new PNotify();
    if (firma_recibe != ""){
        guarda_firma_recibe_todo(firma_recibe);
        $(".firma-individual").each(function(){
           var id_valesalida_pedido = $(this).attr("id");
           var recibe = $(this).val();
           
           $.ajax({
               data:{id_valesalida_pedido:id_valesalida_pedido,recibe:recibe},
               url: 'json_update_recibe_solicitud.php',
               type: 'POST',
               success:(function(res){
                   if(res[0].result == "exito"){
                        var options = {
                            text: "Guardando...",
                            addclass: 'bg-primary border-primary',
                            type: 'info',
                            delay: 1000,
                            hide: true
                        };
                        notice.update(options);
                        $("#"+id_valesalida_pedido).attr("disabled",true);
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
            text: "Debe asignar el nombre de quien recibe el material",
            addclass: 'bg-warning border-warning',
            type: 'info',
            icon: 'icon-close2',
            delay: 1000,
            hide: true
        };
        notice.update(options);
    }
 }
 function guarda_firma_recibe_todo(firma_recibe){
    var folio_vale  = $("#panel_autoizacion_salida").data("foliovalesalida");
    $.ajax({
        data:{folio_vale:folio_vale,recibe_vale:firma_recibe},
        url: 'json_update_recibe_solicitud_todo.php',
        type: 'POST',
        success: function (obj) {
            if(obj[0].result == "exito"){
                console.log("Firma recibe guardada");
                $("#firma_recibe").attr("disabled",true);
            }else{
                console.log("Error al guardar firma recibe: " + obj[0].result);
            }
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function envia(){
    var folio_vale = $("#panel_autoizacion_salida").data("foliovalesalida");
    $.post('print_vale_salida.php', { folio_vale: folio_vale }, function (result) {
        WinId = window.open('', 'newwin', 'width=800,height=500');//resolucion de la ventana
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}
function ver_todo(){
    var table = $('#lay_out_solicitudesx').DataTable();
    $("#panel_autoizacion_salida").slideUp();
    $("#lay_out_solicitudesx").slideDown();
    table.ajax.url("json_selectSolicitudBandeja_paraEntrega.php").load;
    table.ajax.reload();
    no_read_inbox();
}
function ver_no_autorizado(){
    var table = $('#lay_out_solicitudesx').DataTable();
    $("#panel_autoizacion_salida").slideUp();
    $("#lay_out_solicitudesx").slideDown();
    table.ajax.url("json_selectSolicitudBandeja_paraVobo_3.php").load;
    table.ajax.reload();
    no_read_inbox();
}
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
function finalizar(){
    var notice = new PNotify();
    var success = {text: "Operacion finalizada",addclass: 'bg-success border-success',type: 'info',icon: 'icon-checkmark4',delay: 1000,hide: true};
    var fail = {text: "Fallo la operación",addclass: 'bg-danger border-danger',type: 'info',icon: 'icon-close2',delay: 1000,hide: true};
                        
    var folio_vale  = $("#panel_autoizacion_salida").data("foliovalesalida");
    $.post('json_update_state_valesalida.php', { folio_vale: folio_vale }, function (result) {
        if(result[0].result == "exito"){
            notice.update(success);
        }else{
            notice.update(fail);
        }
    });
}
function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}