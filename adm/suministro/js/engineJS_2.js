$(document).ready( function () {
    $("body").addClass("sidebar-xs");
    $(".almacen-salida").addClass("active");
    $('#datatable_almacen_pase').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-footer"><"datatable-scroll-wrap"t>',
        createdRow: function ( row, data, index ) {
            $(row).attr("id","id_row_"+data[6]);
        },
        columnDefs: [
            {targets: 0, width: '10%',className:'text-center'},
            {targets: 1, width: '40%'},
            {targets: 2, width: '35%'},
            {targets: 3, width: '5%',className:'text-center'},
            {targets: 4, width: '5%',className:'text-center'},
            {targets: 5, width: '5%',className:'text-center'},
            {targets: 6, visible: false}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        }
    });
    
    $('#datatable_almacen_salida').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        processing: true,
        dom: '<"datatable-scroll-wrap"t><"datatable-footer"i>',
        ajax: {
            url: "json_selectAlmacenSalida.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'accion'},
            {data : 'articulo'},
            {data : 'destino'},
            {data : 'cantidad_solicitud'},
            {data : 'cantidad_apartado'},
            {data : 'fecha_solicitud'},
            {data : 'folio'}
        ],
        rowGroup: {
            dataSrc: 'grupo'
        },
        columnDefs: [
            {targets: 0,width: '3%'},
            {targets: 1,width: '37%'},
            {targets: 2,width: '30%'},
            {targets: 3,width: '5%',className:'text-center'},
            {targets: 4,width: '5%',className:'text-center'},
            {targets: 5,width: '20%'},
            {targets: 6,visible: false}
        ],
        language: {
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
        
    $('#datatable_almacen_salida thead th').each( function () {
         var title = $(this).text();
        if (title == "FechaFolio"){
            $(this).html( '<input type="search" class="form-control '+title+'" placeholder="Buscar Folio o Fecha" />' );
        }
        if (title == "articulo"){
            $(this).html( '<input type="search" class="form-control '+title+'" placeholder="Buscar Articulo, Categoria, Solicitante, ..." />' );
        }
        if (title == "Destino"){
            $(this).html( '<input type="search" class="form-control '+title+'" placeholder="Buscar Equipo, Personal o Area destinada" />' );
        }
    } );
    
    $('.FechaFolio').on( 'change paste keyup', function () {
    var table = $('#datatable_almacen_salida').DataTable();
    table
        .columns( 5 )
        .search( this.value )
        .draw();
    } );
    $('.Destino').on( 'change paste keyup', function () {
    var table = $('#datatable_almacen_salida').DataTable();
    table
        .columns( 2 )
        .search( this.value )
        .draw();
    } );
    $('.articulo').on( 'change paste keyup', function () {
    var table = $('#datatable_almacen_salida').DataTable();
    table
        .columns( 1 )
        .search( this.value )
        .draw();
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

function filter_folio(e){
    var obj = e.target.id;
    var val = $("#"+obj).data("filter");
    $('.FolioFecha').val(val);
    $('.FolioFecha').keyup();
}
function filter_articulo(e){
    var obj = e.target.id;
    var val = $("#"+obj).data("filter");
    $('.articulo').val(val);
    $('.articulo').keyup();
}
function filter_destino(e){
    var obj = e.target.id;
    var val = $("#"+obj).data("filter");
    $('.Destino').val(val);
    $('.Destino').keyup();
}
function agrega_pase(id_pedido){
    var tabla = $('#datatable_almacen_pase').DataTable();
    $.ajax({
        url: 'json_selectAlmacenPase.php',
        data:{id_pedido:id_pedido},
        type: 'POST',
        success:(function(res){
            $.each(res,function(key, registro){
                tabla.row.add( [
                    registro.cantidad_surtir,
                    registro.articulo,
                    registro.destino,
                    registro.cantidad_apartado,
                    registro.cantidad_entregado,
                    registro.accion,
                    registro.id_pedido
                ] ).draw( false );
            });
            var filas = tabla.rows().count();
            $("#count_row_datatable").text("Numero de registros: "+filas);

            $("#btn_acc_"+id_pedido).attr("disabled",true);
            
            if($("#card_almacen_pase").data("vista") == "no"){
                setTimeout(function() {
                    fecha_actual();
                    aplica_firma("firma_almacenista","","");
                    aplica_firma("firma_vobo","","");
                    $("#btn_envia_valesalida").attr("disabled",true);
                    $("#card_almacen_pase").slideDown();
                }, 1000);
            }
            
            $("#card_almacen_pase").data("vista","si");
            
            $("#number_"+id_pedido).bind('keyup mouseup', function () {
                var max = parseInt($("#number_"+id_pedido).attr("max"));
                var val = parseInt($("#number_"+id_pedido).val());
                if(val <= max ){
                    var por = (val*100)/max;
                    if(por >= 100){
                        $("#progress_"+id_pedido).removeClass("progress-bar-animated").addClass("bg-success");
                    }else{
                        $("#progress_"+id_pedido).addClass("progress-bar-animated").removeClass("bg-success");
                    }
                    $("#progress_"+id_pedido).css("width",por+"%");
                }else{
                    if (!isNaN(val) ){
                        alert("El valor ingresado no es valido conforme a la solicitud");
                    }
                    $("#number_"+id_pedido).val("");
                    $("#progress_"+id_pedido).css("width","0%");
                } 
            });
            $("#number_"+id_pedido).focusout(function() {
                var val = parseInt($("#number_"+id_pedido).val());
                if (isNaN(val) ){
                    $("#number_"+id_pedido).val("0");
                }
            });
        })
    });
}
 function remover_salida(id_pedido){
    $("#btn_acc_"+id_pedido).prop("checked", false);
    $("#btn_acc_"+id_pedido).attr("disabled",false);
    
    $('#id_row_'+id_pedido).slideUp("slow");

    var tabla = $('#datatable_almacen_pase').DataTable();
    
    setTimeout(function() {
        tabla.row('#id_row_'+id_pedido).remove().draw(false);
        
        if(!tabla.data().any()){
            setTimeout(function() {
                $("#card_almacen_pase").slideUp();
                $("#card_almacen_pase").data("vista","no");
            }, 500);
        }
        var filas = tabla.rows().count();
        $("#count_row_datatable").text("Numero de registros: "+filas);
    }, 500);
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
 function  fecha_actual(){
    $.post('json_now.php',function(res){$('#num_folio_vale_salida').text(getFolio(res.fecha_actual));});
 }
 function getFolio(string) {
    var tmp = string.split("");
    var map = tmp.map(function(current) {
      if (!isNaN(parseInt(current))) { return current; }
    });
    
    var numbers = map.filter(function(value) { return value != undefined; });
    return numbers.join("");
 }
 function resetear_tabla_surtir(){
    var a = $("#datatable_almacen_pase").DataTable();
    $("#card_almacen_pase").data("vista","no").slideUp();
    a.clear().draw();
    aplica_firma("firma_almacenista","","");
    aplica_firma("firma_vobo","","");
    $("#vale_observacion").val("");
    $("#btn_envia_valesalida").attr("disabled",true);
 }
 function insert_vale_salida(){
    var folio_vale = parseInt($('#num_folio_vale_salida').text());
    if (isChangeSalida()){
        guarda_vale_salida(folio_vale);
    }else{
        alert("No se realizó ningun surtido");
        resetear_tabla_surtir();
        $(".card-pedidos-xsurtir").slideDown();
        var t = $('#datatable_almacen_salida').DataTable();
        t.ajax.reload();
    }
 }
 function guarda_vale_salida(folio_vale){
    var encargado_almacen = $("#firma_almacenista").data("idempleado");
    var visto_bueno       = $("#firma_vobo").data("idempleado");
    var observacion       = $('#vale_observacion').val();
    var notice = new PNotify();
    $.ajax({
        data:{folio_vale:folio_vale, encargado_almacen:encargado_almacen, visto_bueno:visto_bueno, observacion:observacion},
        url: 'json_insertValeSalida.php',
        type: 'POST',
        beforeSend: function (xhr) {
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
            if(res.result == "exito"){
                guarda_elemento_vale_salida(folio_vale,visto_bueno);
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
            }else if(res.result == "falla_guardado"){
                var options = {
                        text: "Ocurrión un error al guardar los datos",
                        addclass: 'bg-danger border-danger',
                        type: 'info',
                        icon: 'icon-close2',
                        delay: 1000,
                        hide: true
                    };
                    notice.update(options);
            }else if(res.result == "falla_recepcion_dato"){
                var options = {
                        text: "La informacion enviada no es valida",
                        addclass: 'bg-danger border-danger',
                        type: 'info',
                        icon: 'icon-close2',
                        delay: 1000,
                        hide: true
                    };
                    notice.update(options);
            }
        }),
        complete:(function(){
            resetear_tabla_surtir();
            $(".card-pedidos-xsurtir").slideDown();
            var t = $('#datatable_almacen_salida').DataTable();
            t.ajax.reload();
        })
    });
 }
 function guarda_elemento_vale_salida(folio_vale,visto_bueno){
    $(".input-surtido-genera").each(function(){
        var cantidad_surtir = parseFloat($(this).val());
        var id_pedido       = $(this).data("idpedido");
        var cod_articulo    = $(this).data("codarticulo");
        var ua  = ( visto_bueno != '' ) ? 'si' : 'no';

        if( cantidad_surtir > 0 ){
            $.ajax({
                data:{folio_vale:folio_vale, cantidad_surtir:cantidad_surtir, id_pedido:id_pedido, cod_articulo:cod_articulo, update_almacen:ua},
                url: 'json_update_almacen_pedido.php',
                type: 'POST',
                success:(function(result){
                    if(result.result == "exito"){
                        console.log("Guarda detalle: Generado con exito!: id_pedido"+id_pedido);
                    }else if(result.result == "falla_guardado"){
                        console.log("Guarda detalle: Ocurrión un error al guardar los datos: id_pedido"+id_pedido);
                    }else if(result.result == "falla_recepcion_dato"){
                        console.log("Guarda detalle: La informacion enviada no es valida: id_pedido"+id_pedido);
                    }
                })
            });
        }
    });
    
 }
 function isChangeSalida(){
    var flag = 0;
    $(".input-surtido-genera").each(function(){
        var flag2 = parseFloat($(this).val());
        flag += flag2;
    });
    return ( flag > 0 ) ? true : false;
 }
 function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}