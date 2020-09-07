$(document).ready( function () {
    get_categoria();
    $('.form-control-select2').select2();
    $("body").addClass("sidebar-xs");
    $(".almacen").addClass("active");
    $(".almacen i").addClass("text-orange-800");
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        ajax: {
            url: "json_selectAlmacen.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'cod_articulo'},
            {data : 'descripcion'},
            {data : 'stock'},
            {data : 'stock_min'},
            {data : 'stock_max'},
            {data : 'accion'}
        ],
        rowGroup: {
            dataSrc: 'nombre_categoria'
        },
        columnDefs: [
            {targets: 5, className:'text-center text-primary-800'}
        ],
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Busqueda...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
    
    $('#dt_for_inventario').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-footer"><"datatable-scroll-wrap"t>',
        createdRow: function ( row, data, index ) {
            $('td', row).eq(1).addClass('font-weight-semibold text-pink');
        },
        columnDefs: [
            {targets: 0, className:'text-right'},
            {targets: 2, className:'text-center'}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        }
    });
} );
 function inventarear(e){
     var cod_articulo = $("#"+e.target.id).data("codarticulo");
     var t = $('#dt_for_inventario').DataTable();
     $.post('json_inventariar.php',{ cod_articulo: cod_articulo },function(res){
         $.each(res, function (index, value) {
                t.row.add( [
                    value.status,
                    value.cod_articulo,
                    value.unidad,
                    value.no_serie,
                    value.no_inventario,
                    value.costo,
                    value.accion
                ] ).draw( false );
                $("#descripcion").val(value.descripcion);
            });
     }).done(function() {
        $('#old_cod_articulo').val(cod_articulo);
        $('#modal_inventario').modal('show');
        $('.touchspin-prefix').TouchSpin({
            min: 0,
            max: 100000000,
            step: 0.1,
            decimals: 2,
            prefix: '$'
        });
        $('.bootstrap-touchspin-up').addClass('btn-sm alpha-primary text-primary-800 legitRipple font-weight-bold').removeClass('btn-light');
        $('.bootstrap-touchspin-down').addClass('btn-sm alpha-primary text-primary-800 legitRipple font-weight-bold').removeClass('btn-light');
    });
 }
 function guarda_inventario(e){
    var cod_articulo_new = $("#"+e.target.id).data("numercodarticulo");
    var cod_articulo = $("#old_cod_articulo").val();
    var no_serie = $("#ser_"+cod_articulo_new).val();
    var no_inventario = ($('#inv_'+cod_articulo_new).val()).trim();
    var costo = $('#cos_'+cod_articulo_new).val();
    var inventariado = $('#'+e.target.id).data('inventariado');
    if(no_inventario == "" && inventariado == 'no'){
        console.log('Formulario vacio. No se guardo cambios');
    }else{
        $.post('json_set_inventario.php',{ cod_articulo: cod_articulo, cod_articulo_new: cod_articulo_new, no_serie:no_serie, no_inventario:no_inventario,costo:costo,inventariado:inventariado},function(res){
            if((res[0].type == 'update' || res[0].type == 'insert') && res[0].result == '1'){
                $("#ico_"+cod_articulo_new).removeClass('icon-price-tag3 text-slate-300').addClass('icon-price-tag2 text-pink');
                $('#'+e.target.id).data('inventariado','si');
            }else if(res[0].type == 'delete' && res[0].result == '1'){
                $("#ico_"+cod_articulo_new).addClass('icon-price-tag3 text-slate-300').removeClass('icon-price-tag2 text-pink');
                $("#"+e.target.id).data('inventariado','no');
                clear_form_inv(cod_articulo_new);
            }else if(res[0].type == 'check' && res[0].result == 'exist'){
                alert("El numero de inventario asignado ya existe.");
            }
            console.log('type:'+res[0].type+', result:'+res[0].result);
        });
    }
 }
 function clear_form_inv(cod_articulo_new){
    $("#ser_"+cod_articulo_new).val("");
    $("#inv_"+cod_articulo_new).val("");
    $("#cos_"+cod_articulo_new).val("0.00");
 }
 function  fecha_actual(){
    $.post('json_now.php',function(res){$('#num_folio_vale_salida').text(getFolio(res.fecha_actual));});
 }
 function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}
function salir(){
    $("#modal_inventario").modal("hide");
    var table = $('#dt_for_inventario').DataTable();
    table.clear().draw();
}
function propiedadArticle(e){
    var id = e.target.id;
    var cod_articulo = $("#"+id).data("codarticulo");
    $.post('json_propArticulo.php',{ cod_articulo: cod_articulo },function(res){
        //res[0].status,
        $("#new_codigobarra").val(res.cod_barra);
        $("#new_cod_inventario").val(res.cod_articulo);
        $('#new_tipounidad option[value='+res.tipo_unidad+']').prop('selected', 'selected').change();
        $('#select_categoria option[value='+res.id_categoria+']').prop('selected', 'selected').change();
        $("#new_descripcion").val(res.descripcion);
        $("#new_especificacion").val(res.especificacion);
        $("#new_marca").val(res.marca);
        $("#new_stock").val(res.stock);
        $("#new_min").val(res.stock_min);
        $("#new_max").val(res.stock_max);
        $("#new_ubicacion").val(res.ubicacion);
        $("#new_idarticulo").val(res.id_articulo);
        
        if(res.salida_rapida == 1){
            $("#new_salida_rapida").prop("checked", true);
        }else{
            $("#new_salida_rapida").prop("checked", false);
        }
    }).done(function() {
        $("#article_new").modal("show");
    });
}
function cerrarArticle(){
    $("#article_new").modal("hide");
}
function updArticle(){
    var cod_barra     = $("#new_codigobarra").val(),
        cod_articulo  = $("#new_cod_inventario").val(),
        tipo_unidad   = $('#new_tipounidad').val(),
        id_categoria  = $('#select_categoria').val(),
        descripcion   = $("#new_descripcion").val(),
        especificacion= $("#new_especificacion").val(),
        marca         = $("#new_marca").val(),
        stock_min     = $("#new_min").val(),
        stock_max     = $("#new_max").val(),
        ubicacion     = $("#new_ubicacion").val(),
        id_articulo   = $("#new_idarticulo").val(),
        salida_rapida;
        if($("#new_salida_rapida").is(':checked')) {  
            salida_rapida = 1;
        } else {  
            salida_rapida = 0;
        } 
    
    $.post('json_update_propArticulo.php',{
        cod_articulo:cod_articulo,
        id_articulo:id_articulo,
        cod_barra:cod_barra,
        descripcion:descripcion,
        especificacion:especificacion,
        tipo_unidad:tipo_unidad,
        marca:marca,
        id_categoria:id_categoria,
        stock_min:stock_min,
        stock_max:stock_max,
        ubicacion:ubicacion,
        salida_rapida:salida_rapida
    },function(result){
        if(result[0].result == "exito"){
            alert("Se guardo correctamente!");
        }else{
            alert("Ocurrio un problema al guardar la información");
        }
        
    }).done(function() {
        $("#article_new").modal("hide");
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