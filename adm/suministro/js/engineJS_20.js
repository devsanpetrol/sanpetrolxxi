$(document).ready( function () {
    $(".inicio_nuevo_epp_control").addClass("active");
    $(".inicio_nuevo_epp_control i").addClass("text-orange-800");
    
    var user_session_id = $('#user_session_id').data("employeid");
    
    $("#search_personal").bind('keypress', function(event) {
        //mybind(event,"^[0-9 ]|[\.]+$");
    }).on('keyup', function (e){
        if (e.keyCode === 13){
            buscar_empleado();
        }
    });
    $('#personal_tabla').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-footer"><"datatable-scroll-wrap"t>',
        columnDefs: [
            {targets: -1, className:'text-center text-primary-800'}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        }
    });
    $('#solicitudes_tabla').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5'
        ],
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        columnDefs: [
            //{targets: -1, className:'text-center text-primary-800'}
        ],
        language: {
            info: "Mostrando _TOTAL_ registros"
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        }
    });
} );

function buscar_empleado(){
     var nombre = $("#search_personal").val();
     var t = $('#personal_tabla').DataTable();
     t.clear().draw();
     $.post('json_selectPersonal_epp.php',{ nombre: nombre },function(res){
         $.each(res, function (index, value) {
                t.row.add([
                    value.nombre,
                    value.cargo,
                    value.accion
                ] ).draw( false );
            });
     }).done(function() {
         
     });
 }
 function buscar_historico(e){
    var obj = e.target,
        id_empleado = $(obj).data('idempleado'),
        nm_empleado = $(obj).data('nombre');
    var t = $('#solicitudes_tabla').DataTable();
    t.clear().draw();
    $.post('json_selectPersonal_epp_view.php',{ id_empleado: id_empleado },function(res){
         $.each(res, function (index, value) {
            t.row.add([
                value.articulo,
                value.status,
                value.fecha
            ] ).draw( false );
        });
        $("#nombre_empleado").html(nm_empleado);
     }).done(function() {
        var filas = t.rows().count();
        if(filas <= 0){
            alert("No se encontró registros para mostrar.");
        }
    });
 }