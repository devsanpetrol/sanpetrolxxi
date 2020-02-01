$(document).ready( function () {
    ini_notify_almacen();
} );
function ini_notify_almacen(){
    $.ajax({
        url: 'json_ini_menu_almacen.php',
        beforeSend: function() {
            $('.notify-almacen').remove();
        },
        success: function (obj) {
            countNoRead_menu_ini_almacen("almacen_salida",obj.almacen_salida);
            countNoRead_menu_ini_almacen("almacen_salida_aprobada",obj.almacen_salida_aprobada);
            countNoRead_menu_ini_almacen("almacen_salida_compra",obj.almacen_salida_compra);
            countNoRead_menu_ini_almacen("aprobacion_salida_compra_alm",obj.aprobacion_salida_compra_alm);
            countNoRead_menu_ini_almacen("almacen_pendiente_surtido",obj.almacen_pendiente_surtido);
        },
        error: function (obj){
            alert(obj.msg);
        }
    });
}
function countNoRead_menu_ini_almacen(name_class_menu,cantidad){
    if(cantidad >= 100){
        $("."+name_class_menu).append("<span class='badge bg-danger align-self-center ml-auto notify-almacen'>+99</span>");
    }else if(cantidad > 0 && cantidad < 100){
        $("."+name_class_menu).append("<span class='badge bg-success align-self-center ml-auto notify-almacen'>"+cantidad+"</span>");
    }
}

