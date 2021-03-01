$(document).ready( function () {
    
    $("#row_table_inv").hide();
    $('.form-control-select2').select2();
    $("body").addClass("sidebar-xs");
    $(".lnkproveedores").addClass("active");
    $(".lnkproveedores i").addClass("text-orange-800");
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: 'Bfrtip',
        ordering: false,
        buttons:['excelHtml5'],
        ajax: {
            url: "json_selectProveedores.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'actividad'},
            {data : 'nombre_rfc'},
            {data : 'direccion'},
            {data : 'telefono'},
            {data : 'email'},
            {data : 'contacto'},
            {data : 'menu'}
        ],
        language:{
            search: '<span>Filtro:</span> _INPUT_',
            searchPlaceholder: 'Busqueda...',
            info: "Mostrando _START_ hasta _END_ de _TOTAL_ registros"
        }
    });
} );
 
 function  fecha_actual(){
    $.post('json_now.php',function(res){$('#num_folio_vale_salida').text(getFolio(res.fecha_actual));});
 }
 function mayus(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
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
function hide_showNewProveedor(){
    $("#formnewprov")[0].reset();
    close_alert2();
}
function hide_showModalNewProv(){
    $("#busca_proveedor" ).modal("hide");
    $("#formnewprov")[0].reset();
    close_alert2();
}
function close_alert2(){
    $('#msj_alert2').hide();
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
                    var table = $('#almacen_tabla').DataTable();
                    table.ajax.reload();
                    hide_showModalNewProv();
                }else if(res[0].result == false){
                    alert("Error al guardar");
                }
            })
        });
    }
}