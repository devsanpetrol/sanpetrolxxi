$(document).ready( function () {
    get_norm_form_solicitud();
    get_categoria();
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
    $('#lay_out_solicitudesx').DataTable({
        paging: false,
        ordering: false,
        bDestroy: true,
        processing: true,
        selected: true,
        serverSide: true,
        dom: '<"datatable-scroll-wrap"t>',
        ajax: {
            url: "json_selectSolicitudBandeja.php",
            data:{user_session_id:user_session_id},
            type: 'POST',
            dataSrc:function ( json ) {
                $.post( "json_selectSolicitudTR.php").done(function( data ) {
                    objetoJSON_antes = data;
                    countNoRead();
                });
                return json;
            }
        },
        createdRow: function ( row, data, index ) {
            $(row).attr('id',data['folio']);
            if(data['leido'] == "0"){
                $(row).addClass('unread');
            }
            
            $(row).data('scroll');
            $('td', row).eq(0).addClass('table-inbox-checkbox');
            $('td', row).eq(1).addClass('table-inbox-image');
            $('td', row).eq(2).addClass('table-inbox-name');
            $('td', row).eq(3).addClass('table-inbox-message');
            $('td', row).eq(4).addClass('table-inbox-time');
        },
        columns: [
            {data : 'star'},
            {data : 'foto'},
            {data : 'solicita'},
            {data : 'pedidos'},
            {data : 'fecha'}
        ],
        columnDefs: [
            {targets: 0,width: '10%'},
            {targets: 1,width: '10%' },
            {targets: 2,width: '20%'},
            {targets: 3,width: '50%'},
            {targets: 4,width: '10%'}
        ],
        language: {
            zeroRecords: "Ningun elemento seleccionado"
        }
    });
    //--------TIEMPO REAL ---------
    var misSolicitudes = $('#lay_out_solicitudesx').DataTable();
    var objetoJSON_antes;
    var objetoJSON_despu;
    var OnOff = true;
    setInterval(function(){
        $.post( "json_selectSolicitudTR.php").done(function( data ) {
                objetoJSON_despu = data;
                if(JSON.stringify(objetoJSON_antes) === JSON.stringify(objetoJSON_despu)){
                }else{
                    console.log("Recargado");
                    countNoRead();
                    if(OnOff){
                        misSolicitudes.draw();
                    }
                }
        });
        
    }, 10000);
    //--------TIEMPO REAL ---------
    $('#lay_out_solicitudesx tbody').on('click', 'tr', function () {
        var id = this.id;
        
        $("#lay_out_solicitudesx tbody tr").addClass("ocultatodo");
        $("#"+id).removeClass("ocultatodo");
        if ($("#"+id).hasClass('sel-item')){
            $("#"+id).removeClass("sel-item");
            $("#lay_out_solicitudesx").slideDown();
            $('html, body').animate({
                scrollTop: $("#content_table_pedidos_list").data("scroll")
            }, 200);
            var t = $('#lay_out_solicitudesx').DataTable();
            t.draw( false );
            OnOff = true;
            $(".display-pedidos").remove();
            countNoRead();
        }else{
            $("#lay_out_solicitudesx").slideUp();
            
            $("#content_table_pedidos_list").data("scroll",$("html").scrollTop());
            $("#"+id).addClass("sel-item");
            setTimeout(function() {
                setPedidos(id);
            }, 500);
            OnOff = false;
        }
        $("#tools_menu_select").toggle("fast");
        $("#tools_menu_regresa").data("idrow",id);
        $(".ocultatodo").toggle("fast");
        $(".ocultatodo").removeClass("ocultatodo");
        
        return false;
    } );
    
    $('#select_article').select2({
        dropdownParent: $('#modal_large'),
        ajax: { 
            url: 'json_selectArticle.php',
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
                $('#cod_articulo').val(res.cod_articulo);
                $('#descripcion').val(res.descripcion);
                $('#especificacion').val(res.especificacion);
                $('#select_categoria').val(res.id_categoria).trigger('change');
                $('#unidad').val(res.tipo_unidad).trigger('change');
                count_apartado(res.stock);
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
    $('#buscar_en_tabla_layoutx').on( 'change paste keyup', function () {
        var table = $('#lay_out_solicitudesx').DataTable();
        table
            .search( this.value )
            .draw();
    });
    
} );
function  no_read_inbox(){
    $.post('json_count_no_read_inbox.php',function(res){
        var count = parseInt(res.noread), badge = $(".nuevas-entradas-inbox");
        if(count >= 100){
            badge.text("99+").removeClass("bg-success").addClass("bg-danger");
            badge.show();
        }else if(count > 0 && count < 100){
            badge.text(count).removeClass("bg-danger").addClass("bg-success");
            badge.show();            
        }else{
            badge.hide();
        }
    });
}
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
    //$("#unidad").val('pza')
    //$('#unidad option:eq(1)');
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
function generador_layout(){
    setTimeout(function() {
        var t = $('#lay_out_solicitudesx').DataTable();
        t.draw( false );
    }, 500);
    $(".display-pedidos").remove();
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
                obj_pedido(value);
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
function change_status(id_pedido,stat){
    var status = parseInt(stat);
    var badge  = $("#id_pedido_"+id_pedido);
    var borde  = $("#border_card_"+id_pedido);
    var guarda = $("#guarda_status_"+id_pedido);
    borde.attr("class","card border-left-3 rounded-left-0");
    badge.attr("class","badge align-top dropdown-toggle");
    switch (status){
        case 1:
          badge.addClass("bg-success");
          borde.addClass("border-left-success");
          guarda.data("status",1);
          badge.text("Aprobado");
          break;
        case 2:
          badge.addClass("bg-danger");
          borde.addClass("border-left-danger");
          guarda.data("status",2);
          badge.text("Cancelado");
          break;
        case 3:
          badge.addClass("bg-warning");
          borde.addClass("border-left-warning");
          guarda.data("status",3);
          badge.text("En revisión");
          break;
        case 4:
          badge.addClass("bg-purple");
          borde.addClass("border-left-purple");
          guarda.data("status",4);
          badge.text("Enviado a compra");
          break;
        case 5:
          badge.addClass("bg-primary");
          borde.addClass("border-left-primary");
          guarda.data("status",5);
          badge.text("Listo entrega");
          break;
        case 6:
          badge.addClass("bg-secondary");
          borde.addClass("border-left-secondary");
          guarda.data("status",6);
          badge.text("Entregado");
          break;
        case 8:
          badge.addClass("bg-pink-400");
          borde.addClass("border-left-pink-400");
          guarda.data("status",8);
          badge.text("Compra autorizada");
          break;
        case 9:
          badge.addClass("bg-violet-400");
          borde.addClass("border-left-violet-400");
          guarda.data("status",9);
          badge.text("Compra no autorizada");
          break;
        case 10:
          badge.addClass("bg-indigo-800");
          borde.addClass("border-left-indigo-800");
          guarda.data("status",10);
          badge.text("Material recibido");
          break;
    }
}
function change_edita_cantidad(id_pedido){
    $.post( "json_selectStatPedidoMan.php",{ id_pedido:id_pedido }).done(function( data ) {
        var status = parseInt(data[0]["aprobacion"]);
        var badge  = $("#edita_cantidad"+id_pedido);
        switch (status){
            case 0:
              badge.show();
              break;
            default:
              badge.hide();
              break;
        }
    });
    
}
function disable_class_btn(id_pedido,disabled){
    $("#status_icon_a_"+id_pedido).prop( "disabled", disabled );
    $("#status_icon_d_"+id_pedido).prop( "disabled", disabled );
    $("#status_icon_r_"+id_pedido).prop( "disabled", disabled );
}
function reset_class_btn(id_pedido){
    $("#status_icon_a_"+id_pedido).attr("class","btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm  btn-status-pedido");
    $("#status_icon_d_"+id_pedido).attr("class","btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm  btn-status-pedido");
    $("#status_icon_r_"+id_pedido).attr("class","btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm  btn-status-pedido");
}
function change_status_manager(id_pedido,aprobado){ // AUTORIZADO, CANCELADO Y REVISION
    var status = parseInt(aprobado);
    var sel_st = $(".menu_items_status_"+id_pedido);
    var autoriza = $("#autoriza_"+id_pedido);
    var grupo = $(".btn-status-pedido-"+id_pedido);
    sel_st.addClass('disabled');
    reset_class_btn(id_pedido);
    
    switch ( status ){
        case 0:
            autoriza.hide();//Nombre del quien autoriza
            break;
        case 1://status APROBADO
            var aprobe = $("#status_icon_a_"+id_pedido);
            aprobe.removeClass("text-slate-400").addClass("text-pink");
            grupo.prop( "disabled", true );
            sel_st.removeClass('disabled');
            autoriza.show();
          break;
        case 2:// status CANCELADO
            var cancel = $("#status_icon_d_"+id_pedido);
            cancel.removeClass("text-slate-400").addClass("text-pink");
            grupo.prop( "disabled", true );
            autoriza.show();
          break;
        case 3:// status REVISION
            var revisi = $("#status_icon_r_"+id_pedido);
            revisi.removeClass("text-slate-400").addClass("text-pink");
            autoriza.show();
          break;
    }
}
function generic_guarda_status(id_pedido,status_pedido){
    var notice = new PNotify();
    $.ajax({
        data:{id_pedido:id_pedido,status_pedido:status_pedido},
        url: 'json_update_pedido.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Actualizando...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
            disable_class_btn(id_pedido,true);
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-success border-success',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
                change_status_manager(id_pedido,status_pedido);
                change_status(id_pedido,status_pedido);
            }else{
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-danger border-danger',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
            }
        },
        complete: function (jqXHR, textStatus) {
            disable_class_btn(id_pedido,false);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });

}
function generic_guarda_status_other(id_pedido,status_pedido){
    var notice = new PNotify();
    $.ajax({
        data:{id_pedido:id_pedido,status_pedido:status_pedido},
        url: 'json_update_pedido.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Actualizando...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
            disable_class_btn(id_pedido,true);
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-success border-success',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
                change_status(id_pedido,status_pedido);
            }else{
                var options = {
                    title: 'Exitoso!',
                    text: 'Información actualizada',
                    addclass: 'bg-danger border-danger',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
            }
        },
        complete: function (jqXHR, textStatus) {
            disable_class_btn(id_pedido,false);
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });

}
function save_aprobado(id_pedido){
    var btn_guarda_a = $("#status_icon_a_"+id_pedido);
    if (btn_guarda_a.hasClass("text-slate-400")){
        generic_guarda_status(id_pedido,1);
    }else{
        generic_guarda_status(id_pedido,0);
    }
}
function save_cancela(id_pedido){
    var btn_guarda_c = $("#status_icon_d_"+id_pedido);
    if (btn_guarda_c.hasClass("text-slate-400")){
        generic_guarda_status(id_pedido,2);
    }else{
        generic_guarda_status(id_pedido,0);
    }
}
function save_revisa(id_pedido){
    var btn_guarda_r = $("#status_icon_r_"+id_pedido);
    if (btn_guarda_r.hasClass("text-slate-400")){
        generic_guarda_status(id_pedido,3);
    }else{
        generic_guarda_status(id_pedido,0);
    }
}
function obj_pedido(objeto){
    var user_session_id = $("#user_session_id").data("employeid");
    var activo = "disabled";
    
    console.log("user_session_id: " + user_session_id +"; objeto.id_autoriza "+objeto.id_autoriza +"; activo: " + activo);
    var detalle = "style='display: none;'";
    if(objeto.detalle_articulo.length){
        detalle = "";
    }
   
    this.elemento = "<div class='col-lg-12 display-pedidos' style='display: none;' id='folio-"+objeto.folio+"'>\
                        <div class='card border-left-3 border-left-danger rounded-left-0' id='border_card_"+objeto.id_pedido+"'>\
                            <div class='card-body'>\
                                <div class='d-sm-flex align-item-sm-center flex-sm-nowrap'>\
                                    <div>\
                                        <h6 class='font-weight-semibold'>"+objeto.articulo+"</h6>\
                                        <ul class='list list-unstyled mb-0'>\
                                            <li "+detalle+">Detalle articulo : <span class='font-weight-semibold'>"+objeto.detalle_articulo+"</span></li>\
                                            <li>Justificación : <span class='font-weight-semibold'>"+objeto.justificacion+"</span></li>\
                                            <li>Categoria: <span class='font-weight-semibold'>"+objeto.categoria+"</span></li>\
                                        </ul>\
                                    </div>\
                                    <div class='text-sm-right mb-0 mt-3 mt-sm-0 ml-auto'>\
                                        <h6 class='font-weight-semibold' id='cantidad_unidad_edit"+objeto.id_pedido+"' data-unidad='"+objeto.unidad+"'>"+objeto.cantidad+" "+objeto.unidad+" \
                                            <input type='number' class='font-weight-semibold text-blue-800' step='1' value='"+objeto.cantidad+"' min='0' id='cantidad_"+objeto.id_pedido+"' required='true' style='width: 75px; display: none;'>\
                                            <button type='button' class='btn btn-icon btn-sm' id='guarda_cantidad"+objeto.id_pedido+"' onclick='save_cantidad("+objeto.id_pedido+")' style='display: none;'><i class='icon-floppy-disk'></i></button>\
                                            <button type='button' class='btn btn-icon btn-sm' id='edita_cantidad"+objeto.id_pedido+"' onclick='edita_cantidad("+objeto.id_pedido+")'><i class='icon-pencil7'></i></button>\
                                        </h6>\
                                        <ul class='list list-unstyled mb-0'>\
                                            <li>Area/Equipo: <span class='font-weight-semibold'>"+objeto.destino+"</span></li>\
                                            <li>Programado para: <span class='font-weight-semibold'>"+objeto.fecha_requerimiento+"</span></li>\
                                            <li class='dropdown' disabled>\
                                                Status: &nbsp;\
                                                <a href='#' class='badge align-top dropdown-toggle' data-toggle='dropdown' id='id_pedido_"+objeto.id_pedido+"'>Sin seguimiento</a>\
                                                <div class='dropdown-menu dropdown-menu-right'>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='4' onclick='generic_guarda_status_other("+objeto.id_pedido+",4)'><i class='icon-cart-add'></i> Enviar a compra</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='10' onclick='generic_guarda_status_other("+objeto.id_pedido+",10)'><i class='icon-box-add'></i> Material recibido</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='5' onclick='generic_guarda_status_other("+objeto.id_pedido+",5)'><i class='icon-bell3'></i> Listo entrega</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='6' onclick='generic_guarda_status_other("+objeto.id_pedido+",6)'><i class='icon-clipboard2'></i> Entregado</a>\
                                                    <div class='dropdown-divider'></div>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='9' onclick='generic_guarda_status_other("+objeto.id_pedido+",9)'><i class='icon-exclamation'></i> Compra no autorizada</a>\
                                                    <a class='menu_items_status_"+objeto.id_pedido+" dropdown-item' data-status='8' onclick='generic_guarda_status_other("+objeto.id_pedido+",8)'><i class='icon-stamp'></i> Compra autorizada</a>\
                                                </div>\
                                            </li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class='card-footer d-sm-flex justify-content-sm-between align-items-sm-center'>\
                                <span>\
                                    <span class='badge badge-mark border-danger mr-2'></span>\
                                    <span class='font-weight-semibold'>"+objeto.fecha_solicitud+"</span>\
                                    <div class='text-primary-700 font-size-sm' id='autoriza_"+objeto.id_pedido+"'><span class='badge badge-mark border-danger mr-2'></span>Revisó: "+objeto.autoriza+"</div>\
                                </span>\
                                <ul class='list-inline list-inline-condensed mb-0 mt-2 mt-sm-0'>\
                                    <li class='list-inline-item' style='display: none;'>\
                                        <a href='' class='text-default' data-status='0' data-comentario='' onclick='guarda_status("+objeto.id_pedido+")' id='guarda_status_"+objeto.id_pedido+"'><i class='icon-floppy-disk'></i></a>\
                                    </li>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_a_"+objeto.id_pedido+"' onclick='save_aprobado("+objeto.id_pedido+")'><i class='icon-thumbs-up2'></i></button>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_d_"+objeto.id_pedido+"' onclick='save_cancela("+objeto.id_pedido+")'><i class='icon-thumbs-down2'></i></button>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_r_"+objeto.id_pedido+"' onclick='save_revisa("+objeto.id_pedido+")'><i class='icon-eye8'></i></button>\
                                    <button type='button' class='btn btn-outline rounded-round btn-icon ml-2 bg-primary text-slate-400 btn-sm btn-status-pedido btn-status-pedido-"+objeto.id_pedido+"' id='status_icon_s_"+objeto.id_pedido+"'><i class='icon-clipboard2'></i></button>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>";
    
    $("#tabla_visor_solicitudes").after(this.elemento);
    change_status(objeto.id_pedido,objeto.status_pedido);
    change_edita_cantidad(objeto.id_pedido);
    if (user_session_id == objeto.id_autoriza){
       $(".btn-status-pedido").prop( "disabled", false );
    }else{
        $(".btn-status-pedido").prop( "disabled", true );
    }
    change_status_manager(objeto.id_pedido,objeto.aprobacion);
    if(objeto.comentario.length){
        $.post( "json_selectPedidoComentario.php",{ id_pedido: objeto.id_pedido }).done(function( data ) {
            $( "#post_nombre_man"+objeto.id_pedido).append(data[0]["supervisor"]);
        });
    }
    $("#folio-"+objeto.folio).slideDown();
    
}
function save_cantidad(id_pedido){
    var notice = new PNotify();
    var cantidad = $("#cantidad_"+id_pedido).val();
    $.ajax({
        data:{id_pedido:id_pedido,cantidad:cantidad},
        url: 'json_update_cantidad.php',
        type: 'POST',
        beforeSend: function (xhr) {
            var options = {
                text: "Actualizando...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false
            };
            notice.update(options);
        },
        success: function (obj) {
            if(obj[0]["result"] == "exito"){
                var options = {
                    title: 'Listo!',
                    text: 'Información actualizada',
                    addclass: 'bg-success border-success',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-paperplane',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
                addNuewElemet(cantidad,id_pedido);
            }else{
                var options = {
                    title: 'Error',
                    text: 'Ocurrio un error durante la operación!',
                    addclass: 'bg-danger border-danger',
                    type: 'success',
                    delay:1000,
                    buttons: {
                        closer: true,
                        sticker: false
                    },
                    icon: 'icon-close2',
                    opacity : 1,
                    hide: true
                };
                notice.update(options);
            }
        },
        error: function (obj) {
            console.log(obj.msg);
        }
    });
}
function edita_cantidad(id_pedido){
    $("#guarda_cantidad"+id_pedido).toggle();
    $("#cantidad_"+id_pedido).toggle();
}
function addNuewElemet(cantidad,id_pedido){
    var unidad = $("#cantidad_unidad_edit"+id_pedido).data("unidad");
    $("#cantidad_unidad_edit"+id_pedido).empty();
    $("#cantidad_unidad_edit"+id_pedido)
        .append(cantidad+" "+unidad+" \
            <input type='number' class='font-weight-semibold text-blue-800' step='1' value='"+cantidad+"' min='0' id='cantidad_"+id_pedido+"' required='true' style='width: 75px; display: none;'>\
            <button type='button' class='btn btn-icon btn-sm' id='guarda_cantidad"+id_pedido+"' onclick='save_cantidad("+id_pedido+")' style='display: none;'><i class='icon-floppy-disk'></i></button>\
            <button type='button' class='btn btn-icon btn-sm' id='edita_cantidad"+id_pedido+"' onclick='edita_cantidad("+id_pedido+")'><i class='icon-pencil7'></i></button>");
}
function statusc(){
    alert($("#area_aquipo").val());
}
function countNoRead(){
    var count = $(".unread").length;
    var badge = $("#total_pedidos_mostrado");
    badge.hide();
    if(count >= 100){
        badge.text("99+").removeClass("bg-success").addClass("bg-danger");
        badge.show();
        console.log("count >= 100");
    }else if(count > 0 && count < 100){
        badge.text(count).removeClass("bg-danger").addClass("bg-success");
        badge.show();
        console.log("count > 0 || count < 100");
    }
}