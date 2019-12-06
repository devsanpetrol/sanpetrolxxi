$(document).ready( function () {
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
} );