$(document).ready( function () {
    var user_session_id = $('#user_session_id').data("employeid");
    $('.form-control-select2').select2();
    
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
            $('#descripcion').prop('readonly', true);
            $('#unidad').prop('disabled', true);
        }else{
            $('#descripcion').prop('readonly', false);
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
    $('.sidebar-sticky .sidebar').stick_in_parent({
        offset_top: 20,
        parent: '.content'
    });
        // Detach on mobiles
    $('.sidebar-mobile-component-toggle').on('click', function() {
        $('.sidebar-sticky .sidebar').trigger("sticky_kit:detach");
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
}
function closeModalSolicitudDetail_user(){
    var table_pedido = $('#tabla_pedidos').DataTable();
    table_pedido.clear().draw();
    $('#sub_area_aquipo').empty().trigger("change");
    $("#tabla_visor_solicitudes").toggle(400);
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
            
            if(data.firm_coordinacion == 0){
                $("#firm_coordinacion")
                    .removeClass("badge-success badge-danger")
                    .addClass("badge-warning")
                    .data({idempleado:data.firm_coordinacion,nuevafirma:""})
                    .text("Sin revisión");
            }else{
                $("#firm_coordinacion")
                    .removeClass("badge-success badge-danger")
                    .addClass("badge-success")
                    .data({idempleado:data.firm_coordinacion,nuevafirma:""})
                    .text("Revisado");
                $("#guarda_cambios_solicitud").hide();
                $("#addItemSolicitud").hide();
            }
            
            if(obj[0]["firm_planeacion"] == 0){
                $("#firm_planeacion")
                    .removeClass("badge-success badge-warning")
                    .addClass("badge-warning")
                    .text("Sin revisión");
            }else{
                $("#firm_planeacion")
                    .removeClass("badge-warning badge-success")
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
        url: 'json_selectSolicitudDetail_pedidos_user.php',
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
                    value.status_pedido,
                    value.justificacion,
                    value.comentarios
                ]).node().id = value.id_pedido;
                t.draw( false );
            });
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
            $('.icon-pencil').hide();
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



function get_sub_area_equipo(id_equipo){
    $.ajax({
    type: "POST",
    url: 'json_destinoSuministro_sub.php',
    data:{ id_equipo:id_equipo },
    dataType: "json",
    success: function(data){
        $.each(data,function(key, registro) {
            $("#sub_area_aquipo").append("<option value='"+registro.id_sub_area+"'>"+registro.nombre_sub_area+"</option>");
        });
    },
    error: function(data){
      alert('error');
    }
  });
}









