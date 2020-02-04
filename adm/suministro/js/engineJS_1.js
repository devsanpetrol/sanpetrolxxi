$(document).ready( function () {
    $('.pickadate-accessibility').pickadate({
        labelMonthNext: 'Go to the next month',
        labelMonthPrev: 'Go to the previous month',
        labelMonthSelect: 'Pick a month from the dropdown',
        labelYearSelect: 'Pick a year from the dropdown',
        selectMonths: true,
        selectYears: true
    });
    $('#datatable_invoice_detail').DataTable({
        autoWidth: false,
        responsive: {
            details: {
                type: 'column'
            }
        },
        bDestroy: true,
        columnDefs: [{
            orderable: false,
            width: '25%',
            targets: [ 2 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Buscar...',
            lengthMenu: '<span>Mostrar </span> _MENU_ <span>elementos</span>',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros",
            paginate: { 
                first: "Primero",
                last:  "Último",
                next:  "Siguiente",
                previous: "Anterior"
            }
        }
    });
    $('.form-control-select2').select2();
    
} );

function hide_showNewInvoice(){
    $( ".card-new-invoice" ).toggle("slow","swing");
}
function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}