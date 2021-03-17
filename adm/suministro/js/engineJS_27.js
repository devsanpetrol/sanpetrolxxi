$(document).ready( function () {
    
    $('#row_table_inv').hide();
    $('.form-control-select2').select2();
    $('body').addClass('sidebar-xs');
    $('.lnkproveedores').addClass('active');
    $('.lnkproveedores i').addClass('text-orange-800');
    vh_hide_1();
    get_homologacion_proveedor();
    $('#almacen_tabla').DataTable({
        bDestroy: true,
        dom: 'Blfrtip',
        pageLength : 30,
        lengthMenu: [[30, 40, 50, -1], [40, 50, 'Todos']],
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
            {data : 'rfc'},
            {data : 'direccion'},
            {data : 'email'},
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

function openEditProveedor(e){
    var obj = e.target.id;
    var id_proveedor = $('#'+obj).data('idproveedor');
    var promesa = $.post('json_propProveedor.php',{ id_proveedor: id_proveedor },function(res){
        $('#idproveedor').html('ID: '+res.id_proveedor);
        $('#new_rfc').val(res.rfc);
        $('#new_nombre').val(res.nombre);
        $('#new_razon_social').val(res.razon_social);
        $('#new_direccion').val(res.direccion);
        $('#new_num_telefono').val(res.num_telefono);
        $('#new_email').val(res.email);
        $('#new_pagina_web').val(res.pagina_web);
        $('#new_actividad_comercial').val(res.actividad_comercial);
    });
    $.when(promesa).done($('#busca_proveedor').modal('show'));
}

function hide_showNewProveedor(){
    $('#formnewprov')[0].reset();
    close_alert2();   
}
function hide_showModalNewProv(){
    $('#busca_proveedor' ).modal('hide');
    $('#idproveedor').html('');
    hide_showNewProveedor();
}
function guarda_new_prov(){
    var id_proveedor = $('#idproveedor').html().replace('ID: ', '');
    var rfc = $('#new_rfc').val();
    var nombre = $('#new_nombre').val();
    var razon_social = $('#new_razon_social').val();
    var direccion = $('#new_direccion').val();
    var num_telefono = $('#new_num_telefono').val();
    var email = $('#new_email').val();
    var pagina_web = $('#new_pagina_web').val();
    var actividad_comercial = $('#new_actividad_comercial').val();
    
    if (confirm('¿Guardar los cambios realizado al Nuevo Proveedor?')) {
        if(nombre.trim() !== ''){
            if(id_proveedor == ''){ //Guarda nuevo proveedor
                insert_toDB_proveedor(rfc,nombre,razon_social,direccion,num_telefono,email,pagina_web,actividad_comercial);
            }else{ //Modifica datos del proveedor
                update_toDB_proveedor(id_proveedor,rfc,nombre,razon_social,direccion,num_telefono,email,pagina_web,actividad_comercial);
            }
        }else{
            close_alert2();
        }
    }
}
function insert_toDB_proveedor(rfc,nombre,razon_social,direccion,num_telefono,email,pagina_web,actividad_comercial){
    $.ajax({
        data:{rfc:rfc,nombre:nombre,razon_social:razon_social,direccion:direccion,num_telefono:num_telefono,email:email,pagina_web:pagina_web,actividad_comercial:actividad_comercial},
        url: 'json_set_newprov.php',
        type: 'POST',
        success:(function(res){
            if(res[0].result == 'vacio'){
                $('#msj_alert2').show(200);
            }else if(res[0].result == true){
                var table = $('#almacen_tabla').DataTable();
                table.ajax.reload();
                hide_showModalNewProv();
            }else if(res[0].result == false){
                alert('Error al guardar');
            }
        })
    });
}
function update_toDB_proveedor(id_proveedor,rfc,nombre,razon_social,direccion,num_telefono,email,pagina_web,actividad_comercial){
    $.ajax({
        data:{id_proveedor:id_proveedor,rfc:rfc,nombre:nombre,razon_social:razon_social,direccion:direccion,num_telefono:num_telefono,email:email,pagina_web:pagina_web,actividad_comercial:actividad_comercial},
        url: 'json_set_updprov.php',
        type: 'POST',
        success:(function(res){
            if(res[0].result == 'vacio'){
                $('#msj_alert2').show(200);
            }else if(res[0].result == true){
                var table = $('#almacen_tabla').DataTable();
                table.ajax.reload();
                hide_showModalNewProv();
            }else if(res[0].result == false){
                alert('Error al guardar');
            }
        })
    });
}

function openDeleProveedor(e){
    var obj = e.target.id;
    var id_proveedor = $('#'+obj).data('idproveedor');
    var promesa = $.post('json_propProveedor.php',{ id_proveedor: id_proveedor },function(res){
        $('#idproveedor_del').html('ID: '+res.id_proveedor);
        $('#del_rfc').val(res.rfc);
        $('#del_nombre').val(res.nombre);
        $('#del_razon_social').val(res.razon_social);
        $('#del_actividad_comercial').val(res.actividad_comercial);
    });
    $.when(promesa).done($('#eliminar_proveedor').modal('show'));
}

function get_homologacion_proveedor(){
    $.ajax({
    url: 'json_selectProveedores.php',
    dataType: "json",
    success: function(data){
        $.each(data,function(key, registro) {
            $("#proveedor_homologa").append("<option data-idproveedor='"+registro.id_proveedor+"' value='"+registro.id_proveedor+"'>"+registro.select_proveedor+"</option>");
        });
    },
    error: function(data){
      alert('error');
    }
  });
}
function eliminarProveedor(){
    $('#card_homo').hide();
    $('#foot_homo').hide();
    $('.alert-dismissible').hide();
    $('#main_error_del').hide();
    
    checkIfDelProveedor();
}
function checkIfDelProveedor(){
    var id_proveedor = $('#idproveedor_del').html().replace('ID: ', '');
    var table = $('#almacen_tabla').DataTable();
    
    if (confirm('¿Esta seguro de ELIMINAR el proveedor seleccionado?')) {
        $.ajax({
            data:{id_proveedor:id_proveedor},
            url: 'json_selecIfDelProveedor.php',
            type: 'POST',
            success:(function(res){
                if(res[0].total == 'relaciondado'){
                    vh_visible_1();
                }else if(res[0].total == 'ok'){
                    alert("El proveedor seleccionado se ha eliminado correctamente!");
                    table.ajax.reload();
                    salir();
                }
            })
        });
    }
}
function HomologaProveedor(){
    var id_proveedor = $('#idproveedor_del').html().replace('ID: ', '');
    var id_proveedor_nuevo = $('#proveedor_homologa').val();
    var table = $('#almacen_tabla').DataTable();
    
    if (confirm('¿Esta seguro de realizar la homologación del proveedor?')) {
        $.ajax({
            data:{id_proveedor:id_proveedor,id_proveedor_nuevo:id_proveedor_nuevo},
            url: 'json_selecIfHomoProveedor.php',
            type: 'POST',
            success:(function(res){
                if(res[0].result == 'ok'){
                    table.ajax.reload();
                    alert("La homologación se realizó correctamente. Intente Eliminar nuevamente el Proveedor.");
                    vh_hide_1();
                }else if(res[0].result == 'error'){
                    alert("Se produjo un error durante el proceso de homologación.");
                }else if(res[0].result == 'vacio'){
                    alert("FORMULARIO_VACIO");
                }
            })
        });
    }
}
function close_alert2(){
    $('.alert-dismissible').slideUp();
}
function toggle_3(){
    $('.alert-dismissible').toggle('slow');
}
function toggle_4(){
    $('#card_homo').toggle('slow');
    $('#foot_homo').toggle('slow');
}
function vh_visible_1(){
    $('.alert-dismissible').slideDown();
    $('#main_error_del').slideDown();
}
function vh_hide_1(){
    $('.alert-dismissible').slideUp();
    $('#main_error_del').slideUp();
    $('#card_homo').slideUp();
    $('#foot_homo').slideUp();
}
function salir(){
    $('#eliminar_proveedor' ).modal('hide');
    vh_hide_1();    
}