<?php  
require_once "../../conexion/conect.php"; 

class suministro extends conect 
{     
    public function __construct() 
    {
        parent::__construct(); 
    }
    public function get_almacen_categoria(){
        $sql = $this->_db->prepare('SELECT adm_articulo.cod_articulo,adm_articulo.descripcion,adm_categoria_consumibles.categoria,adm_articulo.marca,adm_almacen.stock_min,adm_almacen.stock_max,adm_almacen.stock
                                    FROM adm_articulo
                                    INNER JOIN adm_almacen ON adm_articulo.cod_articulo = adm_almacen.cod_articulo
                                    INNER JOIN adm_categoria_consumibles ON adm_articulo.id_categoria = adm_categoria_consumibles.id_categoria');//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_form_sol_mat($numformat){
        $sql = $this->_db->prepare("SELECT * FROM adm_formato WHERE num_formato = '$numformat' ORDER BY num_revision DESC LIMIT 1");//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_stock_disponible
                                    WHERE adm_view_stock_disponible.descripcion LIKE '%$searchTerm%'");//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_5(){
        $sql = $this->_db->prepare("SELECT adm_articulo.cod_articulo,adm_articulo.descripcion,adm_articulo.marca,adm_almacen.stock
                                    FROM adm_articulo
                                    INNER JOIN adm_almacen ON adm_articulo.cod_articulo = adm_almacen.cod_articulo
                                    INNER JOIN adm_categoria_consumibles ON adm_articulo.id_categoria = adm_categoria_consumibles.id_categoria
                                    LIMIT 0");//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_1($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_stock_disponible
                                    WHERE adm_view_stock_disponible.cod_articulo = :codigo or adm_view_stock_disponible.cod_barra = :codigo");
        $sql->execute(array('codigo' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_destino
                                    WHERE adm_view_destino.destino LIKE '%$searchTerm%'");//nombre = :Nombre'
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino_5(){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_destino LIMIT 0");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino_1($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_destino WHERE adm_view_destino.key_wh = :key_wh");
        $sql->execute(array('key_wh' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_now(){
        $sql = $this->_db->prepare("SELECT NOW() AS fecha_actual");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_categoria_articulo(){
        $sql = $this->_db->prepare("SELECT adm_categoria_consumibles.id_categoria,adm_categoria_consumibles.categoria,adm_categoria_consumibles.id_empleado_resp, adm_persona.nombre,adm_persona.apellidos
                                    FROM adm_categoria_consumibles
                                    INNER JOIN adm_empleado ON adm_categoria_consumibles.id_empleado_resp = adm_empleado.id_empleado
                                    INNER JOIN adm_persona ON adm_empleado.id_persona = adm_persona.id_persona");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_solicitud($fecha_solicitud,$status_solicitud,$id_formato,$clave_solicita){
        $sql1 = $this->_db->prepare("INSERT INTO adm_solicitud_material (fecha_solicitud,status_solicitud,id_formato,clave_solicita) VALUES ('$fecha_solicitud',$status_solicitud,$id_formato,$clave_solicita)");
        $sql2 = $this->_db->prepare("SELECT folio FROM adm_solicitud_material WHERE fecha_solicitud = '$fecha_solicitud' AND clave_solicita = $clave_solicita LIMIT 1");
        $sql1->execute();
        $sql2->execute();
        $resultado = $sql2->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_pedido($autorizado, $articulo, $cantidad, $unidad, $detalle_articulo, $justificacion, $anexo_codicion, $destino, $status_pedido, $comentario, $grado_requerimiento, $fecha_requerimiento, $cod_articulo, $id_categoria, $folio,$cantidad_aparta,$cantidad_compra){
        $date = new DateTime($fecha_requerimiento);
        $fn = $date->format('Y-m-d');
        $sql = $this->_db->prepare("INSERT INTO adm_pedido (autoriza, articulo, cantidad, unidad, detalle_articulo, justificacion, anexo_codicion, destino, status_pedido, comentario, grado_requerimiento, fecha_requerimiento, cod_articulo, id_categoria, folio, aprobacion, cantidad_apartado, cantidad_compra)
                                    VALUES ('$autorizado', '$articulo', $cantidad, '$unidad', '$detalle_articulo', '$justificacion', '$anexo_codicion', '$destino', $status_pedido, '$comentario', '$grado_requerimiento', '$fn', '$cod_articulo', $id_categoria, $folio,$status_pedido,$cantidad_aparta,$cantidad_compra)");
        $resultado = $sql->execute();
        return $resultado;
    }
    //==========================================================================
    public function get_solicitudes(){
        $sql = $this->_db->prepare("SELECT adm_solicitud_material.folio, adm_solicitud_material.fecha_solicitud, adm_solicitud_material.clave_solicita,adm_persona.nombre,adm_persona.apellidos
                                    FROM adm_solicitud_material
                                    INNER JOIN adm_empleado ON adm_solicitud_material.clave_solicita = adm_empleado.id_empleado
                                    INNER JOIN adm_persona ON adm_empleado.id_persona = adm_persona.id_persona
                                    WHERE status_solicitud = 0 ORDER BY adm_solicitud_material.folio DESC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_pedidos($folio,$filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_pedido_detail WHERE folio = $folio $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    //==========================================================================
    public function get_solicitud_aprobacion($filtro = ""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_salida_almacen_all $filtro ORDER BY adm_view_salida_almacen_all.folio_vale DESC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_solicitud_aprobacion_detalle($folio){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_salida_almacen_all WHERE adm_view_salida_almacen_all.folio_vale = $folio ORDER BY adm_view_salida_almacen_all.folio_vale ASC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_solicitud_aprobacion_detail(){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_vale_salida_aprobado_detail");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_pedidos_salida($folio,$filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_para_firma_vobo WHERE folio_vale = $folio $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    //==========================================================================
    public function get_pedidosTR($folio){
        $sql = $this->_db->prepare("SELECT cantidad,status_pedido,comentario FROM adm_pedido WHERE folio = $folio");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_pedidos_count($folio){
        $sql = $this->_db->prepare("SELECT count(*) as c FROM adm_pedido WHERE folio = $folio");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_solicitudesTR(){
        $sql = $this->_db->prepare("SELECT adm_solicitud_material.folio
                                    FROM adm_solicitud_material
                                    WHERE status_solicitud = 0 order by adm_solicitud_material.folio desc");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_partida($id_pedido){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_pedido_detail
                                    WHERE adm_view_pedido_detail.id_pedido = $id_pedido LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_partida_detail2($folio){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_pedido_detail
                                    WHERE adm_view_pedido_detail.folio = $folio order by adm_view_pedido_detail.id_pedido desc");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_partida_detail($folio_vale){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_para_firma_vobo
                                    WHERE adm_view_para_firma_vobo.folio_vale = $folio_vale ORDER BY adm_view_para_firma_vobo.folio_vale ASC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function detalle_folio_salida($folio_vale){//adm_view_para_firma_vobo
        $sql = $this->_db->prepare("SELECT * FROM adm_view_para_firma_vobo
                                    WHERE adm_view_para_firma_vobo.folio_vale = $folio_vale");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function detalle_folio_salida_imprimir($folio_vale){//adm_view_para_firma_vobo
        $sql = $this->_db->prepare("SELECT * FROM adm_view_para_firma_vobo
                                    WHERE adm_view_para_firma_vobo.folio_vale = $folio_vale AND adm_view_para_firma_vobo.aprobado = 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_update_pedido($id_pedido,$status_pedido){
        $aprobado = "";
        if ($status_pedido ==  0 || $status_pedido ==  1 || $status_pedido ==  2 || $status_pedido ==  3){
            $aprobado = "adm_pedido.aprobacion = '$status_pedido', adm_pedido.status_pedido = '$status_pedido'";
        }else{
            $aprobado = "adm_pedido.status_pedido = '$status_pedido'";
        }
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET $aprobado WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $resultado = $sql1->execute();
        return $resultado;
    }
    public function set_update_cantidad($id_pedido,$cantidad,$cantidad_apartado,$cantidad_compra){
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.cantidad = '$cantidad', adm_pedido.cantidad_apartado = '$cantidad_apartado', adm_pedido.cantidad_compra = '$cantidad_compra' WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $resultado = $sql1->execute();
        return $resultado;
    }
    public function out_update_almacen($cantidad,$cod_articulo){
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.cantidad = '$cantidad', adm_pedido.cantidad_apartado = '$cantidad_apartado', adm_pedido.cantidad_compra = '$cantidad_compra' WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $resultado = $sql1->execute();
        return $resultado;
    }
    public function set_accion_status($id_pedido,$key_status,$id_empleado){
        $sql2 = $this->_db->prepare("INSERT INTO accion_status (id_pedido,key_status,id_empleado) VALUES ($id_pedido,$key_status,$id_empleado)");
        $sql2->execute();
        $resultado = $sql2->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_status_pedido_man($id_pedido){
        $sql = $this->_db->prepare("SELECT adm_pedido.aprobacion FROM adm_pedido WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_pedido_comentario($id_pedido){
        $sql = $this->_db->prepare("SELECT CONCAT(adm_persona.nombre,' ',adm_persona.apellidos) as nombre
                                    FROM adm_pedido
                                    INNER JOIN adm_empleado ON adm_pedido.autoriza = adm_empleado.id_empleado
                                    INNER JOIN adm_persona ON adm_empleado.id_persona = adm_persona.id_persona
                                    WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_comentario($id_pedido,$comentario){
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.comentario = '$comentario' WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql2 = $this->_db->prepare("SELECT adm_pedido.comentario FROM adm_pedido WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql1->execute();
        $sql2->execute();
        $resultado = $sql2->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_responsable_categoria($id_categoria){
        $sql = $this->_db->prepare("SELECT id_empleado_resp from adm_categoria_consumibles WHERE adm_categoria_consumibles.id_categoria = $id_categoria LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado[0]["id_empleado_resp"];
    }
    public function get_almacen_salida($filtro = ""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_almacen_salida $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_vale_salida($folio_vale, $encargado_almacen, $visto_bueno, $observacion){
        if($visto_bueno == ""){
            $sql = $this->_db->prepare("INSERT INTO adm_almacen_valesalida (folio_vale,encargado_almacen,fecha_firma_encargado, observacion)
                                    VALUES ('$folio_vale','$encargado_almacen',NOW(),'$observacion')");
            $resultado = $sql->execute();
            return $resultado;
        }else{
            $sql = $this->_db->prepare("INSERT INTO adm_almacen_valesalida (folio_vale,encargado_almacen,fecha_firma_encargado, visto_bueno, fecha_firma_vobo, observacion,status_vale)
                                    VALUES ('$folio_vale','$encargado_almacen',NOW(),'$visto_bueno',NOW(),'$observacion',1)");
            $resultado = $sql->execute();
            return $resultado;
        }
    }
    public function set_update_salida($folio_vale, $id_pedido,$cod_articulo, $cantidad_surtir,$update_almacen){
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.cantidad_apartado = (adm_pedido.cantidad_apartado - $cantidad_surtir), adm_pedido.cantidad_entregado = (adm_pedido.cantidad_entregado + $cantidad_surtir), cantidad_surtir = 0 WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock - $cantidad_surtir) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        
        $sql3 = $this->_db->prepare("UPDATE adm_pedido  SET cantidad_surtir = '$cantidad_surtir' WHERE id_pedido = '$id_pedido'");
        $sql4 = $this->_db->prepare("INSERT INTO adm_almacen_valesalida_detail (cantidad_surtida, folio_vale, id_pedido, fecha) VALUES ('$cantidad_surtir', $folio_vale, $id_pedido, NOW())");
        $sql5 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail SET aprobado = 1 WHERE folio_vale = $folio_vale");
        
        if($update_almacen == "si"){
            $resultado1 = $sql1->execute();
            $resultado2 = $sql2->execute();
            $resultado4 = $sql4->execute();
            $resultado5 = $sql5->execute();
            $request = $resultado1*$resultado2*$resultado4*$resultado5;
        }elseif($update_almacen == "no"){
            $resultado3 = $sql3->execute();
            $resultado4 = $sql4->execute();
            $request    = $resultado3*$resultado4;
        }
        
        return $request;
    }
    function set_update_salida_aprobado($id_pedido,$cod_articulo, $cantidad_surtir,$cantidad_cancelado,$id_valesalida_pedido){
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.cantidad_apartado = (adm_pedido.cantidad_apartado - $cantidad_surtir), adm_pedido.cantidad_entregado = (adm_pedido.cantidad_entregado + $cantidad_surtir), cantidad_surtir = 0 WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock - $cantidad_surtir) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        if($cantidad_cancelado > 0){
            $sql3 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail  SET cantidad_surtida = $cantidad_surtir, cantidad_cancelado = $cantidad_cancelado, aprobado = 3 WHERE id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
        }else{
            $sql3 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail  SET aprobado = 1 WHERE id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
        }
        $resultado1 = $sql1->execute();
        $resultado2 = $sql2->execute();
        $resultado3 = $sql3->execute();
        $request = $resultado1*$resultado2*$resultado3;
        return $request;
    }
    function set_update_salida_no_aprovado($id_pedido, $id_valesalida_pedido){
        $sql1 = $this->_db->prepare("UPDATE adm_pedido SET cantidad_surtir = 0 WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail  SET cantidad_cancelado = cantidad_surtida, cantidad_surtida = 0, aprobado = 2 WHERE id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
        
        $resultado1 = $sql1->execute();
        $resultado2 = $sql2->execute();
        $request = $resultado1*$resultado2;
        return $request;
    }
    function set_update_firma_vobo($folio_vale, $visto_bueno){
        $sql1 = $this->_db->prepare("UPDATE adm_almacen_valesalida SET visto_bueno = $visto_bueno, fecha_firma_vobo = NOW(), status_vale = 1 WHERE adm_almacen_valesalida.folio_vale = $folio_vale LIMIT 1");
        $resultado1 = $sql1->execute();
        return $resultado1;
    }
    public function aut_encargado_almacen($usuario, $password, $tokenid){
        $sql = $this->_db->prepare("SELECT id_empleado FROM adm_login WHERE adm_login.usuario = '$usuario' AND adm_login.pass = '$password' AND adm_login.estado = 1 LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultado) > 0){
            $id_empleado = $resultado[0]["id_empleado"];
            $sql2 = $this->_db->prepare("SELECT id_empleado, nombre, apellidos, cargo, email, result FROM adm_view_autentificar WHERE id_empleado = '$id_empleado' AND status = 1 AND clase = '$tokenid' LIMIT 1");
            $sql2->execute();
            $resultado2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
            if(count($resultado2) > 0){
                return $resultado2;
            }else{
                return "acount_denied";
            }
        }else{
            return "error_acount";
        }
    }
}
