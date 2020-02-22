<?php  
require_once "../../conexion/conect.php"; 

class suministro extends conect 
{     
    public function __construct() 
    {
        parent::__construct();
    }
    public function get_almacen_categoria(){
        $sql = $this->_db->prepare('SELECT adm_articulo.id_articulo,adm_articulo.descripcion,adm_categoria_consumibles.categoria,adm_articulo.marca,adm_almacen.cod_articulo,adm_almacen.stock_min,adm_almacen.stock_max,adm_almacen.stock
        FROM adm_articulo
	INNER JOIN adm_almacen ON adm_articulo.id_articulo = adm_almacen.id_articulo
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
        $sql = $this->_db->prepare("SELECT * FROM adm_view_list_articulo
                                    WHERE adm_view_list_articulo.descripcion LIKE '%$searchTerm%' OR adm_view_list_articulo.cod_articulo LIKE '$searchTerm%'");//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_last_codarticulo($searchTerm){
        $sql = $this->_db->prepare("SELECT cod_articulo FROM adm_almacen WHERE cod_articulo LIKE '$searchTerm%' ORDER BY cod_articulo DESC LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_categoria_resume_name($searchTerm){
        $sql = $this->_db->prepare("SELECT resume_name FROM adm_categoria_consumibles WHERE id_categoria = ".$searchTerm." LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_5(){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_list_articulo
                                    LIMIT 0");//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_1($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_list_articulo
                                    WHERE adm_view_list_articulo.cod_articulo = :codigo");
        $sql->execute(array('codigo' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_rfc($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_proveedor WHERE adm_proveedor.rfc = :rfc");
        $sql->execute(array('rfc' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_codigosearch($searchTerm){
        $sql = $this->_db->prepare("SELECT cod_barra, cod_articulo, descripcion FROM adm_view_almacen_detail WHERE cod_barra = :codigo OR cod_articulo = :codigo");
        $sql->execute(array('codigo' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM ope_equipo_area
                                    WHERE ope_equipo_area.nombre_generico");//nombre = :Nombre'
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino_5(){
        $sql = $this->_db->prepare("SELECT * FROM ope_equipo_area LIMIT 0");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino_1($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_responsablearea WHERE adm_responsablearea.id_responsableArea = :clave");
        $sql->execute(array('clave' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_now(){
        $sql = $this->_db->prepare("SELECT NOW() AS fecha_actual");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function noread_inbox(){
        $sql = $this->_db->prepare("SELECT count(*) as total FROM adm_almacen_valesalida WHERE status_vale = 0 LIMIT 100");
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
    public function get_destinoSuministro(){
        $sql = $this->_db->prepare("SELECT * FROM ope_equipo_area");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_sub_destinoSuministro($id_equipo){
        $sql = $this->_db->prepare("SELECT * FROM ope_sub_area_equipo WHERE id_equipo_area = $id_equipo");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_solicitud($fecha_solicitud,$clave_solicita,$nombre_solicita,$puesto_solicita,$sitio_operacion,$id_equipo){
        $sql1 = $this->_db->prepare("INSERT INTO adm_solicitud_material (fecha,clave_solicita,nombre_solicitante,puesto_solicitante,sitio_operacion,id_equipo) VALUES ('$fecha_solicitud',$clave_solicita,'$nombre_solicita','$puesto_solicita','$sitio_operacion',$id_equipo)");
        $sql2 = $this->_db->prepare("SELECT folio FROM adm_solicitud_material WHERE fecha = '$fecha_solicitud' AND clave_solicita = $clave_solicita LIMIT 1");
        $sql1->execute();
        $sql2->execute();
        $resultado = $sql2->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_pedido($articulo, $cantidad, $unidad, $justificacion, $destino, $fecha_requerimiento, $cod_articulo, $folio){
        if($cod_articulo == ""){
            $sql = $this->_db->prepare("INSERT INTO adm_pedido (articulo, cantidad, cantidad_coord, unidad, justificacion, destino, fecha_requerimiento, cod_articulo, folio)
                                        VALUES ('$articulo', $cantidad, $cantidad, '$unidad', '$justificacion', '$destino', '$fecha_requerimiento', NULL, $folio)");
        }else{
            $sql = $this->_db->prepare("INSERT INTO adm_pedido (articulo, cantidad, cantidad_coord, unidad, justificacion, destino, fecha_requerimiento, cod_articulo, folio)
                                        VALUES ('$articulo', $cantidad, $cantidad,'$unidad', '$justificacion', '$destino','$fecha_requerimiento', '$cod_articulo', $folio)");
        }
        $resultado = $sql->execute();
        return $resultado;
    }
    //==========================================================================
    public function get_solicitudes($filtro=""){
        $sql = $this->_db->prepare("SELECT adm_solicitud_material.folio, adm_solicitud_material.fecha_solicitud, adm_solicitud_material.clave_solicita,adm_persona.nombre,adm_persona.apellidos,adm_solicitud_material.leido
                                    FROM adm_solicitud_material
                                    INNER JOIN adm_empleado ON adm_solicitud_material.clave_solicita = adm_empleado.id_empleado
                                    INNER JOIN adm_persona ON adm_empleado.id_persona = adm_persona.id_persona
                                    WHERE status_solicitud = 0 $filtro ORDER BY adm_solicitud_material.folio DESC");
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
    //=====================   COMPRA   =========================================
    public function get_solicitud_pendiente_surtido($filtro = ""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_pedido_detail WHERE status_pedido = 4 " . $filtro);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function set_update_compra_aprobado($id_compra_lista, $cantidad_compra, $cantidad_cancelado, $visto_bueno){//Aprobados = 1:Todos, 2:Parcial, 3:Ninguno;
        if($cantidad_cancelado > 0 ){
            $sql = $this->_db->prepare("UPDATE adm_almacen_compra_lista  SET cantidad_aprobada = $cantidad_compra, cantidad_cancelado = $cantidad_cancelado, aprobado = 3, fecha_revision = NOW(), visto_bueno = $visto_bueno WHERE id_compra_lista = $id_compra_lista LIMIT 1");
            return $sql->execute();
        }else{
            $sql = $this->_db->prepare("UPDATE adm_almacen_compra_lista  SET cantidad_aprobada = $cantidad_compra, aprobado = 1, fecha_revision = NOW(), visto_bueno = $visto_bueno WHERE id_compra_lista = $id_compra_lista LIMIT 1");
            return $sql->execute(); 
        }
    }
    function set_update_compra_no_aprovado($id_compra_lista,$visto_bueno){
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_compra_lista  SET cantidad_cancelada = cantidad_comprar, aprobado = 2, fecha_revision = NOW(), visto_bueno = $visto_bueno WHERE id_compra_lista = $id_compra_lista LIMIT 1");
        return $sql2->execute();
    }
    //==========================================================================
    
    public function get_pedidosTR($folio){
        $sql = $this->_db->prepare("SELECT cantidad,status_pedido,comentario FROM adm_pedido WHERE folio = $folio");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_pedidos_count($folio,$filtro = ""){
        $sql = $this->_db->prepare("SELECT count(*) as c FROM adm_pedido WHERE folio = $folio $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_solicitudesTR(){
        $sql = $this->_db->prepare("SELECT adm_solicitud_material.folio,adm_solicitud_material.leido
                                    FROM adm_solicitud_material
                                    WHERE status_solicitud = 0 order by adm_solicitud_material.folio desc");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function detalle_folio_salida_imprimir($folio_vale){//adm_view_para_firma_vobo
        $sql = $this->_db->prepare("SELECT * FROM adm_view_para_firma_vobo
                                    WHERE adm_view_para_firma_vobo.folio_vale = $folio_vale AND adm_view_para_firma_vobo.aprobado IN ( 1 , 3)");
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
    public function get_almacen($filtro = "",$limit = ""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_almacen_detail $filtro order by id_categoria asc $limit");
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
    //================================================================================
    function set_update_salida($folio_vale, $id_pedido,$cod_articulo, $cantidad_surtir,$update_almacen){
        //ya tiene Vo.Bo.?
        if($update_almacen == "si"){
            $sql = $this->_db->prepare("INSERT INTO adm_almacen_valesalida_detail (cantidad_surtida, cantidad_aprobada, aprobado, folio_vale, id_pedido, fecha) VALUES ('$cantidad_surtir', '$cantidad_surtir',1, $folio_vale, $id_pedido, NOW())");
        }elseif($update_almacen == "no"){
            $sql = $this->_db->prepare("INSERT INTO adm_almacen_valesalida_detail (cantidad_surtida, folio_vale, id_pedido, fecha) VALUES ('$cantidad_surtir', $folio_vale, $id_pedido, NOW())");
        }
        if($sql->execute()){
            $sql2 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.cantidad_apartado = (adm_pedido.cantidad_apartado - $cantidad_surtir) WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
            $resultadox = $sql2->execute();
        }else{
            $sqlx = $this->_db->prepare("DELETE FROM adm_almacen_valesalida WHERE adm_almacen_valesalida.folio_vale = $folio_vale  LIMIT 1");
            $resultadox = 'resultado: 0 back: x='.$sqlx->execute();
        }
        return $resultadox;
    }
    function set_update_salida_aprobado($id_pedido,$cod_articulo, $cantidad_surtir,$cantidad_cancelado,$id_valesalida_pedido){//Aprobados = 1:Todos, 2:Parcial, 3:Ninguno;
        if($cantidad_cancelado > 0 ){
            $sql = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail  SET cantidad_aprobada = $cantidad_surtir, cantidad_cancelado = $cantidad_cancelado, aprobado = 3 WHERE id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
            return $sql->execute();
        }else{
            $sql = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail  SET cantidad_aprobada = $cantidad_surtir, aprobado = 1 WHERE id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
            return $sql->execute(); 
        }
    }
    function set_update_salida_no_aprovado($id_pedido, $id_valesalida_pedido,$total){
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail  SET cantidad_cancelado = cantidad_surtida, aprobado = 2 WHERE id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
        return $sql2->execute();
    }
    //================================================================================
    function set_update_enviado_pendiente_surtir($id_pedido){
        $sql2 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.status_pedido = 4 WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $resultadox = $sql2->execute();
        return $resultadox;
    }
    //================================================================================
    function set_update_salida_compra($id_pedido, $cantidad_comprar,$update_almacen, $visto_bueno, $encargado_almacen){
        //ya tiene Vo.Bo.?
        if($update_almacen == "si"){
            $sql = $this->_db->prepare("INSERT INTO adm_almacen_compra_lista (cantidad_comprar, cantidad_aprobada, aprobado, id_pedido, fecha_inicial, fecha_revision,visto_bueno,encargado_almacen) VALUES ('$cantidad_comprar', '$cantidad_comprar',1, $id_pedido, NOW(), NOW(), $visto_bueno, $encargado_almacen)");
        }elseif($update_almacen == "no"){
            $sql = $this->_db->prepare("INSERT INTO adm_almacen_compra_lista (cantidad_comprar, id_pedido, fecha_inicial,encargado_almacen) VALUES ('$cantidad_comprar', $id_pedido, NOW(),$encargado_almacen)");
        }
        if($sql->execute()){
            $sql2 = $this->_db->prepare("UPDATE adm_pedido SET adm_pedido.cantidad_compra = 0 WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
            $resultadox = $sql2->execute();
        }else{
            $resultadox = false;
        }
        return $resultadox;
    }
    function set_update_salida_aprobado_compra($cantidad_comprar,$cantidad_cancelado,$id_compra_lista){//Aprobados = 1:Todos, 2:Ninguno, 3:Parcial;
        if($cantidad_cancelado > 0 ){
            $sql = $this->_db->prepare("UPDATE adm_almacen_compra_lista  SET cantidad_aprobada = $cantidad_comprar, cantidad_cancelado = $cantidad_cancelado, aprobado = 3, fecha_revision = NOW() WHERE id_compra_lista = $id_compra_lista LIMIT 1");
            return $sql->execute();
        }else{
            $sql = $this->_db->prepare("UPDATE adm_almacen_compra_lista  SET cantidad_aprobada = $cantidad_comprar, aprobado = 1, fecha_revision = NOW() WHERE id_compra_lista = $id_compra_lista LIMIT 1");
            return $sql->execute(); 
        }
    }
    function set_update_salida_no_aprovado_compra($id_compra_lista){
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_compra_lista  SET cantidad_cancelado = cantidad_comprar, aprobado = 2, fecha_revision = NOW() WHERE id_compra_lista = $id_compra_lista LIMIT 1");
        return $sql2->execute();
    }
    //================================================================================
    function set_update_firma_vobo($folio_vale, $visto_bueno){
        $sql1 = $this->_db->prepare("UPDATE adm_almacen_valesalida SET visto_bueno = $visto_bueno, fecha_firma_vobo = NOW(), status_vale = 1 WHERE adm_almacen_valesalida.folio_vale = $folio_vale LIMIT 1");
        $resultado1 = $sql1->execute();
        return $resultado1;
    }
    function set_update_recibe_solicitud($id_valesalida_pedido, $recibe,$cantidad_surtir,$cantidad_cancelado,$cod_articulo,$id_pedido){
        $sql1 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail SET recibe = '$recibe',cantidad_entregado='$cantidad_surtir', fecha = NOW() WHERE adm_almacen_valesalida_detail.id_valesalida_pedido = $id_valesalida_pedido LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_pedido SET cantidad_entregado = (cantidad_entregado + $cantidad_surtir), cantidad_cancelado = (cantidad_cancelado + $cantidad_cancelado), cantidad_surtir = 0 WHERE adm_pedido.id_pedido = $id_pedido LIMIT 1");
        $sql3 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock - $cantidad_surtir) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        
        if($sql1->execute()){
            if($sql2->execute()){
                if($sql3->execute()){
                    return "exito";
                }else{
                    return "fail_UPDATE_adm_almacen";
                }
        }else{
            return "fail_UPDATE_adm_pedido";
            }
        }else{
            return "fail_UPDATE_adm_almacen_valesalida_detail";
        }
    }
    function set_update_recibe_solicitud_todo($folio_vale, $recibe_vale){
        $sql1 = $this->_db->prepare("UPDATE adm_almacen_valesalida SET recibe_vale = '$recibe_vale', fecha_salida = NOW(),status_vale = 2 WHERE adm_almacen_valesalida.folio_vale = $folio_vale LIMIT 1");
        $resultado1 = $sql1->execute();
        return $resultado1;
    }
    function set_update_reset_solicitud($folio_vale){
        $sql1 = $this->_db->prepare("UPDATE adm_almacen_valesalida SET fecha_firma_vobo = '0000-00-00 00:00:00', visto_bueno = '', status_vale = 0 WHERE adm_almacen_valesalida.folio_vale = $folio_vale LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail SET cantidad_aprobada = 0, cantidad_cancelado = 0, aprobado = 0 WHERE folio_vale = ".$folio_vale);
        if($sql2->execute()){
            return $sql1->execute();
        }else{
            return false;
        }
    }
    function set_update_satate_valesalida($folio_vale){
        $sql1 = $this->_db->prepare("UPDATE adm_almacen_valesalida SET status_vale = 2 WHERE adm_almacen_valesalida.folio_vale = $folio_vale LIMIT 1");
        $resultado1 = $sql1->execute();
        return $resultado1;
    }
    function set_select_cout_inventario($no_inventario){
        $sql = $this->_db->prepare("SELECT COUNT(*) AS count FROM adm_almacen WHERE no_inventario = '$no_inventario' LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado[0]["count"];
    }
    //===========MODIFICACIÓN DE INVENTARIO=================================================================================================================================
    function set_insert_new_articulo($cod_articulo,$cod_articulo_new,$no_inventario,$no_serie,$costo){
        $sql2 = $this->_db->prepare("INSERT INTO adm_almacen (id_articulo,no_inventario, no_serie, stock, stock_min, stock_max, importancia, ubicacion, salida,costo, activo, cod_articulo)
                                     SELECT id_articulo, '$no_inventario' AS no_inventario, '$no_serie' AS no_serie, '0' AS stock, '0' AS stock_min, '0' AS stock_max, importancia, ubicacion, salida,'$costo' AS costo, '1' AS activo, '$cod_articulo_new' AS cod_articulo FROM adm_almacen WHERE cod_articulo = '$cod_articulo'");
        $sql3 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock - 1) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        $resultado2 = $sql2->execute();
        $resultado3 = $sql3->execute();
        return $resultado2*$resultado3;
    }
    function set_update_new_articulo($cod_articulo_new,$no_inventario,$no_serie,$costo){
        $sql3 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.no_inventario = '$no_inventario', adm_almacen.no_serie = '$no_serie',adm_almacen.costo = '$costo' WHERE adm_almacen.cod_articulo = '$cod_articulo_new' LIMIT 1");
        $resultado3 = $sql3->execute();
        return $resultado3;
    }
    function set_delete_new_articulo($cod_articulo, $cod_articulo_new){
        $sql2 = $this->_db->prepare("DELETE FROM adm_almacen WHERE adm_almacen.cod_articulo = '$cod_articulo_new' LIMIT 1");
        $sql3 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock + 1) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        
        $resultado2 = $sql2->execute();
        $resultado3 = 0;
        
        if(($resultado2) == 1){
            $resultado3 = $sql3->execute();
        }
        
        return $resultado3;
    }
    //======================================================================================================================================================================
    public function autentificar_firma($usuario, $password, $tokenid){
        $sql = $this->_db->prepare("SELECT id_empleado FROM adm_login WHERE adm_login.usuario = '$usuario' AND adm_login.pass = '$password' AND adm_login.estado = 1 LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultado) > 0){
            $id_empleado = $resultado[0]["id_empleado"];
            $sql2 = $this->_db->prepare("SELECT * FROM adm_view_autentificar WHERE id_empleado = '$id_empleado' AND status = 1 AND id_coordinacion = '$tokenid' LIMIT 1");
            $sql2->execute();
            $resultado2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
            if(count($resultado2) > 0){
                $sql3 = $this->_db->prepare("UPDATE adm_solicitud_material  SET firm_coordinacion = $id_empleado WHERE id_pedido = $id_pedido LIMIT 1");
                return $sql3->execute();
            }else{
                return "acount_denied";
            }
        }else{
            return "error_acount";
        }
    }
    public function set_new_articulo($cod_barra, $descripcion,$especificacion,$tipo_unidad,$marca,$id_categoria){
        $articulo = $this->_db->prepare("INSERT INTO adm_articulo (cod_barra,descripcion,especificacion,tipo_unidad,marca,id_categoria) VALUES ('$cod_barra', '$descripcion','$especificacion','$tipo_unidad','$marca',$id_categoria)");
        
        try {
            $this ->_db-> beginTransaction();
            $articulo -> execute();
            $id_articulo = $this ->_db-> lastInsertId();
            $this ->_db-> commit();
            return $id_articulo;
        } catch(PDOExecption $e) {
            $this ->_db-> rollback();
            return "Error!: " . $e -> getMessage();
        }
    }
    public function set_new_articulo_almacen($cod_articulo,$id_articulo){
        $almacen = $this->_db->prepare("INSERT INTO adm_almacen (cod_articulo,no_inventario,no_serie,stock,stock_min,stock_max,importancia,ubicacion,salida,activo,costo,id_articulo) VALUES ('$cod_articulo','','',0,1,1,3,NULL,0,0,NULL,$id_articulo)");
        $resultado = $almacen->execute();
        return $resultado;
    }
    //===========================NUEVAS CONSULTAS===============================
    public function get_solicitudes_($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_solicitud $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function set_update_cantidad_solicitudDetalle($id_pedido,$cantidad,$columna){
        $sql2 = $this->_db->prepare("UPDATE adm_pedido  SET $columna = $cantidad WHERE id_pedido = $id_pedido LIMIT 1");
        return $sql2->execute();
    }
    public function get_comentarioPedido($id_pedido){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_comentario_pedido WHERE id_pedido = $id_pedido");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
