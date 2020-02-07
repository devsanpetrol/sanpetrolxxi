$(document).ready( function () {
    get_categoria();
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
        },
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), total, pageTotal;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $("#total").val("$ "+ total);
            //$( api.column( 4 ).footer() ).html('$'+pageTotal +' ( $'+ total +' total)');
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
        mybind(event,"^[a-zA-Z0-9 ]|[\.]+$");
    });
    $("#i_preciounidad").bind('keypress', function(event) {
        mybind(event,"^[0-9 ]|[\.]+$");
    });
    $("#i_cantidad").bind('keypress', function(event) {
        mybind(event,"^[0-9 ]|[\.]+$");
    });
    $("#i_codigoinventario").on('keyup', function (e){
        var searchTerm = $('#i_codigoinventario').val();
        if (e.keyCode === 13){
            searchTermn(searchTerm);
        }
    }).bind('keypress', function(event) {
        mybind(event,"^[a-zA-Z0-9 ]|[\.]+$");
    });
    $("#i_codigobarra").on('keyup', function (e){
        var searchTerm = $('#i_codigobarra').val();
        if (e.keyCode === 13){
            searchTermn(searchTerm);
        }
    }).bind('keypress', function(event) {
        mybind(event,"^[a-zA-Z0-9 ]|[\.]+$");
    });
} );

function addElementToTable(){
    if($('#i_codigoinventario').val() != "" && $('#i_descripcion').val() != "" && $('#i_cantidad').val() != "" && $('#i_preciounidad').val() != ""){
        var cant = $('#i_cantidad').val();
        var puni = $('#i_preciounidad').val();
        var totl = cant * puni;
        var t = $('#table_inventarioitems').DataTable();
        t.row.add( [
            $('#i_codigoinventario').val(),
            $('#i_descripcion').val(),
            $('#i_cantidad').val(),
            $('#i_preciounidad').val(),
            totl
        ] ).draw( false );
        borrar_input_nuevoArticulo();
    }    
}
function hide_showNewInvoice(){
    $( ".card-new-invoice" ).toggle("slow","swing");
}
function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}
function mybind(event,expReg){
    var regex = new RegExp(expReg);
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
}
function searchTermn(searchTerm){
    $.ajax({
        url: 'json_codigosearch.php',
        data:{ searchTerm:searchTerm },
        type: 'POST',
        success:(function(res){
            $('#i_codigobarra').val(res.cod_barra);
            $('#i_codigoinventario').val(res.cod_articulo);
            $('#i_descripcion').val(res.descripcion);
        })
    });
}
function borrar_input_nuevoArticulo(){
    $(".input-newarticle").val("");
}
function clearDatatable(){
    var table = $('#table_inventarioitems').DataTable();
    table.clear().draw();
}
function  get_categoria(){
    $.ajax({
    type: "GET",
    url: 'json_selectCategoria.php', 
    dataType: "json",
    success: function(data){
      $.each(data,function(key, registro) {
        $("#select_categoria").append("<option value='"+registro.id_categoria+"' data-resp='"+registro.id_empleado_resp+"' data-nombre='"+registro.nombre+"' data-apellidos='"+registro.apellidos+"'>"+registro.categoria+"</option>");
      });
    },
    error: function(data) {
      alert('error');
    }
  });
}