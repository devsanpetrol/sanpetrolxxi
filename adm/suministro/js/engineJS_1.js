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
    $('#table_inventarioitems').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ) {
            $('td', row).eq(0).addClass('font-weight-semibold text-blue-800');
            $('td', row).eq(1).addClass('font-weight-semibold text-blue-800');
            $('td', row).eq(2).addClass('font-weight-semibold');
            $('td', row).eq(3).addClass('font-weight-semibold');
            $('td', row).eq(4).addClass('font-weight-semibold');
        },
        language: {
            zeroRecords: "Ningun elemento agregado"
        }
    });
    $("#rfc").on('keyup', function (e){
        var searchTerm = $('#rfc').val();
        if (e.keyCode === 13){
           $.ajax({
            url: 'json_rfc.php',
            data:{ searchTerm:searchTerm },
            type: 'POST',
            success:(function(res){
                $('#nombreempresa').val(res.nombre);
                $('#domicilioempresa').val(res.direccion);
                $('#codigopostal').val(res.codigopostal);
                $('#telefono').val(res.telefono);
                $('#correo').val(res.correo);
                })
            });
        }
    }).bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#i_preciounidad").bind('keypress', function(event) {
        var regex = new RegExp("^[0-9 ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#i_cantidad").bind('keypress', function(event) {
        var regex = new RegExp("^[0-9 ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
} );

function addElementToTable(){
    if($('#i_codigoinventario').val() != "" && $('#i_descripcion').val() != "" && $('#i_cantidad').val() != "" && $('#i_preciounidad').val() != ""){
        var cant = $('#i_cantidad').val();
        var puni = $('#i_preciounidad').val();
        var totl = cant * puni;
        console.log(totl);
        var t = $('#table_inventarioitems').DataTable();
        t.row.add( [
            $('#i_codigoinventario').val(),
            $('#i_descripcion').val(),
            $('#i_cantidad').val(),
            $('#i_preciounidad').val(),
            totl
        ] ).draw( false );
    }    
}
function hide_showNewInvoice(){
    $( ".card-new-invoice" ).toggle("slow","swing");
}
function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}