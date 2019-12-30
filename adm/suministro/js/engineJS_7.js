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
            {data : 'nombre_categoria'},
            {data : 'nombre_proveedor'},
            {data : 'accion'}
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
            //$(row).attr("id","id_row_"+data[3]);
        },
        columnDefs: [
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
                    value.cod_articulo,
                    value.descripcion,
                    value.unidad,
                    value.no_serie,
                    value.no_inventario
                ] ).draw( false );
            });
     }).done(function() {
        $("#modal_inventario").modal("show");
    });
     
     
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