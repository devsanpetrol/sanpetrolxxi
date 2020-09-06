$(document).ready( function () {
    $('.form-control-select2').select2();
    get_area_equipo();
    fecha_actual();
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
    var user_session_id = $('#user_session_id').data("employeid");
    
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ){
            $(row).addClass('pointer font-weight-semibold text-blue-800');
        },
        columnDefs: [
            {targets:1,className: "dt-center sub-total"},
            {targets:2,className: "dt-center"}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
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
    
    $('#area_aquipo').change(function () {
        var id_equipo = $(this).val();
        var idcoordinador = $(this).children('option:selected').data('idcoordinacion');
        $('#sub_area_aquipo').empty().trigger("change");
        $("#area_aquipo").data("idcoordinador",idcoordinador);
        get_sub_area_equipo(id_equipo);
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
            
    $('#tabla_pedidos tbody').on( 'click', 'tr', function () {
        var table = $('#tabla_pedidos').DataTable();
        var filas = table.rows().count();
        if (filas > 0){
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $("#btn_del_row_sel").hide();
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $("#btn_del_row_sel").show();
            }
        }
    } );
    
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        table.row('.selected').remove().draw( false );
        $("#btn_del_row_sel").hide();
        if (!table.data().count() ) {
            $("#area_aquipo").prop("disabled", false);
        }
    } );
    
    $('#btn_send_pedido').on('click', function () {});
    
    $("#i_cantidad").bind('keypress', function(event) {
        mybind(event,"^[0-9 ]|[\.]+$");
    }).on('keyup', function (e){
        if (e.keyCode === 13){
            var cant = $("#i_cantidad").val();
            if(cant !== ""){
                agregar_pedido();
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
                searchTermnBarCode(searchTerm);
            }
        }
    }).bind('keypress', function(event) {
        mybind(event,"^[a-zA-Z0-9 ]|[\.]+$");
    });
} );
function get_area_equipo(){
    $.ajax({
    url: 'json_destinoSuministro.php',
    dataType: "json",
    success: function(data){
        $.each(data,function(key, registro) {
            $("#area_aquipo").append("<option data-idcoordinacion='"+registro.id_coordinacion+"' value='"+registro.id_equipo+"'>"+registro.nombre_generico+"</option>");
        });
    },
    error: function(data){
      alert('error');
    }
  });
}
function get_sub_area_equipo(id_equipo){
    $.ajax({
    type: "POST",
    url: 'json_destinoSuministro_sub.php',
    data:{ id_equipo:id_equipo },
    dataType: "json",
    success: function(data){
        $("#sub_area_aquipo").append("<option selec></option>");
        $.each(data,function(key, registro) {
            $("#sub_area_aquipo").append("<option value='"+registro.id_sub_area+"'>"+registro.nombre_sub_area+"</option>");
        });
        $('#sub_area_aquipo option:eq(0)').prop('selected',true);
    },
    error: function(data){
      alert('error');
    }
  });
}
function reset_select2(){
    $("#select_article").val(null).trigger('change');
}
function resetModal(){
    reset_select2();
    $('#unidad').prop('selectedIndex',0).trigger('change');
    $('#cod_articulo').val('');
    $('#descripcion').val('');
    $('#justificacion').val('');
    $('#fecharequerimiento').val(null);
}

function resetModalPedido(){
    reset_select2();
    $('#unidad').prop('selectedIndex',0).trigger('change');
    $('#sub_area_aquipo').prop('selectedIndex',0).trigger('change');
    $('#cod_articulo').val('');
    $('#descripcion').val('');
    $('#cantidad').val('0');
    $('#justificacion').val('');
    $('#modal_large').modal('hide');
}
function valida_pedido(){
    if ($('#i_descripcion').val().trim().length === 0){
        return false;
    }else{
        return true;
    }
}
function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}
function fecha_actual(){
    $.post('json_now.php',function(res){
        $('#fecha_actual').val(res.fecha_actual);
        $('#folioxx').slideDown();
    });
}
function set_list_resp(id_empleado,nombre,apellidos){
    var apellidos_ = apellidos.replace(/ /g, "");
    $('.'+apellidos_+id_empleado).remove();
    $('#flex ul').append(
        $('<li>').addClass(apellidos_+id_empleado).append("<button type='button' class='btn btn-success btn-sm' ><i class='fa fa-user'></i> "+nombre+" "+apellidos+" <i class='fa fa-check-circle-o'></i></button>")
    );
}
function get_folio(){
    var table = $('#tabla_pedidos').DataTable();
    var filas = table.rows().count();
    if (filas > 0){
        var folio_num;
        var fecha_solicitud = $('#fecha_actual').val();
        var clave_solicita  = $('#user_session_id').data('employeid');
        var nombre_solicita = $("#solicitante").val();
        var puesto_solicita = $("#puesto").val();
        var id_equipo       = $("#area_aquipo").val();
        var sitio_operacion = $("#sitio").val();
        
        $.ajax({
            data:{fecha_solicitud:fecha_solicitud,clave_solicita:clave_solicita,nombre_solicita:nombre_solicita,puesto_solicita:puesto_solicita,sitio_operacion:sitio_operacion,id_equipo:id_equipo},
            type: 'post',
            url: 'json_selecFolio_rapido.php',
            dataType: 'json',
            success: function(data){
              $.each(data,function(key, registro){
                $("#folioxx").text('FOLIO: '+registro.folio).data('folioz',registro.folio);
                folio_num = registro.folio;
                recorreDataTable(registro.folio);
              });
              $('#folioxx').slideDown();
            },
            complete: function(){
                guarda_vale_salida_rapido(folio_num);
            },
            error: function(data) {
                alert('Error de conexión al enviar');
            }
        });
    }else{
        alert("Solicitud vacia");
    }
}
function recorreDataTable(folio){
    var table = $('#tabla_pedidos').DataTable();
    var justi = $('#justificacion').val();
    var sub_a = $('#sub_area_aquipo').val();
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
            guardaPedido(cell[0],cell[1],cell[2],cell[3],sub_a,justi,folio);
        });
}
function guardaPedido(cod_articulo,cantidad,unidad,articulo,destino,justificacion,folio){
    $.ajax({
        data:{cod_articulo:cod_articulo,cantidad:cantidad,unidad:unidad,articulo:articulo,justificacion:justificacion, destino:destino, folio:folio},
        type: 'post',
        url: 'json_insertPedido_rapido.php',
        dataType: 'json',
        success: function(data){},
        error: function(data){
          console.log('error'+data);
        }
    });
}
function show_addpedido(){
    fecha_actual();
    $("#card_addPedido").toggle("fast");
    $("#btn_send_pedido").toggle("fast");
    $("#fecha_actual").toggle("fast");
}
function clear_modal(){
    var table = $('#tabla_pedidos').DataTable();
    $("#folioxx").text('').data('folioz','').slideDown();
    table.clear().draw();
    $("#solicitante").val("");
    $("#puesto").val("");
    $("#sitio").val("");
    $('#area_aquipo').prop('selectedIndex',0).trigger('change');
    show_addpedido();
}

function setPedidos(folio){
    var result;
    var array_btn_save = [];
    $.ajax({
        data:{folio:folio},
        url: 'json_list_pedido.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Recopilando información...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
        },
        success: function (obj) {
            result = obj;
            $.each(obj, function (index, value) {
                array_btn_save.push(value.id_pedido);
            });
            alert("Operación exitosa!");
        },
        error: function (obj) {
            alert(obj.msg);
        }
    });
}
function openModalAddItem(){
    var area_aquipo = $('#area_aquipo').find(':selected').val();
    console.log(area_aquipo);
    if(area_aquipo != ""){
        $("#modal_large").modal("show");
    }else{
        alert("Debe seleccionar un Equipo!");
    }
}
function hide_showModalNewArt(){
    $("#busca_articulo" ).modal("hide");
    simulEnter();
}
function simulEnter(){
    var searchTerm = $('#i_codigoinventario').val();
        if(searchTerm !== ""){
            searchTermn(searchTerm);
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
            $('#i_unidad').val(res.unidad);
            if(res.cod_articulo !== ""){
                $('#i_cantidad').focus();
            }
        })
    });
}
function searchTermnBarCode(searchTerm){
    $.ajax({
        url: 'json_codigosearch.php',
        data:{ searchTerm:searchTerm },
        type: 'POST',
        success:(function(res){
            $('#i_codigobarra').val(res.cod_barra);
            $('#i_codigoinventario').val(res.cod_articulo);
            $('#i_descripcion').val(res.descripcion);
            $('#i_unidad').val(res.unidad);
            if(res.cod_articulo !== ""){
                $('#i_cantidad').val(1);
                agregar_pedido();
            }
        })
    });
}
function mybind(event,expReg){
    var regex = new RegExp(expReg);
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
}
function get_articulo(e){
    var obj = e.target;
    var i_codigoinventario = $(obj).data('nombre');
    $("#i_codigoinventario").val(i_codigoinventario);
}
function borrar_input_nuevoArticulo(){
    $(".input-newarticle").val("");
    $('#i_codigobarra').focus();
}
//==========================================VALE SALIDA============
function guarda_vale_salida_rapido(folio_valeSalida){
    $.ajax({
        data:{folio:folio_valeSalida},
        url: 'create_vale_salida.php',
        type: 'POST',
        success:(function(res){})
    });
}
function getSubTotal(){
    var cod = $("#i_codigoinventario").val();
    var can = $('#i_cantidad').val();
    if($('#'+cod).length){
        var sub = $("#"+cod).find("td:eq(1)").html();
        var mas = parseFloat(can) + parseFloat(sub);
        return mas;
    }else{
        return can;
    }
}
function agregar_pedido(){
    var t = $('#tabla_pedidos').DataTable();
    var cod_articulo = $('#i_codigoinventario').val().trim();
    var cantidad     = $('#i_cantidad').val();
    if(valida_pedido()){
        $.ajax({
            data:{cod_articulo:$('#i_codigoinventario').val()},
            type: 'post',url: 'checkStock.php',dataType: 'json',
            success: function(data){
                var totalGlobal  = getSubTotal();
                
                if( data[0].stock >=  totalGlobal){
                    if($('#'+cod_articulo).length){
                        $("#"+cod_articulo).find("td:eq(1)").html(totalGlobal);
                        t.draw( false );
                    }else{
                        t.row.add([
                        cod_articulo,
                        cantidad,
                        $('#i_unidad').val(),
                        $('#i_descripcion').val()
                    ] ).node().id = $('#i_codigoinventario').val();
                    }

                    t.draw( false );
                    borrar_input_nuevoArticulo();
                }else{
                    alert("La cantidad de elementos de salida supera a la cantidad disponible en Almacen.\nNo es posible agregar el articulo actual." );
                }
            }
        });
    }else{
        alert('No se agrego ningun pedido');
    }
}