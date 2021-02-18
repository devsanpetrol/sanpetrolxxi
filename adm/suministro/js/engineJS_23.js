$(document).ready( function () {
    hoy();
    $('#filtro_fecha_inicio').val("");
    $('#filtro_fecha_fin').val("");
    $('.form-control-select2').select2();
    $("body").addClass("sidebar-xs");
    $(".reporte-salida").addClass("active");
    $(".reporte-salida i").addClass("text-orange-800");
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5'
        ],
        ajax: {
            url: "json_selectReporteSalida.php",
            type:"POST",
            data:{fecha_inicio:function(){return $('#filtro_fecha_inicio').val();},fecha_fin:function(){return $('#filtro_fecha_fin').val();}},
            dataSrc:function ( json ) {
                return json;
            }
        },
        columnDefs: [
            //{targets:6,className: "text-center"}
        ],
        columns: [
            {data : 'nombre_categoria'},
            {data : 'cod_articulo'},
            {data : 'descripcion'},
            {data : 'cantidad'},
            {data : 'tipo_unidad'},
            {data : 'recibe'}
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