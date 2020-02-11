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
    $('#select_categoria').change(function(){
        var id_categoria = $(this).val();
        $.ajax({
            url: 'json_inventariar_cat.php',
            data:{ id_categoria:id_categoria },
            type: 'POST',
            success:(function(res){
                $('#new_cod_inventario').val(res.cod_articulo);
            })
        });
    });
    $('#table_inventarioitems').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ) {
            $('td', row).eq(0).addClass('font-weight-semibold text-blue-800');
            $('td', row).eq(1).addClass('font-weight-semibold text-blue-800');
            $('td', row).eq(2).addClass('font-weight-semibold text-right');
            $('td', row).eq(3).addClass('font-weight-semibold text-right');
            $('td', row).eq(4).addClass('font-weight-semibold text-right');
        },
        language: {
            zeroRecords: "Ningun elemento agregado"
        },
        columnDefs: [
            {targets: 0,width: '15%'},
            {targets: 1,width: '40%'},
            {targets: 2,width: '15%'},
            {targets: 3,width: '15%'},
            {targets: 4,width: '15%'}
        ],
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
    }).on('keyup', function (e){
        if (e.keyCode === 13){
            var pru = $("#i_preciounidad").val();
            if(pru !== ""){
                addElementToTable();
            }
        }
    });
    $("#i_cantidad").bind('keypress', function(event) {
        mybind(event,"^[0-9 ]|[\.]+$");
    }).on('keyup', function (e){
        if (e.keyCode === 13){
            var cant = $("#i_cantidad").val();
            if(cant !== ""){
                $('#i_preciounidad').focus();
            }
        }
    });
    $("#i_codigoinventario").on('keyup', function (e){
        var searchTerm = $('#i_codigoinventario').val();
        if(searchTerm !== ""){
            if (e.keyCode === 13){
                searchTermn(searchTerm);
            }
        }
    }).bind('keypress', function(event) {
        mybind(event,"^[a-zA-Z0-9 ]|[\.]+$");
    });
    $("#i_codigobarra").on('keyup', function (e){
        var searchTerm = $('#i_codigobarra').val();
        if(searchTerm !== ""){
            if (e.keyCode === 13){
                searchTermn(searchTerm);
            }
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
        $('#i_codigobarra').focus();
    }    
}
function addArticle(use){
    var cod_barra = $("#new_codigobarra").val();
    var cod_articulo = $("#new_cod_inventario").val();
    var descripcion = $("#new_descripcion").val();
    var especificacion = $("#new_especificacion").val();
    var tipo_unidad = $("#new_tipounidad").val();
    var marca = $("#new_marca").val();
    var id_categoria = $("#select_categoria").val();
    
    $.ajax({
        url: 'json_addArticle.php',
        data:{ cod_articulo:cod_articulo, cod_barra:cod_barra, descripcion:descripcion, especificacion:especificacion, tipo_unidad:tipo_unidad, marca:marca, id_categoria:id_categoria },
        type:'POST',
        beforeSend : function(xhr, opts){
            if(validar_newArticulo() == false){
                xhr.abort();
            }
        },
        success:(function(res){
            if(use){
                $('#i_codigobarra').val(cod_barra);
                $('#i_codigoinventario').val(cod_articulo);
                $('#i_descripcion').val(descripcion);
            }
            salir_sin_guardar();
        })
    });
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
            if(res.cod_articulo !== ""){
                $('#i_cantidad').focus();
            }
        })
    });
}
function get_categoria(){
    $.ajax({
    type: "GET",
    url: 'json_selectCategoria.php', 
    dataType: "json",
    success: function(data){
        $.each(data,function(key, registro) {
            $("#select_categoria").append("<option value='"+registro.id_categoria+"'>"+registro.categoria+"</option>");
        });
    },
    error: function(data){
      alert('error');
    }
  });
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
function borrar_input_nuevoArticulo(){
    $(".input-newarticle").val("");
}
function clearDatatable(){
    var table = $('#table_inventarioitems').DataTable();
    table.clear().draw();
}
function salir_sin_guardar(){
    $('#article_new').modal('hide');
    $('#msj_alert1').hide();
    limpiar_form();
}
function limpiar_form(){
    $('#new_tipounidad').val(null).trigger('change');
    $('#select_categoria').val(null).trigger('change');
    $("#new_codigobarra").val("");
    $("#new_cod_inventario").val("");
    $("#new_descripcion").val("");
    $("#new_especificacion").val("");
    $("#new_marca").val("");
    $('#msj_alert1').hide();
}
function validar_newArticulo(){
    if($('#new_tipounidad').val() != null && $('#select_categoria').val() != null && $('#new_descripcion').val() != '' && $("#new_marca").val() != ''){
        $('#msj_alert1').hide();
        return true;
    }else{
        $('#msj_alert1').show(200);
        return false;
    }
}
function close_alert(){
    $('#msj_alert1').hide();
}