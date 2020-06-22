$(document).ready( function () {
    var user_session_id = $('#user_session_id').data("employeid");
    $('.form-control-select2').select2();
    $('.sidebar-sticky .sidebar-xxx').stick_in_parent({
        offset_top: 20,
        parent: '.content'
    });
        // Detach on mobiles
    $('.sidebar-mobile-component-toggle').on('click', function() {
        $('.sidebar-sticky .sidebar-xxx').trigger("sticky_kit:detach");
    });
    $('.pickadate-accessibility').pickadate({
        format: 'dddd, dd mmmm, yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'prefix__',
        hiddenSuffix: '__suffix',
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        labelMonthNext: 'Ir al siguiente mes',
        labelMonthPrev: 'Ir al mes anterior',
        labelMonthSelect: 'Pick a month from the dropdown',
        labelYearSelect: 'Pick a year from the dropdown',
        selectMonths: true,
        selectYears: true
        /*onStart: function() {
            var date = new Date();
            this.set('select', date.getFullYear(), date.getMonth(), date.getDate() );
        }*/
    });
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
    var id_coordinacion = $('#lay_out_solicitudesx').data("idcoordinacion");
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
            data:{user_session_id:user_session_id,id_coordinacion:id_coordinacion},
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
            $('td', row).eq(3).addClass('table-inbox-message');
        },
        columns: [
            {data : 'solicita'},
            {data : 'status_c'},
            {data : 'status_p'},
            {data : 'pedidos'},
            {data : 'fecha'}
        ],
        language: {
            zeroRecords: "Ningun elemento seleccionado"
        }
    });
    $('#search_article').DataTable({
        lengthChange: false,
        bDestroy: true,
        dom: '<"top"i>rt<"bottom"lp>',
        pagingType: "simple",
        pageLength: 5,
        createdRow: function ( row, data, index ) {
            $(row).attr('id',data['cod_articulo']);
            $(row).addClass('unread');
        },
        language: {
            zeroRecords: "Ningun elemento encontrado",
            lengthMenu: '<span>Mostrado </span> _MENU_ <span>elementos</span>',
        }
    });
    $('#historico_tabla').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        ajax: {
            url: "json_historico_tabla.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'folio'},
            {data : 'cant'},
            {data : 'coord'},
            {data : 'plan'},
            {data : 'surt'},
            {data : 'surt_fecha'},
            {data : 'unidad'},
            {data : 'articulo'},
            {data : 'status'},
            {data : 'equipo'}
        ],
        rowGroup: {
            dataSrc: 'grupo'
        },
        columnDefs: [
            {targets:0, visible:false}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Busqueda...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $("#buscar_en_tabla_layoutx").on('keyup', function (e) {
        if (e.keyCode === 13) {
           getAlmacenSearch();
           $("#sidebar_sticky_article").show();
        }
    });
    //==========================================================================
    $('#select_article').select2({
        dropdownParent: $('#modal_large'),
        ajax:{
            url: 'json_selectArticle.php',
            type: 'post',
            dataType: 'json',
            delay: 1000,
            cache: true,
            data: function (params) {
             return { searchTerm: params.term };
            },
            processResults: function (response) {
                return { results: response };
            }
        }
    });
    $( '#select_article' ).change(function () {
       var searchTerm = $( '#select_article' ).val();
        $.ajax({
            url: 'json_pedido.php',
            data:{searchTerm:searchTerm},
            type: 'POST',
            success:(function(res){
                $('#cod_articulo').val(res.cod_articulo);
                $('#descripcion').val(res.descripcion);
                $('#unidad').val(res.tipo_unidad).trigger('change');
            })
        });
        if(isNaN($('#select_article').val())){
            $('#unidad').prop('disabled', true);
        }else{
            $('#unidad').prop('disabled', false);
        }
    });
    $('#lay_out_solicitudesx tbody').on('click', 'tr', function () {
        var folio = this.id;
        $('#tabla_pedidos').data("folio",folio);
        $('#modal_large').data("folio",folio);
        openModalSolicitudDetail(folio);
        return false;
    } );
    
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        table.row('.selected').remove().draw( false );
        $("#btn_del_row_sel").slideUp();
    } );
    
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        var id_pedido = table.row('.selected').id();
        console.log(id_pedido);
    } );
    $('#area_aquipo_historico').change(function () {
        var id_equipo = $(this).val();
              
        get_sub_area_equipo(id_equipo);
    });
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
    $("#tabla_visor_solicitudes").toggle(400);
    $("#card_solicitud_detail").toggle(400);
    $("#expand_menu_lateral").click();
    $("#div_seach_article").show();
}
function closeModalSolicitudDetail(){
    var table_pedido = $('#tabla_pedidos').DataTable();
    table_pedido.column(5).visible(true);
    table_pedido.clear().draw();
    $('#sub_area_aquipo').empty().trigger("change");
    $("#tabla_visor_solicitudes").toggle(400);
    $("#card_solicitud_detail").toggle(400);
    $("#expand_menu_lateral").click();
    $("#sidebar_sticky").hide();
    $("#sidebar_sticky_article").hide();
    $("#div_seach_article").hide();
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
            $("#solicitante").html(data.nombre_solicitante + " ("+ data.puesto_solicitante + ")");
            $("#area_aquipo").html(data.nombre_generico + ", " + data.sitio_operacion);
            $("#fecha_actual").html(data.fecha);
            $("#name_coordinacion").html(data.coordinacion_up + ":");
            $("#modal_large").data("idequipo",data.id_equipo);
            
            if(data.firm_planeacion == 0){
                $("#firm_planeacion")
                    .removeClass("badge-success badge-danger")
                    .addClass("border-primary-300 alpha-primary text-primary-800")
                    .data({idempleado:data.firm_planeacion,nuevafirma:""})
                    .text("Firmar solicitud");
                $("#guarda_cambios_solicitud").show();
            }else{
                $("#firm_planeacion")
                    .removeClass("badge-danger border-primary-300 alpha-primary text-primary-800")
                    .addClass("badge-success")
                    .data({idempleado:data.firm_planeacion,nuevafirma:""})
                    .text("Revisado");
                $("#guarda_cambios_solicitud").hide();
            }
            
            if(data.firm_coordinacion == 0){
                $("#firm_coordinacion")
                    .removeClass("badge-success bg-orange")
                    .addClass("bg-orange")
                    .text("Pendiente");
            }else{
                $("#firm_coordinacion")
                    .removeClass("bg-orange badge-success")
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
            t.clear().draw(false);
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.cantidad_plan,
                    value.unidad,
                    value.articulo,
                    value.status_pedido,
                    value.justificacion,
                    value.comentarios
                ]).node().id = value.id_pedido;
                t.draw( false );
            });
        },
        complete: (function () {
            if( $("#firm_planeacion").data("idempleado") > 0 ){
                $(".input-cantidad-coord").attr('disabled', true);
                if( $("#firm_planeacion").data("nuevafirma") == "new" ){
                    $("#guarda_cambios_solicitud").show();
                }else{
                    $("#guarda_cambios_solicitud").hide();
                }
                $('.icon-pencil').hide();
            }else{
                $('.icon-pencil').show();
            }
        })
    });
}
function getAlmacenSearch(){
    var filter = $("#buscar_en_tabla_layoutx").val();
    var table  = $("#search_article").DataTable();
    $.ajax({
        data:{filter:filter},
        url: 'json_selectAlmacenFilter.php',
        type: 'POST',
        beforeSend: function (xhr){
            table.clear().draw();
        },
        success: function (obj) {
            $.each(obj, function (index, value){
                table.row.add([
                    value.descripcion,
                    value.stock2
                ]).node().id = value.cod_articulo;
                table.draw( false );
            });
        }
    });
}
function guarda_cantidad_coord(id_pedido,cantidad){
    var columna = "cantidad_plan";
    var columna2 = "cantidad_pendiente";
    var firma_plan = $("#firm_planeacion").data("idempleado");
    
    if (firma_plan == "0"){
        $.post( "json_update_cantidad.php",{ id_pedido:id_pedido, cantidad:cantidad, columna:columna }).done(function( data ) {
            console.log("Guardo exitoso: id_pedido:" + id_pedido + " , cantidad:" + cantidad + " , columna:" + columna + " data:" + data);
        });
    }else{
        $.post( "json_update_cantidad.php",{ id_pedido:id_pedido, cantidad:cantidad, columna:columna }).done(function( data ) {
            console.log("Guardo exitoso: id_pedido:" + id_pedido + " , cantidad:" + cantidad + " , columna:" + columna + " data:" + data);
        });
        $.post( "json_update_cantidad.php",{ id_pedido:id_pedido, cantidad:cantidad, columna:columna2 }).done(function( data ) {
            console.log("Guardo exitoso: id_pedido:" + id_pedido + " , cantidad:" + cantidad + " , columna:" + columna2 + " data:" + data);
        });
    }
}
function firma_solicitud(){
    if($("#firm_planeacion").data("idempleado") == 0){
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
    $("#firm_planeacion")
            .data({idempleado:id_empleado,nuevafirma:"new"})
            .removeClass("badge-danger border-primary-300 alpha-primary text-primary-800")
            .addClass("badge-success")
            .text("Revisado");
 }
function set_firma_coord(){
    if($('#firm_planeacion').data('nuevafirma') == 'new'){
        var firma       = $('#firm_planeacion').data('idempleado');
        var folio       = $('#tabla_pedidos').data('folio');
        var column_firm = 'firm_planeacion';
        var column_date = 'fecha_firm_planeacion';
        
        $.post('json_update_firma_coord.php',{firma:firma,folio:folio,column_firm:column_firm,column_date:column_date}).done(function( data ) {
            if(data.result = "exito"){
                alert("La solicitud fue actualizada correctamente!");
                $('#firm_planeacion')
                    .removeClass('border-primary-300 alpha-primary text-primary-800')
                    .addClass('badge-success')
                    .data('nuevafirma','')
                    .text('Revisado');
            }
        });
    }
}
function get_comentario(id_pedido){
    $ ('#conent_coment_area').find('li').remove();
    $ ('#conent_coment_area').find('div').remove();
    var id_empleado = $('#user_session_id').data("employeid");
    $.post( "json_getComentarioPedido.php",{ id_pedido:id_pedido,id_empleado:id_empleado}).done(function( data ) {
        $.each(data, function (index, value) {
            $("#conent_coment_area").append(value.comentario);
        });
        $("#scrollxy").animate({ scrollTop: $('#scrollxy')[0].scrollHeight}, 300);
    });
}
function send_comentario(){
    var txt_comt = $("#text_comentario");
    var comentario = txt_comt.val();
    
    if(comentario != ""){
        var id_pedido = txt_comt.data("idpedido");
        var id_empleado = $('#user_session_id').data("employeid");
        var msj = "<li class='media media-chat-item-reverse'>\
                        <div class='media-body'>\
                            <div class='media-chat-item'>"+comentario+"</div>\
                            <div class='font-size-xs mt-2' style='color:blue;'>Ahora</div>\
                        </div>\
                        <div class='ml-3'></div>\
                    </li>";
        //alert("Comentario: "+comentario+", Id_pedido: "+id_pedido+", Id_empleado: "+id_empleado);
        $.post('json_insertComentario.php',{comentario:comentario,id_empleado:id_empleado,id_pedido:id_pedido}).done(function( data ) {
            if(data.result = "ok"){
                txt_comt.val("");
                $("#conent_coment_area").append(msj).show('slow');
                $("#scrollxy").animate({ scrollTop: $('#scrollxy')[0].scrollHeight}, 300);
            }else{
                alert("Error al guardar comentario");
            }
        });
    }
}
function openCardComent(id_pedido){
    var tbl = $('#tabla_pedidos');
    $("#text_comentario").data("idpedido",id_pedido);
    get_comentario(id_pedido);
    $("#sidebar_sticky").show();
    //tbl.DataTable().column(5).visible(false);
    $("#scrollxy").animate({ scrollTop: $('#scrollxy')[0].scrollHeight}, 300);
}
function closeCardComent(){
    var folio = $("#modal_large").data("folio");
    getSolicitudDetail_pedido(folio);
    var tbl = $('#tabla_pedidos');
    //tbl.DataTable().column(5).visible(true);
    $("#sidebar_sticky").hide();
}
function showAlmacenLateral(){
    $("#sidebar_sticky_article").toggle("slow");
}
function openModalEditArticle(e){
    var inp = e.target;
    var idpedido = $(inp).data("idpedido");
    var articulo = $(inp).data("articulo");
    var codarticulo = $(inp).data("codarticulo");
    var unidad = $(inp).data("unidad");
    var cantidad = $('#cantidad_'+idpedido).val();
    var justifi = $(inp).data("justificacion");
    var firm_plan = $('#firm_planeacion').data('idempleado');
    var firm_coord = $('#firm_coordinacion').data('idempleado');
    
    $("#modal_large").data("idpedido",idpedido);
    $('#cod_articulo').val(codarticulo);
    $('#descripcion').val(articulo);
    $('#unidad').val(unidad).trigger('change');
    $('#motivo').val(justifi);
    $('#cantidad').val(cantidad);
    
    $('#cod_articulo_sub').html(codarticulo);
    $('#descripcion_sub').html(articulo);
    $('#unidad_sub').html(unidad);
    $('#motivo_sub').html(justifi);
    $('#cantidad_sub').html(cantidad);
    if( codarticulo != "" ){
        $("#unidad").attr('disabled', true);
    }else{
        $("#unidad").attr('disabled', false);
    }
    if(firm_plan != '0'){
        $("#reset_modal_update").hide();
        $("#guarda_modal_update").hide();
    }else{
        $("#reset_modal_update").show();
        $("#guarda_modal_update").show();
    }
    $("#modal_large").modal("show");    
}
function updateArticle(){
    var cod_articulo = $('#cod_articulo').val();
    var articulo = $('#descripcion').val();
    var justifi = $('#motivo').val();
    var cantidad = $('#cantidad').val();
    var user =  $('#cantidad').data('user');
    var unidad = $('#unidad').val();
    var id_pedido = $("#modal_large").data("idpedido");
        
    $.post( "update_pedidoDetail.php",{ id_pedido:id_pedido,cod_articulo:cod_articulo,articulo:articulo,unidad:unidad,justifi:justifi,cantidad:cantidad,user:user}).done(function( data ) {
        var folio = $('#modal_large').data('folio');
        getSolicitudDetail_pedido(folio);
        closeModalUpArticle();
    });
}
function closeModalUpArticle(){
    $('#cod_articulo').val("");
    $('#descripcion').val("");
    $('#motivo').val("");
    $('#cantidad').val("");
    $('#unidad').val(null).trigger('change');
    $("#select_article").val(null).trigger('change');
    
    $('#cod_articulo_sub').html("");
    $('#descripcion_sub').html("");
    $('#motivo_sub').html("");
    $('#cantidad_sub').html("");
    $('#unidad_sub').html("");
    
    $("#modal_large").modal("hide");
}
function clearCodArticle(){
    var a1 = $('#descripcion').val();
    var a2 = $('#descripcion_sub').html();
    
    if( a1 == a2){
        resetModal();
    }else{
        $('#cod_articulo').val("");
        $("#unidad").attr('disabled', false);
    }
}
function resetModal(){
    var cod_articulo_sub = $('#cod_articulo_sub').html();
    var descripcion_sub = $('#descripcion_sub').html();
    var unidad_sub = $('#unidad_sub').html();
    var motivo_sub = $('#motivo_sub').html();
    var cantidad_sub = $('#cantidad_sub').html();
    
    $('#cod_articulo').val(cod_articulo_sub);
    $('#descripcion').val(descripcion_sub);
    $('#motivo').val(motivo_sub);
    $('#cantidad').val(cantidad_sub);
    $('#unidad').val(unidad_sub).trigger('change');
    
    if( cod_articulo_sub != "" ){
        $("#unidad").attr('disabled', true);
    }else{
        $("#unidad").attr('disabled', false);
    }
}
function openMiniModalStatus(e){
    var obj = e.target;
    var idpedido = $(obj).data('idpedido');
    var idempleado = $('#firm_planeacion').data('idempleado');
    if(idempleado == '0'){
        $("#status_pedido").data("idpedido",idpedido);
        $("#status_pedido").modal("show");
    } 
}
function saveStatusItems(e){
    var obj = e.target;
    var idpedido = $("#status_pedido").data("idpedido");
    var status = $(obj).data("status");
    var comentario = $(obj).data("statustxt");
    var txt_comt = $("#text_comentario");
    
    $.post( "update_pedidoStatus.php",{ id_pedido:idpedido,status:status}).done(function( data ) {
        var folio = $('#modal_large').data('folio');
        getSolicitudDetail_pedido(folio);
        $("#status_pedido").modal("hide");
    });
    
    if(comentario != ""){
        var id_empleado = $('#user_session_id').data("employeid");
        var msj = "<li class='media content-divider justify-content-center text-blue-800 mx-0'>\
                        <span class='px-2'>"+comentario+"</span>\
                    </li><div class='font-size-xs mt-2 text-muted text-right'>Ahora</div>";
        $.post('json_insertComentario.php',{comentario:'::status::'+comentario,id_empleado:id_empleado,id_pedido:idpedido}).done(function( data ) {
            if(data.result = "ok"){
                txt_comt.val("");
                $("#conent_coment_area").append(msj).show('slow');
                $("#scrollxy").animate({ scrollTop: $('#scrollxy')[0].scrollHeight}, 300);
            }else{
                alert("Error al guardar comentario");
            }
        });
    }
}
function reloadTableDetail(){
    var folio = $('#tabla_pedidos').data("folio");
    var table = $('#tabla_pedidos').DataTable({
        ajax: {
                data: {folio:folio}
            },
        columns: [
            {data : 'cantidad_plan'},
            {data : 'unidad'},
            {data : 'articulo'},
            {data : 'status_pedido'},
            {data : 'justificacion'},
            {data : 'comentarios'}
        ]
    });
    console.log(folio);
    table.ajax.reload();
}
function OpenHistoric(){
    $("#historico_pedido").modal("show");
}