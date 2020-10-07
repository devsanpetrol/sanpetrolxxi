$(document).ready( function () {
    $(".inicio_nuevo_asignacion_control").addClass("active");
    $(".inicio_nuevo_asignacion_control i").addClass("text-orange-800");
    $("#card_addAsignacion").hide();
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
    $('#empleado_tabla_aplica').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        ajax: {
            url: "json_empleado_aplica.php",
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'nombre'},
            {data : 'puesto'},
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
    $('#articulo_tabla_aplica').DataTable({
        bDestroy: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        ajax: {
            url: "json_activo_aplica.php",
            type:"post",
            data:({filter:'WHERE status = 1'}),
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'cod_articulo'},
            {data : 'descripcion'},
            {data : 'especificacion'},
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
    $('#solicitudes_tabla').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        lengthMenu: [[5, 10], [5, 10]],//-1 = all
        language: {
            info: "Mostrando _TOTAL_ registros"
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        }
    });
    $('#tabla_pedidos').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        bDestroy: true,
        createdRow: function ( row, data, index ) {
            $('td', row).eq(0).addClass('font-weight-semibold text-blue-800');
            $('td', row).eq(1).addClass('font-weight-semibold text-blue-800');
            $('td', row).eq(2).addClass('font-weight-semibold');
        },
        language: {
            zeroRecords: "Ningun elemento agregado"
        }
    });
} );
function get_articulo(e){
    var obj = e.target;
    var i_codigoinventario = $(obj).data('nombre');
    var i_descripcion = $(obj).data('descripcion');
    var i_noserie = $(obj).data('noserie');
        $("#i_codigoinventario").val(i_codigoinventario);
        $("#i_descripcion").val(i_descripcion);//
        $("#i_noserie").val(i_noserie);
}
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
    $.post('json_selectPersonal_asignacion_view.php',{ id_empleado: id_empleado },function(res){
         $.each(res, function (index, value) {
            t.row.add([
                value.articulo,
                value.status,
                value.fecha_recibe
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
 function openCardNewAsignacion(){
    $("#card_addAsignacion").toggle("fast");
 }
 function hide_showModalNewEmp(){
    $("#busca_empleado" ).modal("hide");
}
function hide_showModalNewArt(){
    $("#busca_articulo" ).modal("hide");
}
function get_empleado(e){
    var obj = e.target;
    var i_nombre = $(obj).data('nombre'),
        i_puesto = $(obj).data('puesto'),
        i_idempleado = $(obj).data('idempleado');

    $("#solicitante").val(i_nombre).data('idempleado',i_idempleado);
    $("#puesto").val(i_puesto);
}
function cerrarNewAsignacion(){
    $("#card_addAsignacion").toggle("fast");
}
function addElementToTable(){
    if($('#i_noserie').val() != "" && $('#i_codigoinventario').val() != "" && $('#i_descripcion').val() != ""){
        var sn = $('#i_noserie').val();
        var cod_inv = $('#i_codigoinventario').val();
        var desc = $('#i_descripcion').val();
        
        var t = $('#tabla_pedidos').DataTable();
        
        t.row.add( [
            sn, //0
            cod_inv,      //1
            desc
        ] ).draw( false );
        $(".input-newarticle").val("");
    }    
}