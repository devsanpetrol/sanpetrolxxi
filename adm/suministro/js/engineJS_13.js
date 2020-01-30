$(document).ready( function () {
    $(".nuevas-entradas-inbox").hide();
    $(".aprobacion_salida_compra_alm").addClass("active");
    
    $('#lay_out_solicitudesx').DataTable({
        paging: false,
        ordering: false,
        bDestroy: true,
        bInfo: false,
        dom: '<"datatable-scroll-wrap"t>',
        ajax: {
            url: "json_selectSolicitudBandeja_pendiente_surtido.php",
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
            if(data['status_vale'] ==  '0'){
                $(row).addClass('unread');
            }
            $(row).data('scroll');
            $('td', row).eq(0).addClass('table-inbox-time text-center');
            $('td', row).eq(1).addClass('table-inbox-time text-center');
            $('td', row).eq(2).addClass('table-inbox-message');
            //$('td', row).eq(3).addClass('table-inbox-time text-center');
        },
        columns: [
            {data : 'revisado'},
            {data : 'fecha'},
            {data : 'pedidos'}
            //{data : 'folio'}
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
            {targets: 1, width: '4%',className:'text-center'},
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
            //t.draw( false );
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
        var val_search = this.value;
        table.columns().every(function () {
            var table = this;
            if (table.search() !== val_search) {
                table.search(val_search).draw();
            }
        });
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
function detalle_vale_salida(id_compra_lista){
    $.ajax({
        data:{id_compra_lista:id_compra_lista},
        url: 'json_get_id_compra_list.php',
        type: 'POST',
        success: function (obj) {
            $("#folio_pase_salida").data("folio",obj.id_compra_lista);
            $("#firma_almacenista").val(obj.nombre_encargado+" "+obj.apellido_encargado);
            $("#firma_vobo").val(obj.nombre_supervision+" "+obj.apellido_supervision).data("idempleado",obj.visto_bueno);
            if(obj.aprobado == '1'){
                $("#btn_envia_guarda_valesalida").attr("disabled",true);
            }else if(obj.aprobado == '0'){
                $("#btn_envia_guarda_valesalida").attr("disabled",false);
            }
            if(obj.visto_bueno != null){
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
function setPedidos(id_compra_lista){
    var t = $('#dt_for_vobo').DataTable();
    var notice = new PNotify();
    $.ajax({
        data:{id_compra_lista:id_compra_lista},
        url: 'json_list_pedido_salida_compra_alm.php',
        type: 'POST',
        beforeSend: function (xhr){
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
                    value.cantidad_compra,
                    value.autorizacion,
                    value.articulo,
                    value.destino,
                    value.justificacion
                ] ).draw( false );
            });
            $.each(obj, function (index, value) {
                var id_valesalida_pedido = value.id_compra_lista;
                
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
                    $("#A"+id_valesalida_pedido).prop( "checked",true).attr("disabled",false);
                }else{
                    $("#A"+id_valesalida_pedido).prop( "checked",false).attr("disabled",true);
                }
            });
            $("#number_"+id_valesalida_pedido).focusout(function() {
                var val = parseInt($("#number_"+id_valesalida_pedido).val());
                if (isNaN(val) ){
                    $("#number_"+id_valesalida_pedido).val("0");
                    $("#A"+id_valesalida_pedido).prop( "checked",false);
                }else if(val == 0){
                    $("#A"+id_valesalida_pedido).prop( "checked",false);
                }else if(val > 0){
                    $("#A"+id_valesalida_pedido).prop( "checked",true);
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
            //t.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
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
    var visto_bueno = $("#firma_vobo").data("idempleado");
    var td  = $('#dt_for_vobo').DataTable();
    //guarda_firma_vobo();
    var notice = new PNotify();
    if (visto_bueno != ""){
        $(".custom-control-input").each(function(){
           var id_compra_lista      = $(this).data("idcompralista");
           var cantidad_surtir      = $(this).data("cantidadsurtir");
           var cantidad_compra      = $("#number_"+id_compra_lista).val();
           var cantidad_cancelado   = cantidad_surtir - cantidad_compra;
           var status = (this.checked) ? "si" : "no";
           
           $.ajax({
               data:{id_compra_lista:id_compra_lista,cantidad_compra:cantidad_compra,cantidad_cancelado:cantidad_cancelado,status:status, visto_bueno:visto_bueno},
               url: 'json_update_pase_salida_valida_compra.php',
               type: 'POST',
               beforeSend: function (xhr){
                    td.clear().draw();
                    var options = {
                        text: "Enviando...",
                        addclass: 'bg-primary border-primary',
                        type: 'info',
                        icon: 'icon-spinner4 spinner',
                        hide: false
                    };
                    notice.update(options);
                },
               success:(function(res){
                   if(res[0].result == "exito"){
                       
                        var options = {
                            text: "Completado",
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
                        $("#tools_menu_regresa").click();
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
 function guarda_firma_vobo(){
    var visto_bueno = $("#firma_vobo").data("idempleado");
    var folio_vale  = $("#folio_pase_salida").data("folio"); 
    $.ajax({
        data:{folio_vale:folio_vale,visto_bueno:visto_bueno},
        url: 'json_update_pase_salida_firma_vobo.php',
        type: 'POST',
        success: function (obj) {
            if(obj[0].result == "exito"){
                console.log("Firma guardada");
            }else{
                console.log("Error al guardar firma: " + obj[0].result);
            }
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function imprimir(){
    var folio_vale = $("#folio_pase_salida").data("folio");
    windows.open("print_vale_salida.php?folio_vale="+folio_vale); 
}
function envia(){
    var folio_vale = $("#folio_pase_salida").data("folio");
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
    table.ajax.url("json_selectSolicitudBandeja_paraVobo.php").load;
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