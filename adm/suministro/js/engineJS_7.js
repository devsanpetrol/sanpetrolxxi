$(document).ready( function () {
    $("body").addClass("sidebar-xs");
    
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
            {data : 'no_inventario'},
            {data : 'descripcion'},
            {data : 'stock'},
            {data : 'stock_min'},
            {data : 'stock_max'},
            {data : 'nombre_proveedor'},
            {data : 'accion'}
        ],
        rowGroup: {
            dataSrc: 'nombre_categoria'
        },
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
                    value.accion
                ] ).draw( false );
                $("#descripcion").val(value.descripcion);
            });
     }).done(function() {
        $("#old_cod_articulo").val(cod_articulo);
        $("#modal_inventario").modal("show");
    });
 }
 function guarda_inventario(e){
    var cod_articulo_new = e.target.id;
    var cod_articulo = $("#old_cod_articulo").val();
    var no_serie = $("#ser_"+cod_articulo_new).val();
    var no_inventario = $("#inv_"+cod_articulo_new).val();
    if(no_inventario != ""){
        $.post('json_set_inventario.php',{ cod_articulo: cod_articulo, cod_articulo_new: cod_articulo_new, no_serie:no_serie, no_inventario:no_inventario},function(res){
            $("#ico_"+cod_articulo_new).removeClass("icon-price-tag3 text-slate-300").addClass("icon-price-tag2 text-pink");
        });
    }else{
        console.log("Formulario vacio. No se guardo cambios");
    }
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