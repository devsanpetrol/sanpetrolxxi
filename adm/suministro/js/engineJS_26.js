$(document).ready( function () {
    hoy();
    $('#filtro_fecha_inicio').val("");
    $('#filtro_fecha_fin').val("");
    $("body").addClass("sidebar-xs");
    $(".reporte-entrada").addClass("active");
    $(".reporte-entrada i").addClass("text-orange-800");
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5'
        ],
        ajax: {
            url: "json_selectFacturaEdita.php",
            type:"POST",
            data:{fecha_inicio:function(){return $('#filtro_fecha_inicio').val();},fecha_fin:function(){return $('#filtro_fecha_fin').val();}},
            dataSrc:function ( json ) {
                return json;
            }
        },
        rowGroup: {
            dataSrc: 'proveedor' //Folio: ### Nombre Proveedor, Serie-Folio Factura, Total,
        },
        columns: [
            {data : 'fecha_emision'},
            {data : 'cod_articulo'},
            {data : 'descripcion'},
            {data : 'marca'},
            {data : 'cantidad'},
            {data : 'tipo_unidad'},
            {data : 'precio_unidad'},
            {data : 'subtotal'}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Busqueda...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    
    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment(),
            endDate: moment(),
            ranges: {
                'Hoy': [moment(), moment()],
                'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
                'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
                'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                startLabel: 'Inicio',
                endLabel: 'Fin',
                customRangeLabel: 'Rango Personalizado',
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie','Sab'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                firstDay: 1
            },
            opens: 'left',
            applyClass: 'btn-sm bg-teal',
            cancelClass: 'btn-sm bg-slate-600'
        },
        function(start, end) {
            $('.daterange-ranges span').html(start.format('DD MMM YYYY') + ' &nbsp; / &nbsp; ' + end.format('DD MMM YYYY'));
            $('#filtro_fecha_inicio').val(start.format('YYYY-MM-DD'));
            $('#filtro_fecha_fin').val(end.format('YYYY-MM-DD'));
            updateDataTable();
        }
    );
    $(".fecha-rango").appendTo(".dt-buttons");
    // Display date format
    $('.daterange-ranges span').html(moment().format('DD MMM YYYY') + ' &nbsp; / &nbsp; ' + moment().format('DD MMM YYYY'));
} );
 function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}

function  hoy(){
    $.post('json_now.php',function(res){
        $('#filtro_fecha_inicio').val(res.fecha_corta);
        $('#filtro_fecha_fin').val(res.fecha_corta);
        
        updateDataTable();
    });
 }
 function updateDataTable(){
    var table = $('#almacen_tabla').DataTable();
    table.ajax.reload();
 }
 function openModalFacturaDetail(e){
    var obj = e.target;
    var id_factura = $(obj).data('idfactura');
    getFacturaDetail(id_factura);
    getFacturaDetail_list(id_factura);
}
function getFacturaDetail(id_factura){
    $.ajax({
        data:{id_factura:id_factura},
        url: 'json_selectFacturaInf.php',
        type: 'POST',
        beforeSend: function (xhr){
            console.log("Actualizando..." + id_factura);
        },
        success: function (obj) {
            var data = obj[0];
            
            $("#view_date_insert").html(data.date_insert);
            $("#view_fecha_emision").html(data.fecha_emision);
            $("#view_lugar_emision").html(data.lugar_emision);
            $("#view_nombre").html(data.nombre);
            $("#view_rfc").html(data.rfc);
            $("#view_direccion").html(data.direccion);
            $("#view_num_telefono").html(data.num_telefono);
            $("#view_email").html(data.email);
            $("#view_pagina_web").html(data.pagina_web);
            $("#view_serie_folio").html(data.serie_folio);
            $("#view_uuid").html(data.uuid);
            $("#view_total").html(data.total);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function getFacturaDetail_list(id_factura){
    var t = $('#table_DetailDocumento').DataTable();
    $.ajax({
        data:{id_factura:id_factura},
        url: 'json_selectFacturaDetailEdita.php',
        type: 'POST',
        beforeSend: function (xhr){
            t.clear().draw();
        },
        success: function (obj) {
            $.each(obj, function (index, value) {
                t.row.add([
                    value.articulo,
                    value.cantidad,
                    value.unidad,
                    value.precio_unidad,
                    value.total
                ]);
                t.draw( false );
                console.log("Agrego: "+index);
            });
        },
        complete: (function () {
            $('#invoice').modal('show');
        })
    });
}
function exitDetailFactura(){
    $('#invoice').modal('hide');
    $("#view_date_insert").html("");
    $("#view_fecha_emision").html("");
    $("#view_lugar_emision").html("");
    $("#view_nombre").html("");
    $("#view_rfc").html("");
    $("#view_direccion").html("");
    $("#view_num_telefono").html("");
    $("#view_email").html("");
    $("#view_pagina_web").html("");
    $("#view_serie_folio").html("");
    $("#view_uuid").html("");
    $("#view_total").html("");
    var t = $('#table_DetailDocumento').DataTable();
    t.clear().draw();
    updateDataTable();
}
function guardaCostoUnitario(){
    $( ".precioxunidad" ).each(function( index ) {
        sendValServer($(this).data("idfactura"),$( this ).data("iddetallefactura"),$( this ).val());
    }).promise().done( function(){ 
        alert("Completado con exito.");
        exitDetailFactura();
    } );
}
function sendValServer(id_factura,id_detalle_factura,costo){
    $.post('json_updateFacturaCostoUnidad.php',{id_factura:id_factura,id_detalle_factura:id_detalle_factura,costo:costo},function(res){
        console.log(res[0].id + ":" + res[0].result);
        if(res[0].result == "exito"){
            console.log("Completado con exito.");
        }
        else if(res[0].result == "fallo"){
            alert("Ocurrió un error durando el proceso.");
        }
    });
}