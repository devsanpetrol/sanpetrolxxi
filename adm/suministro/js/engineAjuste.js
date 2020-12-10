$(document).ready( function () {
    
} );

function buscar_empleado(){
     var cod_articulo = $("#cod_articulo").val();
     $.post('json_AjusteBuscaCodigo.php',{ cod_articulo: cod_articulo },function(res){
            if(res[0].error == 0){
                $("#descripcion").html(res[0].descripcion);
            }else{
                $("#descripcion").html(res[0].error_detail);
            }
     }).done(function() {
         
     });
 }
 
 function ajustaAlmacen(){
     var cod_articulo = $("#cod_articulo").val();
     var cantidad = $("#cantidad").val();
     var comentario = $("#comentario").val();
     $.post('json_AjusteAlmacen.php',{ cod_articulo:cod_articulo, cantidad:cantidad, comentario:comentario },function(res){
            if(res[0].resultado == 1 && res[0].msj == "ok"){
                alert("Se actualizó correctamente.");
            }else if(res[0].resultado == 2 && res[0].msj == "ok"){
                alert("Se asignó correctamente.");
            }else if(res[0].resultado == 2 && res[0].msj == "ok"){
                alert("Se asignó correctamente.");
            }else if(res[0].resultado == 2 && res[0].msj == "fail"){
                alert("Ocurrió un error al ejecutar el procesamiento.");
            }else if(res[0].resultado == 2 && res[0].msj == "no_exist"){
                alert("No se encontró una factura relacionada a este Codigo. Debe crear una nueva factura para la alta del articulo en: Almacen > Facturas > Nueva Factura");
            }
            
     }).done(function() {
         
     });
 }