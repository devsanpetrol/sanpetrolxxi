$(document).ready( function () {
    var user_session_id = $('#user_session_id').data("employeid");
    $(".icon-square-down-right").click( function () {
        $(this).removeClass("text-primary-800").addClass("text-pink-800");
    } );
    $(".inicio_nuevo_asignacion_control").addClass("active");
    $(".inicio_nuevo_asignacion_control i").addClass("text-orange-800");
    $("#card_addAsignacion").hide();
    $('#fecha_actual').val(moment().format('YYYY-MM-DD'));
    $('#filtro').val("0");
    $('#personal_tabla').DataTable({ //json_selectPersonal_epp.php',{ nombre: nombre }
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: 'frtip',
        ajax: {
            url: "json_selectPersonal_epp.php",
            data:({nombre:''}),
            dataSrc:function ( json ) {
                return json;
            }
        },
        select: {
            style: 'single'
        },
        createdRow: function ( row, data, index ) {
            $(row).attr('id',data['id_empleado']);
            $(row).attr('data-nombre',data['nombre_simple']);
        },
        columns: [
            {data : 'accion'},
            {data : 'nombre'},
            {data : 'cargo'}
        ],
        columnDefs: [
            {targets: 1, className:'font-size-sm font-weight-semibold text-primary-800'},
            {targets: 2, className:'font-size-sm font-weight-semibold'},
            {targets: '_all',createdCell: function (td, cellData, rowData, row, col) {
                    $(td).css({'padding-right':'10px','padding-left':'10px'});
                    }
            }
        ],
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Buscar empleado...',
            emptyTable: "Ningun resultado mostrado",
            info: "_TOTAL_ registros",
            zeroRecords: "",
            infoEmpty: ""
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        }
    });
    $('#solicitudes_tabla').DataTable({
        ordering: false,
        bDestroy: true,
        paging: false,
        dom: 'frtip',
        ajax: {
            url: "json_selectPersonal_asignacion_view.php",
            type:"POST",
            data:{id_empleado:function(){return $('#filtro_asignaciones').val();}},
            dataSrc:function ( json ) {
                return json;
            }
        },
        columnDefs: [
           {targets: 0, className:'font-size-sm font-weight-semibold text-primary-800'},
           {targets: '_all', createdCell: function (td, cellData, rowData, row, col) {
                $(td).css({'padding-right':'10px','padding-left':'10px','padding-bottom':'4px','padding-top':'4px'});
            }
        }
        ],
        columns: [
            {data : 'articulo'},
            {data : 'fecha_recibe'},
            {data : 'fecha_devolucion'},
            {data : 'accion'}
        ],
        rowGroup: {
            dataSrc: 'grupo'
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        },
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Buscar...',
            emptyTable: "Ningun resultado mostrado",
            info: "_TOTAL_ registros",
            zeroRecords: "",
            infoEmpty: ""
        }
    });
    $("#filtro_asignaciones").bind("change", function() { 
        refrescarTablaAsignaciones();
    }); 
    $('#personal_tabla tbody').on('click', 'tr', function () {
        var id_empleado = this.id;
        $("#nombre_empleado").html($(this).attr("data-nombre"));
        $("#nombre_empleado").data("idempleado",id_empleado);
        $("#filtro_asignaciones").val(id_empleado).trigger('change');
    } );
    
    $('#empleado_tabla_aplica').DataTable({
        ordering: false,
        lengthChange: false,
        paging: false,
        scrollY: '200px',
        dom: 'Bfrtip',
        buttons: [
            {   className: 'btn btn-sm btn-light btn-loading legitRipple text-danger',
                text: '<i class="icon-cross2 mr-2"></i> Salir',
                action: function ( e, dt, node, config ) {
                    hide_showModalNewEmp();
                }
            }
        ],
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
        columnDefs: [
           {targets: 0, className:'font-size-sm font-weight-semibold text-primary-800'},
           {targets: 1, className:'font-size-sm font-weight-semibold'}
        ],
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Buscar empleado...',
            info: "_TOTAL_ registros",
            zeroRecords: "",
            infoEmpty: ""
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        }
    });
    
    $('#articulo_tabla_aplica').DataTable({
        ordering: false,
        lengthChange: false,
        paging: false,
        scrollY: '400px',
        dom: 'frtiBp',
        buttons: [{
                className: 'btn btn-sm btn-light btn-loading legitRipple text-success',
                text: '<i class="icon-plus2 mr-2"></i> Agregar',
                action: function ( e, dt, node, config ) {
                    var indexes = dt.rows( {selected: true} ).indexes();
                    var data = dt.rows( {selected: true} ).data().toArray();
                    dt.rows( indexes ).remove().draw();
                    tablaDestino.rows.add( data ).draw();
                },
                attr:{
                    title: 'Agregar elementos seleccionados',
                    id: 'btn_del_selectx'
                }
            }
        ],
        select: {
            style: 'multi'
        },
        ajax: {
            url: "json_activo_aplica.php",
            type:"post",
            data:({filter:'WHERE status = 1 AND asignado = 0'}),
            dataSrc:function ( json ) {
                return json;
            }
        },
        columns: [
            {data : 'cod_articulo'},
            {data : 'descripcion'}
        ],
        createdRow: function ( row, data, index ) {
            $('td', row).eq(0).addClass('font-size-sm font-weight-semibold tablexz');
            $('td', row).eq(1).addClass('font-size-sm font-weight-semibold text-primary-800 text-uppercase tablexz');
        },
        columnDefs: [{
            targets: '_all',
            createdCell: function (td, cellData, rowData, row, col) {
                $(td).css({'padding-right':'10px','padding-left':'10px','padding-bottom':'4px','padding-top':'4px'});
            }
        }],
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Buscar...',
            info: "_TOTAL_ registros",
            zeroRecords: "",
            infoEmpty: "",
            emptyTable: "No hay elementos para asignar",
            select: {
                rows: {
                    _: "<b>%d filas seleccionadas</b>",
                    0: "",
                    1: "<b>1 fila seleccionada</b>"
                }
            }
        },
        drawCallback: function() {
            $(this.api().table().header()).hide();
        }
    });
       
    $('#tabla_pedidos').DataTable({
        searching: true,
        ordering: false,
        paging: false,
        scrollY: '400px',
        dom: 'frtiBp',
        buttons: [
            {   className: 'btn btn-sm btn-light btn-loading legitRipple text-danger',
                text: '<i class="icon-minus2 mr-2"></i> Quitar',
                action: function ( e, dt, node, config ) {
                    var indexes = dt.rows( {selected: true} ).indexes();
                    var data = dt.rows( {selected: true} ).data().toArray();
                    dt.rows( indexes ).remove().draw();
                    tablaOrigen.rows.add( data ).draw();
                },
                attr:  {
                    title: 'Remover elementos seleccionados',
                    id: 'btn_del_select'
                }
            }
        ],
        select: {
            style: 'multi'
        },
        columns: [
            {data : 'cod_articulo'},
            {data : 'descripcion'}
        ],
        columnDefs: [
           {targets: 0, className:'font-size-sm'},
           {targets: 1, className:'font-size-sm font-weight-semibold text-primary-800 text-uppercase'},
           {targets: '_all',
            createdCell: function (td, cellData, rowData, row, col) {
                $(td).css({'padding-right':'10px','padding-left':'10px','padding-bottom':'4px','padding-top':'4px'});
            }
        }
        ],
        language: {
            info: "_TOTAL_ registros",
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Buscar...',
            zeroRecords: "",
            infoEmpty: "",
            emptyTable: "Agregre aquí los elementos a asignar",
            select: {
                rows: {
                    _: "<b>%d filas seleccionadas</b>",
                    0: "",
                    1: "<b>1 fila seleccionada</b>"
                }
            }
        },
        drawCallback: function() {
            var tabla = this.api().table();
            $(tabla.header()).hide();
                        
            $('#btn_del_select').hide();
            if(tabla.rows().count()){
                $('#btn_del_select').show();
            }
        }
    });
    
    var tablaOrigen = $('#articulo_tabla_aplica').DataTable();
    var tablaDestino = $('#tabla_pedidos').DataTable();
} );

 function buscar_historico(e){
    var obj = e.target,
        id_empleado = $(obj).data('idempleado'),
        nm_empleado = $(obj).data('nombre');
        
    $("#nombre_empleado").html(nm_empleado);
    $("#nombre_empleado").data("idempleado",id_empleado);
    $("#filtro_asignaciones").val(id_empleado).trigger('change');
 }
 function limpiarTablaAsignaciones(){
     var t = $('#solicitudes_tabla').DataTable();
     t.clear().draw();
    $("#nombre_empleado").html("");
    $("#nombre_empleado").data("idempleado",0);
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
        i_idempleado = $(obj).data('idempleado');

    $("#solicitante").val(i_nombre).data('idempleado',i_idempleado);
    $("#nombre_style").html('<i class="icon-user mr-3"></i>'+i_nombre);
    $("#busca_empleado" ).modal("hide");
}
function cerrarNewAsignacion(){
    $("i.icon-square-down-right").addClass("text-primary-800").removeClass("text-pink-800");
    $("#card_addAsignacion").toggle("fast");
}
function recorreDataTable(){
    var table = $('#tabla_pedidos').DataTable();
    var fecha = $('#fecha_actual').val();
    var id_empleado = $('#solicitante').data('idempleado');
    var cont = table.rows().count();
    
    if(id_empleado > 0){
        table.column( 0 ).data().each( function ( value, index ) {
            var total = index + 1;
            guardaAsignacion(value,fecha,id_empleado);
            if (cont == total){ finishDocument();}
        });
    }else{
        alert("Debe seleccionar el empleado a aplicar la asignación.");
        $('#busca_empleado').modal('show');
    }
}
function finishDocument(){
    console.log('Finalizó la nueva asignación.');
    var table = $('#tabla_pedidos').DataTable();
    var id_empleado = $('#nombre_empleado').data('idempleado');
    
    table.clear().draw();
    refrescarInevtarioActivo();
    limpiarFormAsignacion();
    
    if(id_empleado > 0){
        $("#filtro_asignaciones").val(id_empleado).trigger('change');
    }
    $("#card_addAsignacion").toggle("fast");
}
function limpiarFormAsignacion(){
    $(".new-solicitud-form").val("");
    $("#solicitante").data("idempleado",0);
    $("#solicitante").val("");
    $("#puesto").val("");
    $('#fecha_actual').val(moment().format('YYYY-MM-DD'));
    $("#nombre_style").html('<i class="icon-user-plus mr-0"></i>');
}
function guardaAsignacion(cod_articulo,fecha,id_empleado){
    $.ajax({
        data:{cod_articulo:cod_articulo,fecha:fecha,id_empleado:id_empleado},
        url: 'json_insertAsignacion.php',
        type: 'POST',
        success:(function(res){
            if(res.stat == "no guardo"){
                console.log("no guardo. Error en la funcion -guardaAsignacion(cod_articulo,fecha,id_empleado)-");
                alert("Ocurrio un error al guardar la información. Revise que el formulario sea llenado correctamente.");
            }
        })
    });
}

function openModalDetail(id_asignacion){
    $("#modal_devolucion").modal("show");
    $("#modal_devolucion").data("idasignacion",id_asignacion);
    devolucion_detalle(id_asignacion);
}
function delvolver_material(){
    var id_asignacion = $("#modal_devolucion").data("idasignacion");
    var cod_articulo = $("#a_cod_articulo").html();
    var responsable = $("#a_responsable").html();
    var id_empleado = $("#a_responsable").data("idempleado");
    var d = new Date($("#a_fecha").val());
    var nd = new Date();
        nd.setDate(d.getDate()+1);
    var fecha = moment(nd).format('YYYY-MM-DD');
    var comentario = $("#a_comentario").val();
    var r = confirm("Se realizará la devolución del material asignado.\n\n¿Desea continuar con esta operación?");
    
    if (r) {
        if( $("#a_fecha").val() != ""){
            devolucion_json(cod_articulo,id_asignacion,id_empleado,fecha,responsable,comentario);
        }else{
            alert("Debe especificar la fecha de devolución.");
            $("#a_fecha").focus();
        }
    }
}
function closeModalDevolver(){
    $("#modal_devolucion").modal("hide");
}
function devolucion_json(cod_articulo,id_asignacion,id_empleado,fecha,responsable,comentario){
    $.ajax({
        data:{cod_articulo:cod_articulo,id_asignacion:id_asignacion,id_empleado:id_empleado,fecha:fecha,responsable:responsable,comentario:comentario},
        url: 'json_addDevolucion.php',
        type: 'POST',
        success:(function(res){
            if(res[0].result == 'exito'){
                console.log('¡La operacion de Devolución se realizó correctamente!');
            }else if(res[0].result == 'fallo'){
                console.log('Ocurrio un error al guardar la información. Revise que el formulario sea llenado correctamente');
                alert("Ocurrio un error al guardar la información. Revise que el formulario sea llenado correctamente.");
            }else if(res[0].result == 'vacio'){
                console.log("Ocurrio un error al guardar la información. Revise que el formulario sea llenado correctamente.");
                alert("Ocurrio un error al guardar la información. Revise que el formulario sea llenado correctamente.");
            }
        }),
        complete: (function () {
            $("#filtro_asignaciones").val(id_empleado).trigger('change');
            closeModalDevolver();
        })
    });
}
function devolucion_detalle(id_asignacion){
    $.ajax({
        data:{id_asignacion:id_asignacion},
        url: 'json_selectAsignacionDetail.php',
        type: 'POST',
        beforeSend: function (xhr) {
            $("#a_responsable").html("");
            $("#a_cargo").html("");
            $("#a_fecha_recibe").html("");
            $("#a_equipo").html("");
            $("#a_no_inventario").html("");
            $("#a_no_serie").html("");
            $("#a_cod_articulo").html("");
            $("#a_descripcion").html("");
            $("#a_fecha").val("");
        },
        success:(function(res){
            $("#a_responsable").html(res[0].nombre + " " + res[0].apellidos);
            $("#a_responsable").data("idempleado",res[0].id_empleado);
            $("#a_cargo").html(res[0].cargo);
            $("#a_fecha_recibe").html(res[0].fecha_recibe);
            $("#a_equipo").html(res[0].descripcion);
            $("#a_no_inventario").html(res[0].no_inventario);
            $("#a_no_serie").html(res[0].no_serie);
            $("#a_cod_articulo").html(res[0].cod_articulo);
            $("#a_descripcion").html(res[0].especificacion_tec);
        })
    });
}
function refrescarInevtarioActivo(){
    var table = $('#articulo_tabla_aplica').DataTable();
    table.ajax.reload();
 }
 function refrescarTablaAsignaciones(){
    var table = $('#solicitudes_tabla').DataTable();
    table.ajax.reload();
 }