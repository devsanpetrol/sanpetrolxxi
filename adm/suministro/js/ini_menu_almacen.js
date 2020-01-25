$(document).ready( function () {
    $.ajax({
        url: 'json_ini_menu_almacen.php',
        success: function (obj) {
            
        },
        error: function (obj) {
            alert(obj.msg);
        }
    });
} );
function countNoRead_menu_ini_almacen(name_class_menu,cantidad){
    var badge = "<span class='badge bg-success align-self-center ml-auto'>"+cantidad+"</span>";
    
    if(cantidad >= 100){
        badge.text("99+").removeClass("bg-success").addClass("bg-danger");
        $("."+name_class_menu).after(badge);
    }else if(cantidad > 0 && cantidad < 100){
        badge.text(cantidad).removeClass("bg-danger").addClass("bg-success");
        badge.show();
    }
    
}

