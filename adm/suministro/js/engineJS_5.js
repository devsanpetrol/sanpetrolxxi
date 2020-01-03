$(document).ready( function () {
    get_norm_form_solicitud();
    get_categoria();
    fecha_actual();
    var user_session_id = $('#user_session_id').data("employeid");
    var table = $('#tabla_pedidos').DataTable();
    $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-800 text-primary-800'
      });
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ) {
            $(row).addClass('pointer font-weight-semibold text-blue-800');
            $('td', row).eq(1).addClass('resalta');
            $('td', row).eq(3).addClass('resalta');
            if(data[11] == 'Inmediato'){
                $('td', row).eq(0).addClass('text-orange-400');
            }else{
                $('td', row).eq(0).addClass('text-slate-800');
            }
        },
        columnDefs: [
            {targets: 0,width: '1%'},
            {targets: 3,visible: false},
            {targets: 4,visible: false},
            {targets: 5,visible: false},
            {targets: 6,visible: false},
            {targets:10,visible: false,searchable: false},
            {targets:11,visible: false,searchable: false},
            {targets:13,visible: false,searchable: false},
            {targets:14,visible: false,searchable: false}
        ],
        language: {
            zeroRecords: "Ningun elemento agregado"
        }
    });
    
    $('#select_article').select2({
        dropdownParent: $('#modal_large'),
        ajax: {
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
    $('#area_aquipo').select2({
        dropdownParent: $('#content_destinos'),
        ajax: { 
            url: 'json_selectDestino.php',
            type: 'post',
            dataType: 'json',
            delay: 500,
            cache: true,
            data: function (params) {
             return { searchTerm: params.term };
            },
            processResults: function (response) {
              return { results: response };
            }
        }
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
                    count_apartado(res.stock);
                    console.log("cae en if");
                }else if(res.no_inventario != "" && res.stock == "0"){
                    alert("Este articulo no esta disponible para su solicitud.");
                    console.log("cae en else if");
                }else{
                    $('#cod_articulo').val(res.cod_articulo);
                    $('#descripcion').val(res.descripcion);
                    $('#especificacion').val(res.especificacion);
                    $('#select_categoria').val(res.id_categoria).trigger('change');
                    $('#unidad').val(res.tipo_unidad).trigger('change');
                    count_apartado(res.stock);
                    console.log("cae en else");
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
    $( '#area_aquipo' ).change(function () {
       var searchTerm = $('#area_aquipo').val();
        $.ajax({
            url: 'json_destino.php',
            data:{searchTerm:searchTerm},
            type: 'POST',
            success:(function(res){
                $('#area_aquipo').val(res.key_wh).data("textvalue",res.destino);
                console.log($('#area_aquipo').data("textvalue"));
                //$('#unidad').val(res.tipo_unidad).trigger('change');
            })
        });
    });
    $(":radio[name='grado_r']").on('ifChanged',function(event) {
        if ($("input[name='grado_r']:checked").val() === 'programado'){
            $('#single_cal3').prop('disabled', false);
        }else if ($("input[name='grado_r']:checked").val() === 'inmediato'){
            $('#single_cal3').blur();
            $('#single_cal3').prop('disabled', true);
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
    
    $('#cantidad').on( 'change paste keyup', function () {
        var x = $('#stock_disponible').data("almacen");
        var c = $('#cantidad').val();
        if((x-c) > 0){
            $('#stock_compra').text(0).prepend("<i class='icon-cart-add2'></i> ");
            $('#stock_disponible').empty();
            $('#stock_disponible').text(x-c).prepend("<i class='icon-database4'></i> ");
        }else{
            $('#stock_disponible').text(0).prepend("<i class='icon-database4'></i> ");
            $('#stock_compra').empty();
            $('#stock_compra').text((x-c)*-1).prepend("<i class='icon-cart-add2'></i> ");
        }
    });
} );
function count_apartado(val){
    $('#cantidad').val(0);
    $('#stock_disponible').empty();
    $('#stock_compra').empty();
    
    $('#stock_disponible').data("almacen",val);
    if(val == 0){
        $('#stock_disponible').text(0).prepend("<i class='icon-database4'></i> ");
    }else{
        $('#stock_disponible').text(val).prepend("<i class='icon-database4'></i> ");
    }
    $('#stock_compra').text(0).prepend("<i class='icon-cart-add2'></i> ");
}

function get_norm_form_solicitud(){
    var numformat = $('#add_articulo').data('numformat');
    $.ajax({
        url: 'json_from_sol_mat.php',
        data:{numformat:numformat},
        type: 'POST',
        success:(function(res){
            $('#autorizado').val(res.autorizado);
            $('#fecha_rev').val(res.fecha_rev);
            $('#funcion').val(res.funcion);
            $('#num_formato').val(res.num_formato);
            $('#num_revision').val(res.num_revision);
            $('#region').val(res.region);
            $('#revisado').val(res.revisado);
	})
    });
}
function reset_select2(){
    $("#select_article").empty().trigger('change');
}
function reset_select3(){
    $("#area_aquipo").empty();
    return false;
}
function getValRadio(){
    reset_select2();
    reset_select3();
    count_apartado(0);
    $('#unidad').prop('selectedIndex',0).trigger('change');
    $('#cod_articulo').val('');
    $('#descripcion').val('');
    $('#especificacion').val('');
    $('#anexo').val('');
    $('#justificacion').val('');
    $('#area_aquipo').val('');
    $('#descripcion').removeClass("border-danger");
    $('#unidad').removeClass("border-danger");
    $('#area_aquipo').removeClass("border-danger");
    $('#justificacion').removeClass("border-danger");
    $('#mod_pedido').modal('hide');
}
function agregar_pedido(){
    if(valida_pedido()){
        if(valida_campos(0)){
            var fecha_req = $('#single_cal3').val();
            var grado_requerimiento = $("input[name='grado_r']:checked").val() === 'inmediato' ? "Inmediato" : "Programado";
            var grado_requerimiento2 = $("input[name='grado_r']:checked").val() === 'inmediato' ? "<i class='icon-star-full2 mr-3' data-popup='tooltip' title='Inmediato'></i>" : "<i class='icon-calendar2 mr-3' data-popup='tooltip' title='Requerido para: "+fecha_req+"'></i>";
            var t = $('#tabla_pedidos').DataTable();
            var espe = $('#especificacion').val() !== '' ? '</br><i>*'+$('#especificacion').val()+'</i>' : '';
            var cantidad_compra = parseFloat($('#stock_compra').text());
            var cantidad_solici = parseFloat($('#cantidad').val());
            var cantidad_aparta = cantidad_solici - cantidad_compra;
            t.row.add( [
                grado_requerimiento2,
                $('#cod_articulo').val(),
                '('+$('#cantidad').val()+' '+$('#unidad').val()+') '+$('#descripcion').val()+espe,
                $('#descripcion').val(),
                $('#unidad').val(),
                cantidad_solici,
                $('#especificacion').val(),
                $('#area_aquipo').data("textvalue"),
                $('#justificacion').val(),
                $('#anexo').val(),
                $('#select_categoria option:selected').data('resp'),
                grado_requerimiento,
                fecha_req,//grado_requerimiento,
                $('#select_categoria option:selected').val(),
                $('#area_aquipo').val(),
                cantidad_aparta,
                cantidad_compra
            ] ).draw( false );
            //set_list_resp($('#select_categoria option:selected').data('resp'),$('#select_categoria option:selected').data('nombre'),$('#select_categoria option:selected').data('apellidos'));
            resetModalPedido();
        }else{
            alert('Debe completar los campos requeridos');
        }
    }else{
        alert('No se agrego ningun pedido');
        $("#unidad").val('pza').trigger('change');
        $('#especificacion').val('');
        $('#anexo').val('');
        $('#justificacion').val('');
        $('#area_aquipo').val('');
        $('#modal_large').modal('hide');
    }
}
function resetModalPedido(){
    reset_select2();
    reset_select3();
    count_apartado(0);
    $('#unidad').prop('selectedIndex',0).trigger('change');
    $('#cod_articulo').val('');
    $('#descripcion').val('');
    $('#cantidad').val('0');
    $('#especificacion').val('');
    $('#anexo').val('');
    $('#justificacion').val('');
    $('#area_aquipo').val('');
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
    var total_error = x;
    
    if ($('#descripcion').val().trim().length === 0){
        total_error++;
        $('#descripcion').addClass("border-danger");
        $('#descripcion').parent().append("<div class='form-control-feedback text-danger error-descripcion'><i class='icon-cancel-circle2'></i></div>");
    }else{
        $('#descripcion').removeClass("border-danger");
        $('.error-descripcion').remove();
    }
    //-----------------------------------------------------
    if ($('#cantidad').val() == '0'){
        total_error++;
        $('#cantidad').addClass("border-danger");
    }else{
        $('#cantidad').removeClass("border-danger");
    }
    //-----------------------------------------------------
    if ($('#area_aquipo').val().trim().length === 0){
        total_error++;
        $('#area_aquipo').addClass("border-danger");
        $('#area_aquipo').parent().append("<div class='form-control-feedback text-danger error-area'><i class='icon-cancel-circle2'></i></div>");
    }else{
        $('#area_aquipo').removeClass("border-danger");
        $('.error-area').remove();
    }
    //-----------------------------------------------------
    if ($('#justificacion').val().trim().length === 0){
        total_error++;
        $('#justificacion').addClass("border-danger");
        $('#justificacion').parent().append("<div class='form-control-feedback text-danger error-justificacion'><i class='icon-cancel-circle2'></i></div>");
    }else{
        $('#justificacion').removeClass("border-danger");
        $('.error-justificacion').remove();
    }
    //-----------------------------------------------------
    console.log(total_error);
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
    $.post('json_now.php',function(res){$('#fecha_actual').text(res.fecha_actual);});
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
    var notice = new PNotify({
        text: "Enviando...",
        addclass: 'bg-primary border-primary',
        type: 'info',
        icon: 'icon-spinner4 spinner',
        hide: false,
        buttons: {
            closer: false,
            sticker: false
        },
        opacity: .9,
        width: "200px"
    });
    setTimeout(function() {
    var table = $('#tabla_pedidos').DataTable();
    var filas = table.rows().count();
    if (filas > 0){
    var fecha_solicitud = $('#fecha_actual').text();
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
            var options = {
              title: 'Enviado!',
              text: 'Folio: '+folio_num,
              addclass: 'bg-success border-success',
              type: 'success',
              delay:2000,
              buttons: {
                  closer: true,
                  sticker: false
              },
              icon: 'icon-paperplane',
              opacity : 1,
              hide: true
            };
            notice.update(options);
            setTimeout(function() {
                clear_modal();
                generador_layout();
            }, 500);
        },
        error: function(data) {
        var options = {
              title: 'Error!',
              text: 'Error de conexión al enviar',
              addclass: 'bg-danger border-danger',
              type: 'success',
              buttons: {
                  closer: true,
                  sticker: false
              },
              icon: 'icon-cross2',
              opacity : 1,
              hide: true
            };
            notice.update(options);
        }
    });
    }else{
    var options = {
            text: "Solicitud vacia",
            addclass: 'bg-orange-400 border-orange-400',
            type: 'info',
            buttons: {
                closer: true,
                sticker: false
            },
            icon: 'icon-warning22',
            hide: true
        };
        notice.update(options);
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
            guardaPedido(arr[index][0][10],arr[index][0][3],arr[index][0][5],arr[index][0][4],arr[index][0][6],arr[index][0][8],arr[index][0][9],arr[index][0][14],0,'',arr[index][0][11],arr[index][0][12],arr[index][0][1],arr[index][0][13],folio,clave_solicita,arr[index][0][15],arr[index][0][16]);
        });
    
}
function guardaPedido(autorizado, articulo, cantidad, unidad, detalle_articulo, justificacion, anexo_codicion, destino, status_pedido, comentario, grado_requerimiento, fecha_requerimiento, cod_articulo, id_categoria, folio,clave_solicita,cantidad_aparta,cantidad_compra){
    $.ajax({
        data:{autorizado:autorizado, articulo:articulo, cantidad:cantidad, unidad:unidad, detalle_articulo:detalle_articulo, justificacion:justificacion, anexo_codicion:anexo_codicion, destino:destino, status_pedido:status_pedido, comentario:comentario, grado_requerimiento:grado_requerimiento, fecha_requerimiento:fecha_requerimiento, cod_articulo:cod_articulo, id_categoria:id_categoria, folio:folio,clave_solicita:clave_solicita,cantidad_aparta:cantidad_aparta,cantidad_compra:cantidad_compra},
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
            var options = {
                text: "Completado!",
                addclass: 'bg-success border-success',
                type: 'info',
                icon: 'icon-checkmark4',
                delay: 1000,
                hide: true,
                buttons: {
                    closer: true,
                    sticker: false
                }
            };
            notice.update(options);
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
function statusc(){
    alert($("#area_aquipo").val());
}