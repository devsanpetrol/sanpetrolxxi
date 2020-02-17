$(document).ready( function () {
    $('.form-control-select2').select2();
    get_area_equipo();
    fecha_actual();
    $('.pickadate-accessibility').pickadate({
        labelMonthNext: 'Go to the next month',
        labelMonthPrev: 'Go to the previous month',
        labelMonthSelect: 'Pick a month from the dropdown',
        labelYearSelect: 'Pick a year from the dropdown',
        selectMonths: true,
        selectYears: true
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
            {targets:0,visible: false,searchable: true},
            {targets:5,visible: false,searchable: false}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
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
        $('#sub_area_aquipo').empty().trigger("change");
        get_sub_area_equipo(id_equipo);
    });
    
    $( '#select_article' ).change(function () {
       var searchTerm = $('#select_article').val();
        $.ajax({
            url: 'json_pedido.php',
            data:{searchTerm:searchTerm},
            type: 'POST',
            success:(function(res){
                if(res.no_inventario != "" && res.stock == "1"){
                    $('#cod_articulo').val(res.cod_articulo);
                    $('#descripcion').val(res.descripcion);
                    $('#especificacion').val(res.especificacion);
                    $('#select_categoria').val(res.id_categoria).trigger('change');
                    $('#unidad').val(res.tipo_unidad).trigger('change');
                }else if(res.no_inventario != "" && res.stock == "0"){
                    alert("Este articulo no esta disponible para su solicitud.");
                    console.log("cae en else if");
                }else{
                    $('#cod_articulo').val(res.cod_articulo);
                    $('#descripcion').val(res.descripcion);
                    $('#especificacion').val(res.especificacion);
                    $('#select_categoria').val(res.id_categoria).trigger('change');
                    $('#unidad').val(res.tipo_unidad).trigger('change');
                }
            })
        });
        if(isNaN($('#select_article').val())){
            $('#descripcion').prop('readonly', true);
            $('#select_categoria').prop('disabled', true);
            $('#unidad').prop('disabled', true);
        }else{
            $('#descripcion').prop('readonly', false);
            $('#select_categoria').prop('disabled', false);
            $('#unidad').prop('disabled', false);
        }
    });
            
    $('#tabla_pedidos tbody').on( 'click', 'tr', function () {
        var table = $('#tabla_pedidos').DataTable();
        var filas = table.rows().count();
        if (filas > 0){
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $("#btn_del_row_sel").slideUp("fast");
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $("#btn_del_row_sel").slideDown("fast");
            }
        }
    } );
 
    $('#btn_del_row_sel').click( function () {
        var table = $('#tabla_pedidos').DataTable();
        table.row('.selected').remove().draw( false );
        $("#btn_del_row_sel").slideUp();
    } );
    
    $('#btn_send_pedido').on('click', function () {});
} );
function get_area_equipo(){
    $.ajax({
    url: 'json_destinoSuministro.php',
    dataType: "json",
    success: function(data){
        $.each(data,function(key, registro) {
            $("#area_aquipo").append("<option value='"+registro.id_equipo+"'>"+registro.nombre_generico+"</option>");
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
        $.each(data,function(key, registro) {
            $("#sub_area_aquipo").append("<option value='"+registro.id_sub_area+"'>"+registro.nombre_sub_area+"</option>");
        });
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
function agregar_pedido(){
    if(valida_pedido()){
        if(valida_campos(0)){
            var t = $('#tabla_pedidos').DataTable();
            
            t.row.add([
                $('#cod_articulo').val(),
                $('#cantidad').val(),
                $('#unidad').val(),
                $('#descripcion').val(),
                $('#sub_area_aquipo').val(),
                $('#justificacion').val(),
                $('#fecharequerimiento').val(),
                $('#area_aquipo').val()
            ] ).draw( false );
            
            resetModalPedido();
        }else{
            alert('Debe completar los campos requeridos');
        }
    }else{
        alert('No se agrego ningun pedido');
        $("#unidad").val('pza').trigger('change');
        $('#especificacion').val('');
        $('#justificacion').val('');
        $('#area_aquipo').val('');
        $('#modal_large').modal('hide');
    }
}
function resetModalPedido(){
    reset_select2();
    $('#unidad').prop('selectedIndex',0).trigger('change');
    $('#cod_articulo').val('');
    $('#descripcion').val('');
    $('#cantidad').val('0');
    $('#justificacion').val('');
    $('#modal_large').modal('hide');
}
function valida_pedido(){
    if ($('#descripcion').val().trim().length === 0){
        return false;
    }else{
        return true;
    }
}
function valida_campos(x){
    var total_error = 0;
    
    if ($('#descripcion').val() == ""){
        total_error++;
    }else{
        console.log("#descripcion error "+total_error);
    }
    //-----------------------------------------------------
    if ($('#cantidad').val() == "0"){
        total_error++;
    }else{
        console.log("#cantidad error"+total_error);
    }
    //-----------------------------------------------------
    if ($('#area_aquipo').val() == null){
        total_error++;
    }else{
        console.log("#area_aquipo error"+total_error);
    }
    //-----------------------------------------------------
    if ($('#justificacion').val() == ""){
        total_error++;
    }else{
        console.log("#justificacion error"+total_error);
    }
    //-----------------------------------------------------
    if(total_error <= 0){
        return true;
    }else{
        return false;
    }
}
function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}
function  fecha_actual(){
    $.post('json_now.php',function(res){
        $('#fecha_actual').val(res.fecha_actual);
        $('#folioxx').slideDown();
    });
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
function set_list_resp(id_empleado,nombre,apellidos){
    var apellidos_ = apellidos.replace(/ /g, "");
    $('.'+apellidos_+id_empleado).remove();
    $('#flex ul').append(
        $('<li>').addClass(apellidos_+id_empleado).append("<button type='button' class='btn btn-success btn-sm' ><i class='fa fa-user'></i> "+nombre+" "+apellidos+" <i class='fa fa-check-circle-o'></i></button>")
    );
}
function get_folio(){
    setTimeout(function() {
    var table = $('#tabla_pedidos').DataTable();
    var filas = table.rows().count();
    if (filas > 0){
    var fecha_solicitud = $('#fecha_actual').val();
    var status_solicitud = 0;
    var id_formato = $('#add_articulo').data('idformat');
    var clave_solicita = $('#user_session_id').data('employeid');
    var folio_num;
    
    $.ajax({
        data:{fecha_solicitud:fecha_solicitud,status_solicitud:status_solicitud,id_formato:id_formato,clave_solicita:clave_solicita},
        type: 'post',
        url: 'json_selecFolio.php',
        dataType: 'json',
        success: function(data){
          $.each(data,function(key, registro){
            $("#folioxx").text('FOLIO: '+registro.folio).data('folioz',registro.folio);
            folio_num = registro.folio;
            recorreDataTable(registro.folio,clave_solicita);
          });
          $('#folioxx').slideDown();
            alert("Operación exitosa!")
            setTimeout(function() {
                clear_modal();
                generador_layout();
                window.location.reload();
            }, 500);
        },
        error: function(data) {
            alert('Error de conexión al enviar');
        }
    });
    }else{
        alert("Solicitud vacia");
    }
    }, 1000);
}
function recorreDataTable(folio,clave_solicita){
    var table = $('#tabla_pedidos').DataTable();
    var arr = [];
    
    table
        .column( 0 )
        .data()
        .each( function ( value, index ) {
            arr.push(table
            .rows( index )
            .data()
            .toArray());
            guardaPedido(arr[index][0][10],arr[index][0][3],arr[index][0][5],arr[index][0][4],arr[index][0][6],arr[index][0][8],arr[index][0][14],0,'',arr[index][0][11],arr[index][0][12],arr[index][0][1],arr[index][0][13],folio,clave_solicita,arr[index][0][15],arr[index][0][16]);
        });
}
function guardaPedido(autorizado, articulo, cantidad, unidad, detalle_articulo, justificacion, destino, status_pedido, comentario, grado_requerimiento, fecha_requerimiento, cod_articulo, id_categoria, folio,clave_solicita,cantidad_aparta,cantidad_compra){
    $.ajax({
        data:{autorizado:autorizado, articulo:articulo, cantidad:cantidad, unidad:unidad, detalle_articulo:detalle_articulo, justificacion:justificacion, destino:destino, status_pedido:status_pedido, comentario:comentario, grado_requerimiento:grado_requerimiento, fecha_requerimiento:fecha_requerimiento, cod_articulo:cod_articulo, id_categoria:id_categoria, folio:folio,clave_solicita:clave_solicita,cantidad_aparta:cantidad_aparta,cantidad_compra:cantidad_compra},
        type: 'post',
        url: 'json_insertPedido.php',
        dataType: 'json',
        success: function(data){
            $.each(data,function(key, registro){
            });
        },
        error: function(data){
          alert('error');
        }
    });
}
function show_addpedido(){
    fecha_actual();
    $("#busqueda_costom").toggle();//
    $("#card_addPedido").toggle("fast");
    $("#btn_send_pedido").toggle("fast");
    $("#btn_info_formato").toggle("fast");
    $("#fecha_actual").toggle("fast");
    
    if($("#btn_add_pedido").hasClass("bg-primary")){
        $("#btn_add_pedido").removeClass("bg-primary text-primary-800");
        $("#btn_add_pedido").addClass("bg-danger text-danger-800");
        $("#btn_add_pedido").empty();
        $("#btn_add_pedido").append("<i class='icon-cross2'></i>");
    }else{
        $("#btn_add_pedido").removeClass("bg-danger text-danger-800");
        $("#btn_add_pedido").addClass("bg-primary text-primary-800");
        $("#btn_add_pedido").empty();
        $("#btn_add_pedido").append("<i class='icon-add'></i>");
    }
}
function clear_modal(){
    var table = $('#tabla_pedidos').DataTable();
    $("#folioxx").text('').data('folioz','').slideDown();
    table.clear().draw();
    show_addpedido();
}

function setPedidos(folio){
    var result;
    var array_btn_save = [];
    var notice = new PNotify();
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
            notice.update(options);
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
function regresar_lista(){
    var idrow = $("#tools_menu_regresa").data("idrow");
    $("#"+idrow+"").click();
}