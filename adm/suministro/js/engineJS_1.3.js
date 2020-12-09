$(document).ready( function () {
    var milisegundos = 120 *1000;
    setInterval(function(){
        fetch("./session_ref.php");
    },milisegundos);
    $(".fab-menu-bottom-right").hide();
    get_categoria();
    $(".detalle_factura").addClass("active");
    $(".detalle_factura i").addClass("text-orange-800");
    $("body").addClass("sidebar-xs");
    $('.pickadate-accessibility').pickadate({
        labelMonthNext: 'Go to the next month',
        labelMonthPrev: 'Go to the previous month',
        labelMonthSelect: 'Pick a month from the dropdown',
        labelYearSelect: 'Pick a year from the dropdown',
        selectMonths: true,
        selectYears: true
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
            $('td', row).eq(5).addClass('font-weight-semibold text-center');
        },
        language: {
            zeroRecords: "Ningun elemento agregado"
        },
        columnDefs: [
            {targets: 0,width: '15%'},
            {targets: 1,width: '45%'},
            {targets: 2,width: '15%'},
            {targets: 3,width: '10%'},
            {targets: 4,width: '10%'},
            {targets: 5,width: '5%'},
            {targets: 6,visible:false}
        ]
    });
    $('#proveedor_tabla_aplica').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        ajax: {
            url: "json_proveedor_aplica.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'nombre'},
            {data : 'rfc'},
            {data : 'accion'}
        ],
        rowGroup: {
            //dataSrc: 'grupo'
        },
        columnDefs: [
            //{targets:0, visible:false}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Buscar proveedor...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $('#articulo_tabla_aplica').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        ajax: {
            url: "json_articulo_aplica.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'cod_articulo'},
            {data : 'descripcion'},
            {data : 'categoria'},
            {data : 'accion'}
        ],
        rowGroup: {
            //dataSrc: 'grupo'
        },
        columnDefs: [
            //{targets:0, visible:false}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Buscar proveedor...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $('#datatable_invoice_detail').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[10, 20, 40], [10,20, 40]],//-1 = all
        order: [[ 0, 'desc' ]],
        ajax: {
            url: "json_selectFactura.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'id_factura'},
            {data : 'periodo'},
            {data : 'proveedor'},
            {data : 'fecha_emision'},
            {data : 'total'},
            {data : 'accion'}
        ],
        rowGroup: {
            //dataSrc: 'grupo'
        },
        columnDefs: [
            //{targets:0, visible:false}
        ],
        createdRow: function ( row, data, index ) {
            $('td', row).eq(5).addClass('text-center');
            $('td', row).eq(0).addClass('text-danger');
        },
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Buscar...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    $('#table_DetailDocumento').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        info: false,        
        createdRow: function ( row, data, index ){
            $('td', row).eq(1).addClass('text-right');
            $('td', row).eq(2).addClass('text-right');
            $('td', row).eq(3).addClass('text-right');
            $('td', row).eq(4).addClass('text-right');
            $(row).addClass('pointer font-weight-semibold text-grey');
        },
        columnDefs: [
            {targets:0,className: "dt-center"}
        ],
        language: {
            zeroRecords: "Ningun elemento relaciondo"
        }
    });
    var table = $('#table_inventarioitems').DataTable();
 
    $('#table_inventarioitems tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#delsel').click( function () {
        if(confirm("Se eliminara el elemento seleccionado.")){
            table.row('.selected').remove().draw( false );
            sumCoulumns();
        }
    } );
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
function simulEnter(){
    var searchTerm = $('#i_codigoinventario').val();
        if(searchTerm !== ""){
            searchTermn(searchTerm);
        }
}
function addElementToTable(){
    if($('#i_codigoinventario').val() != "" && $('#i_descripcion').val() != "" && $('#i_cantidad').val() != "" && $('#i_preciounidad').val() != ""){
        var cant = $('#i_cantidad').val();
        var puni = $('#i_preciounidad').val();
        var totl = cant * puni;
        var t = $('#table_inventarioitems').DataTable();
        
        t.row.add( [
            $('#i_codigoinventario').val(), //0
            $('#i_descripcion').val(),      //1
            $('#i_cantidad').val(),         //2
            round($('#i_preciounidad').val()),//3
            '<input type="text" class="form-control font-weight-semibold text-danger sub-total-items text-right" readonly value="'+FormatCurrency(round(totl))+'" data-subtotal="'+round(totl)+'">',
            '',//5
            round(totl)//6
        ] ).draw( false );
        borrar_input_nuevoArticulo();
        sumCoulumns();
        $('#i_codigobarra').focus();
    }    
}
function round(value) {
    return Number(Math.round(value + 'e' + 2) + 'e-' + 2);
}
function getDateUno(){
    $("#foliodate").text();
    alert($("#foliodate").text());
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
    type: "POST",
    url: 'json_selectCategoria.php',
    data:{ tipo:1 },
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
    var visible = $( ".card-new-invoice" ).is(":visible");
    if(visible){
      $(".fab-menu-bottom-right").slideUp("slow");
    }else{
        $(".fab-menu-bottom-right").slideDown("slow");
    }
    $( ".card-new-invoice" ).toggle("slow","swing");
}
function hide_showNewProveedor(){
    $("#cardnewprov" ).toggle("fast","swing");
    $("#btnmouestranewpro" ).toggle("fast","swing");
    $("#formnewprov")[0].reset();
    close_alert2();
}
function hide_showModalNewProv(){
    $("#busca_proveedor" ).modal("hide");
    $("#cardnewprov" ).hide();
    $("#btnmouestranewpro" ).show();
    $("#formnewprov")[0].reset();
    close_alert2();
}
function hide_showModalNewArt(){
    $("#busca_articulo" ).modal("hide");
    simulEnter();
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
function close_alert2(){
    $('#msj_alert2').hide();
}
function get_proveedor(e){
    var obj = e.target;
    var id = $(obj).data('id');
    var nombre = $(obj).data('nombre');
    var rfc = $(obj).data('rfc');
    $("#rfc").val(rfc);
    $("#rfc").data("idproveedor",id);
    $("#nombreempresa").val(nombre);
}
function get_articulo(e){
    var obj = e.target;
    var i_codigoinventario = $(obj).data('nombre');
    $("#i_codigoinventario").val(i_codigoinventario);
}
function guarda_new_prov(){
    if (confirm('¿Guardar los cambios realizado al Nuevo Proveedor?')) {
        var rfc = $("#new_rfc").val();
        var nombre = $("#new_nombre").val();
        var direccion = $("#new_direccion").val();
        var num_telefono = $("#new_num_telefono").val();
        var email = $("#new_email").val();
        var pagina_web = $("#new_pagina_web").val();
        var actividad_comercial = $("#new_actividad_comercial").val();

        $.ajax({
            data:{rfc:rfc,nombre:nombre,direccion:direccion,num_telefono:num_telefono,email:email,pagina_web:pagina_web,actividad_comercial:actividad_comercial},
            url: 'json_set_newprov.php',
            type: 'POST',
            success:(function(res){
                if(res[0].result == "vacio"){
                    $('#msj_alert2').show(200);
                }else if(res[0].result == true){
                    alert("Se guardo exitosamente");
                    var table = $('#proveedor_tabla_aplica').DataTable();
                    table.ajax.reload();
                    hide_showNewProveedor();
                }else if(res[0].result == false){
                    alert("Error al guardar");
                }
            })
        });
    }
}
function add_documento(){
    if (confirm('¿Guardar los cambios realizados?')) {
        if($("#nombreempresa").val() != ""){
        var serie_folio = $("#add_serie_folio").val();
        var fecha_emision = $("#add_fecha_emision").val();
        var lugar_emision = $("#add_lugar_emision").val();
        var uuid = $("#add_uuid").val();
        var total = $("#total").data("total");
        var id_proveedor = $("#rfc").data("idproveedor");
        
        $.ajax({
            data:{serie_folio:serie_folio,fecha_emision:fecha_emision,lugar_emision:lugar_emision,uuid:uuid,total:total,id_proveedor:id_proveedor},
            url: 'json_addDocumento.php',
            type: 'POST',
            success:(function(res){
                if(res.stat == "ok"){
                    console.log("ok:" + res.result);
                    recorreDataTable(res.result);
                }else if(res.stat == "fail"){
                    console.log("Pr:" + $("#rfc").data("idproveedor"));
                    console.log("fail");
                }
            })
        });
        }else{
            alert('Falta especificar datos del Proveedor. asignelo por favor.');
        }
    } else {
        alert('NO confirmado');
    }
}
function recorreDataTable(id_doc){
    var table = $('#table_inventarioitems').DataTable();
    var cont = table.rows().count();
    var arr = [];
    var cell;
    table
        .column( 0 )
        .data()
        .each( function ( value, index ) {
            arr.push(table
            .rows( index )
            .data()
            .toArray());
            cell = arr[index][0];
            console.log('cell[0]:'+cell[0]+', cell[2]:'+cell[2]+', cell[3]:'+cell[3]+', cell[6]:'+cell[6]);
            guardaPedido(cell[0],cell[2],cell[3],cell[6],id_doc);
            
            var total = index + 1;
            console.log("Completado: "+total+" de:" + cont);
            if (cont == (index+1)){
                finishDocument();
            }else{
                console.log(total + " Procesando");
            }
            
        });
}
function guardaPedido(cod_articulo, cantidad,precio_unidad,total,id_factura){
    $.ajax({
        data:{cantidad:cantidad, precio_unidad:precio_unidad, total:total, id_factura:id_factura, cod_articulo:cod_articulo},
        type: 'post',
        url: 'json_addDocumento_detail.php',
        dataType: 'json',
        success: function(data){
            //$.each(data,function(key, registro){
            //});
            if(data.stat == "ok"){
                console.log('add:' + cod_articulo + ', OK');
            }else{
                console.log('Fail add:' + cod_articulo + ', ERROR');
            }
        },
        error: function(data){
          console.log('error'+data);
        }
    });
}
function resetNewDocument(){
    $('#rfc').data('idproveedor','');
    $('#form_proveedor')[0].reset();
    $('#form_documento')[0].reset();
    $('#table_inventarioitems').DataTable().clear().draw();
    
}
function resetNotNewDocument(){
    hide_showNewInvoice();
    resetNewDocument();
}
function finishDocument(){
    var table = $("#datatable_invoice_detail").DataTable();
    if (confirm('La operación se guardo con exito!\n¿Desea crear otro documento?')) {
        resetNewDocument();
        table.ajax.reload();
    } else {
        resetNotNewDocument();
        table.ajax.reload();
    }
}
function finishDocument2(){
    if (confirm('Se creará un nuevo documento y se borrará el regisro actual.\n¿Desea continuar con el Nuevo Documento?')) {
        resetNewDocument();
    }
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
        url: 'json_selectFacturaInfDetail.php',
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
}
function sumCoulumns(){
    var sum = 0;
    $(".sub-total-items").each(function(){
        sum += $(this).data("subtotal");
    });
    $("#total").html(FormatCurrency(sum));
    $("#total").data("total",sum);
}
function FormatCurrency (amount){
    return amount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}