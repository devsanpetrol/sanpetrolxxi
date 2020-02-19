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
            {targets:0,visible: false,searchable: true},
            {targets:4,visible: false,searchable: false},
            {targets:1,className: "dt-center"},
            {targets:2,className: "dt-center"},
            {targets:6,className: "dt-center"}
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
            $("#area_aquipo").data("idcoordinador",registro.id_coordinacion);
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
                $("input[name='prefix____suffix']").val()
            ] ).draw( false );
            
            resetModalPedido();
        }else{
            alert('Debe completar los campos requeridos');
        }
    }else{
        alert('No se agrego ningun pedido');
        $("#unidad").val('pza').trigger('change');
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
        var folio_num;
        var fecha_solicitud = $('#fecha_actual').val();
        var clave_solicita = $('#user_session_id').data('employeid');
        var nombre_solicita = $("#solicitante").val();
        var puesto_solicita = $("#puesto").val();
        var id_equipo = $("#area_aquipo").val();
        var sitio_operacion = $("#sitio").val();
        
        $.ajax({
            data:{fecha_solicitud:fecha_solicitud,clave_solicita:clave_solicita,nombre_solicita:nombre_solicita,puesto_solicita:puesto_solicita,sitio_operacion:sitio_operacion,id_equipo:id_equipo},
            type: 'post',
            url: 'json_selecFolio.php',
            dataType: 'json',
            success: function(data){
              $.each(data,function(key, registro){
                $("#folioxx").text('FOLIO: '+registro.folio).data('folioz',registro.folio);
                folio_num = registro.folio;
                recorreDataTable(registro.folio);
              });
              $('#folioxx').slideDown();
                alert("Operación exitosa!");
                setTimeout(function() {
                    clear_modal();
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
function recorreDataTable(folio){
    var table = $('#tabla_pedidos').DataTable();
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
            guardaPedido(cell[0],cell[1],cell[2],cell[3],cell[4],cell[5],cell[6],folio);
        });
}
function guardaPedido(cod_articulo,cantidad,unidad,articulo,destino,justificacion,fecha_requerimiento,folio){
    $.ajax({
        data:{cod_articulo:cod_articulo,cantidad:cantidad,unidad:unidad,articulo:articulo,justificacion:justificacion, destino:destino, fecha_requerimiento:fecha_requerimiento, folio:folio},
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