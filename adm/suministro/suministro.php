<?php  
require_once "../../conexion/conect.php"; 

class suministro extends conect 
{     
    public function __construct() 
    {
        parent::__construct();
    }
    public function get_almacen_categoria(){
        $sql = $this->_db->prepare('SELECT id_articulo, descripcion, nombre_categoria as categoria, marca, cod_articulo, stock_min, stock_max, stock FROM adm_view_almacen_detail ORDER BY cod_articulo');//nombre = :Nombre'
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
    public function get_categoria_resume_name_2($searchTerm){
        $sql = $this->_db->prepare("SELECT id_categoria FROM adm_categoria_consumibles WHERE resume_name = '$searchTerm' LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado[0]['id_categoria'];
    }
    public function get_almacen_busqueda_5(){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_list_articulo LIMIT 0");//nombre = :Nombre'
        $sql->execute();//$sql->execute(array('Nombre' => $nombre)); pasar parametros
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_busqueda_1($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_list_articulo WHERE adm_view_list_articulo.cod_articulo = :codigo");
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
        $sql = $this->_db->prepare("SELECT cod_barra, cod_articulo, descripcion, tipo_unidad,config, salida_rapida FROM adm_view_almacen_detail WHERE cod_barra = :codigo OR cod_articulo = :codigo");
        $sql->execute(array('codigo' => $searchTerm));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_almacen_destino($searchTerm){
        $sql = $this->_db->prepare("SELECT * FROM ope_equipo_area WHERE ope_equipo_area.nombre_generico");//nombre = :Nombre'
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
    public function get_categoria_articulo($tipo = 1){
        $sql = $this->_db->prepare("SELECT id_categoria,categoria,resume_name FROM adm_categoria_consumibles WHERE tipo = $tipo");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_destinoSuministro($filter = ""){
        $sql = $this->_db->prepare("SELECT * FROM ope_equipo_area $filter");
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
    public function set_solicitud_rapido($fecha_solicitud,$clave_solicita,$nombre_solicita,$puesto_solicita,$sitio_operacion,$id_equipo,$id_solicita){
        $sql1 = $this->_db->prepare("INSERT INTO adm_solicitud_material (fecha,clave_solicita,nombre_solicitante,puesto_solicitante,sitio_operacion,id_equipo,solicitud_rapida,id_solicita) VALUES ('$fecha_solicitud',$clave_solicita,'$nombre_solicita','$puesto_solicita','$sitio_operacion',$id_equipo,1,'$id_solicita')");
        $sql2 = $this->_db->prepare("SELECT folio FROM adm_solicitud_material WHERE fecha = '$fecha_solicitud' AND clave_solicita = $clave_solicita LIMIT 1");
        $sql3 = $this->_db->prepare("SELECT folio FROM adm_solicitud_material WHERE fecha = '$fecha_solicitud' AND clave_solicita = $clave_solicita LIMIT 1");
        $sql1->execute();
        $sql2->execute();
        $resultado = $sql2->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_solicitud_epp($fecha_solicitud,$clave_solicita,$nombre_solicita,$puesto_solicita,$sitio_operacion,$id_equipo,$id_solicita){
        $sql1 = $this->_db->prepare("INSERT INTO adm_solicitud_material (fecha,clave_solicita,nombre_solicitante,puesto_solicitante,sitio_operacion,id_equipo,solicitud_rapida,id_solicita) VALUES ('$fecha_solicitud',$clave_solicita,'$nombre_solicita','$puesto_solicita','$sitio_operacion',$id_equipo,0,'$id_solicita')");
        $sql2 = $this->_db->prepare("SELECT folio FROM adm_solicitud_material WHERE fecha = '$fecha_solicitud' AND clave_solicita = $clave_solicita LIMIT 1");
        $sql3 = $this->_db->prepare("SELECT folio FROM adm_solicitud_material WHERE fecha = '$fecha_solicitud' AND clave_solicita = $clave_solicita LIMIT 1");
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
    public function set_pedido_rapido($articulo, $cantidad, $unidad, $justificacion, $destino, $cod_articulo, $folio){
        if($cod_articulo == ""){
            $sql = $this->_db->prepare("INSERT INTO adm_pedido (articulo, cantidad, cantidad_coord, cantidad_plan, cantidad_surtido, unidad, justificacion, destino, fecha_requerimiento, cod_articulo, folio, status_pedido)
                                        VALUES ('$articulo', $cantidad, $cantidad, $cantidad, $cantidad,'$unidad', '$justificacion', '$destino', NOW(), NULL, $folio, 1)");
        }else{
            $sql = $this->_db->prepare("INSERT INTO adm_pedido (articulo, cantidad, cantidad_coord, cantidad_plan, cantidad_surtido, unidad, justificacion, destino, fecha_requerimiento, cod_articulo, folio, status_pedido)
                                        VALUES ('$articulo', $cantidad, $cantidad, $cantidad, $cantidad, '$unidad', '$justificacion', '$destino',NOW(), '$cod_articulo', $folio,1)");
        }
        $resultado = $sql->execute();
        return $resultado;
    }
    //==========================================================================
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
    public function set_comentario($comentario,$id_pedido,$id_empleado){
        $key_init = substr($comentario, 0, 10);
        
        if($key_init == "::status::"){
            $sql2 = $this->_db->prepare("INSERT INTO adm_pedido_comentario (comentario, id_pedido, id_empleado, fecha_hora) VALUES ('$comentario',$id_pedido,$id_empleado,NOW()) LIMIT 1");
            $sql2->execute();
            $resultado = $sql2;
        }else{
            $sql1 = $this->_db->prepare("UPDATE adm_pedido SET last_comentario = '$comentario', count_comentario = (count_comentario + 1) WHERE id_pedido = $id_pedido LIMIT 1");
            $sql2 = $this->_db->prepare("INSERT INTO adm_pedido_comentario (comentario, id_pedido, id_empleado, fecha_hora) VALUES ('$comentario',$id_pedido,$id_empleado,NOW()) LIMIT 1");
            $sql1->execute();
            $sql2->execute();
            $resultado = $sql1;
        }
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
        $sql = $this->_db->prepare("SELECT COUNT(*) AS count FROM adm_activo WHERE no_inventario = '$no_inventario' LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado[0]["count"];
    }
    function set_select_cout_sku($cod_articulo_new){
        $sql = $this->_db->prepare("SELECT COUNT(*) AS count FROM adm_almacen WHERE cod_articulo = '$cod_articulo_new' LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado[0]["count"];
    }
    //===========MODIFICACIÓN DE INVENTARIO=================================================================================================================================
    function set_insert_new_articulo($cod_articulo,$cod_articulo_new,$no_inventario,$no_serie,$costo,$especifica,$id_factura_detalle,$id_factura,$id_categoria){
        $sql1 = $this->_db->prepare("INSERT INTO adm_almacen (id_articulo,stock, stock_min, stock_max, importancia, ubicacion, salida, activo, cod_articulo)
                                     SELECT id_articulo, '0' AS stock, '0' AS stock_min, '0' AS stock_max, importancia, ubicacion, salida,'1' AS activo, '$cod_articulo_new' AS cod_articulo FROM adm_almacen WHERE cod_articulo = '$cod_articulo'");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock - 1) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        $sql3 = $this->_db->prepare("INSERT INTO adm_activo (no_inventario, no_serie,especificacion_tec,costo, status, cod_articulo, fecha_alta,tiempo_utilidad,id_factura,id_categoria_activo) VALUES ('$no_inventario','$no_serie','$especifica','$costo',1,'$cod_articulo_new', NOW(),0,$id_factura,$id_categoria)");
        $sql4 = $this->_db->prepare("UPDATE adm_factura_detalle SET restante = (restante - 1) WHERE id_factura_detalle = $id_factura_detalle LIMIT 1");
        
        $resultado4 = 0;
        
        $resultado1 = $sql1->execute();
        if(($resultado1) == 1){
            $resultado2 = $sql2->execute();
            if(($resultado2) == 1){
                $resultado3 = $sql3->execute();
                if(($resultado3) == 1){
                    $resultado4 = $sql4->execute();
                }
            }
        }
        return $resultado4;
    }
    function set_update_new_articulo($cod_articulo_new,$no_inventario,$no_serie,$costo,$especifica){
        $sql = "UPDATE adm_activo SET no_inventario = '$no_inventario', no_serie = '$no_serie',especificacion_tec = '$especifica',costo = '$costo' WHERE cod_articulo = '$cod_articulo_new' LIMIT 1";
        $sql1 = $this->_db->prepare($sql);
        $resultado1 = $sql1->execute();
        return $resultado1;
    }
    function set_delete_new_articulo($cod_articulo, $cod_articulo_new,$id_factura_detalle){
        $sql1 = $this->_db->prepare("DELETE FROM adm_activo WHERE adm_activo.cod_articulo = '$cod_articulo_new' LIMIT 1");
        $sql2 = $this->_db->prepare("DELETE FROM adm_almacen WHERE adm_almacen.cod_articulo = '$cod_articulo_new' LIMIT 1");
        $sql3 = $this->_db->prepare("UPDATE adm_almacen SET adm_almacen.stock = (adm_almacen.stock + 1) WHERE adm_almacen.cod_articulo = '$cod_articulo' LIMIT 1");
        $sql4 = $this->_db->prepare("UPDATE adm_factura_detalle SET restante = (restante + 1) WHERE id_factura_detalle = $id_factura_detalle LIMIT 1");
        
        $resultado4 = 0;
        
        $resultado1 = $sql1->execute();
        if(($resultado1) == 1){
            $resultado2 = $sql2->execute();
            if(($resultado2) == 1){
                $resultado3 = $sql3->execute();
                if(($resultado3) == 1){
                    $resultado4 = $sql4->execute();
                }
            }
        }
        
        return $resultado4;
    }
    function get_checkRestanteDetalleFactura($id_detalle_factura){
        $sql = $this->_db->prepare("SELECT restante FROM adm_factura_detalle WHERE id_factura_detalle = $id_detalle_factura LIMIT 1");
        $sql->execute();
        $restante = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $restante[0]["restante"];
    }
    function get_totalAvailableFactura($cod_articulo){
        $sql = $this->_db->prepare("SELECT descripcion,tipo_unidad, SUM(restante) as stock FROM adm_view_docto_factura_detail WHERE restante > 0 AND cod_articulo = '$cod_articulo'");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function get_detailAvailableFactura($cod_articulo){
        $sql = $this->_db->prepare("SELECT descripcion,tipo_unidad, restante,precio_unidad,id_factura_detalle,id_factura FROM adm_view_docto_factura_detail WHERE restante > 0 AND cod_articulo = '$cod_articulo'");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //======================================================================================================================================================================
    public function autentificar_firma($usuario, $password, $tokenid){
        $sql = $this->_db->prepare("SELECT id_empleado FROM adm_login WHERE adm_login.usuario = '$usuario' AND adm_login.pass = '$password' AND adm_login.estado = 1 LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultado) > 0){
            $id_empleado = $resultado[0]["id_empleado"];
            $sql2 = $this->_db->prepare("SELECT * ,'aprobado' as result FROM adm_view_autentificar WHERE id_empleado = '$id_empleado' AND status = 1 AND id_coordinacion = '$tokenid' LIMIT 1");
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
        $almacen = $this->_db->prepare("INSERT INTO adm_almacen (cod_articulo,stock,stock_min,stock_max,importancia,ubicacion,salida,id_articulo) VALUES ('$cod_articulo','','',0,1,1,3,NULL,0,0,NULL,$id_articulo)");
        $resultado = $almacen->execute();
        return $resultado;
    }
    //===========================NUEVAS CONSULTAS===============================
    public function get_asignacion_($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_asignacion_detail $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_solicitudes_($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_solicitud $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_vale_salida_($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_solicitud_entregado $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_solicitudes_op($filtro=""){
        $sql = $this->_db->prepare("SELECT *, sum(cantidad_surtido) as total_surtido, sum(cantidad_plan) as total_plan FROM adm_view_solicitud $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function set_update_cantidad_solicitudDetalle($id_pedido,$cantidad,$columna){
        $sql2 = $this->_db->prepare("UPDATE adm_pedido  SET $columna = $cantidad WHERE id_pedido = $id_pedido LIMIT 1");
        return $sql2->execute();
    }
    function set_update_cantidad_plan($id_pedido,$cantidad){
        if($cantidad > 0){
            $sql2 = $this->_db->prepare("UPDATE adm_pedido SET cantidad_plan = $cantidad, status_pedido = 1 WHERE id_pedido = $id_pedido LIMIT 1");
        }else{
            $sql2 = $this->_db->prepare("UPDATE adm_pedido SET cantidad_plan = $cantidad, status_pedido = 2 WHERE id_pedido = $id_pedido LIMIT 1");
        }
        return $sql2->execute();
    }
    function set_update_firma($firm,$folio,$columna_firm, $columna_fecha){
        $sql2 = $this->_db->prepare("UPDATE adm_solicitud_material SET $columna_firm = $firm, $columna_fecha = NOW() WHERE folio = $folio LIMIT 1");
        $sql3 = $this->_db->prepare("UPDATE adm_pedido SET cantidad_plan = cantidad_coord WHERE folio = $folio");
        $sql3 -> execute();
        return $sql2 -> execute();
    }
    function set_update_firma_plan($firm,$folio){
        $sql2 = $this->_db->prepare("UPDATE adm_solicitud_material SET firm_planeacion = $firm, fecha_firm_planeacion = NOW() WHERE folio = $folio LIMIT 1");
        $sql3 = $this->_db->prepare("UPDATE adm_pedido SET cantidad_pendiente = cantidad_plan WHERE folio = $folio");
        $sql3 -> execute();
        return $sql2 -> execute();
    }
    public function get_comentarioPedido($id_pedido){
        $sql = $this->_db->prepare("SELECT *, NOW() as ahora FROM adm_view_comentario_pedido WHERE id_pedido = $id_pedido");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function set_update_pedidoDetail($id_pedido,$cod_articulo, $articulo,$unidad,$justifi,$cantidad,$user){
        if(trim($cod_articulo) == ""){
            $sql2 = $this->_db->prepare("UPDATE adm_pedido  SET cod_articulo = NULL, articulo = '$articulo', unidad = '$unidad', justificacion = '$justifi', cantidad_$user='$cantidad' WHERE id_pedido = $id_pedido LIMIT 1");
        }else{
            $sql2 = $this->_db->prepare("UPDATE adm_pedido  SET cod_articulo = '$cod_articulo', articulo = '$articulo', unidad = '$unidad', justificacion = '$justifi', cantidad_$user='$cantidad' WHERE id_pedido = $id_pedido LIMIT 1");
        }
        return $sql2->execute();
    }
    function set_update_pedidoStatus($id_pedido,$status){
        $sql2 = $this->_db->prepare("UPDATE adm_pedido  SET status_pedido = $status WHERE id_pedido = $id_pedido LIMIT 1");
        return $sql2->execute();
    }
    public function get_select_query_($filtro){
        $sql = $this->_db->prepare($filtro);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_new_valesalida($folio){
        $articulo = $this->_db->prepare("INSERT INTO adm_almacen_valesalida (solicitud_material_folio,fecha) VALUES ($folio, NOW())");
        
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
    public function set_new_valesalida_rapido($folio,$recibe){
        $articulo = $this->_db->prepare("INSERT INTO adm_almacen_valesalida (solicitud_material_folio,fecha,recibe,status_valesalida) VALUES ($folio, NOW(), '$recibe',1)");
        
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
    public function set_valesalidaDetail($folio_vale,$id_pedido,$codarticulo,$cant_surtir){
        $almacen = $this->_db->prepare("INSERT INTO adm_almacen_valesalida_detail (folio_vale_salida,cantidad_surtida, fecha, id_pedido, cod_articulo) VALUES ($folio_vale, '$cant_surtir', NOW(), $id_pedido, '$codarticulo')");
        $entrega = $this->_db->prepare("UPDATE adm_pedido SET cantidad_pendiente = (cantidad_pendiente - $cant_surtir), cantidad_surtido = (cantidad_surtido + $cant_surtir) WHERE id_pedido = $id_pedido LIMIT 1");
        $product = $this->_db->prepare("UPDATE adm_almacen SET stock = (stock - $cant_surtir) WHERE cod_articulo = '$codarticulo' LIMIT 1");
        $resultado1 = $almacen -> execute();
        $entrega -> execute();
        $product -> execute();
        return $resultado1;
    }
    public function set_valesalidaDetail_rapido($folio_vale,$id_pedido,$codarticulo,$cant_surtir){
        $almacen = $this->_db->prepare("INSERT INTO adm_almacen_valesalida_detail (folio_vale_salida,cantidad_surtida, fecha, id_pedido, cod_articulo) VALUES ($folio_vale, '$cant_surtir', NOW(), $id_pedido, '$codarticulo')");
        $product = $this->_db->prepare("UPDATE adm_almacen SET stock = stock - $cant_surtir WHERE cod_articulo = '$codarticulo' LIMIT 1");
        $resultado1 = $almacen -> execute();
        $resultado2 = $product -> execute();
        return $resultado1;
    }
    public function get_solicitudes_valesalida($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_valesalida_solicitud $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_update_valesalida_detail_status($idpedidovalesalida, $recibe, $status){
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_valesalida_detail SET recibe = '$recibe', status = $status WHERE id_valesalida_pedido = $idpedidovalesalida LIMIT 1");
        return $sql2->execute();
    }
    public function set_update_valesalida_detail_status_vale($folio_vale_salida, $recibe, $status){
        $sql2 = $this->_db->prepare("UPDATE adm_almacen_valesalida SET recibe = '$recibe', status_valesalida = $status WHERE folio_vale_salida = $folio_vale_salida LIMIT 1");
        return $sql2->execute();
    }
    public function update_status_pedido($id_pedido){
        $sql = $this->_db->prepare("SELECT cantidad_plan,cantidad_surtido,cantidad_pendiente from adm_pedido WHERE id_pedido = $id_pedido LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($resultado[0]["cantidad_plan"] == $resultado[0]["cantidad_surtido"]){
            $sql2 = $this->_db->prepare("UPDATE adm_pedido SET status_pedido = 4 WHERE id_pedido = $id_pedido LIMIT 1");
            $sql2->execute();
        }
    }
    public function get_proveedor($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_proveedor $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    //====================
    public function get_doctoFactura($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_docto_prov $filtro ORDER BY id_factura DESC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_doctoFacturaDetail($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_docto_factura_detail $filtro ORDER BY id_factura_detalle DESC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    //====================
    public function set_new_proveedor($rfc,$nombre,$direccion,$num_telefono,$email,$pagina_web,$actividad_comercial){
        $almacen = $this->_db->prepare("INSERT INTO adm_proveedor(rfc, nombre, direccion, num_telefono, email, pagina_web, actividad_comercial) VALUES ('$rfc', '$nombre', '$direccion', '$num_telefono', '$email', '$pagina_web', '$actividad_comercial')");
        $resultado = $almacen->execute();
        return $resultado;
    }
    public function set_add_documento($serie_folio, $fecha_emision, $lugar_emision, $uuid, $total, $id_proveedor){
        $articulo = $this->_db->prepare("INSERT INTO adm_factura(serie_folio, fecha_emision, lugar_emision, uuid, total, date_insert, id_proveedor) VALUES ('$serie_folio', '$fecha_emision', '$lugar_emision', '$uuid', $total, NOW(),'$id_proveedor')");
        
        try {
            $this ->_db-> beginTransaction();
            $articulo -> execute();
            $id_documento = $this ->_db-> lastInsertId();
            $this ->_db-> commit();
            return $id_documento;
        } catch(PDOExecption $e) {
            $this ->_db-> rollback();
            return "Error!: " . $e -> getMessage();
        }
    }
    public function set_add_articulo($cantidad, $precio_unidad, $total, $id_factura, $cod_articulo){
        $almacen = $this->_db->prepare("INSERT INTO adm_factura_detalle(cantidad, precio_unidad, total, procesado, restante, fecha_hora, id_factura, cod_articulo) VALUES ('$cantidad', '$precio_unidad', '$total', 0, '$cantidad', NOW(), '$id_factura', '$cod_articulo')");
        $almacen2 = $this->_db->prepare("UPDATE adm_almacen SET stock = stock + $cantidad WHERE cod_articulo = '$cod_articulo' LIMIT 1");
        $resultado = $almacen->execute();
        if( $resultado == true){
            $upd_artic = $almacen2->execute();
            return $upd_artic;
        }else{
            return $resultado;
        }
    }
    public function get_articulo_detail($filtro=""){
        $sql = $this->_db->prepare("SELECT cod_articulo, descripcion, marca, nombre_categoria FROM adm_view_almacen_detail $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_empleado_detail($filtro=""){
        $sql = $this->_db->prepare("SELECT id_empleado, nombre, apellidos, puesto FROM adm_view_empleado $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function exe_factura_detalle($cod_articulo){
        $sql = $this->_db->prepare("SELECT id_factura_detalle, restante FROM adm_factura_detalle WHERE cod_articulo = '$cod_articulo' AND restante > 0 ORDER BY id_factura_detalle ASC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_update_almacenArticleSub($id_factura_detalle, $restante){
        $sql2 = $this->_db->prepare("UPDATE adm_factura_detalle SET restante = $restante WHERE id_factura_detalle = $id_factura_detalle LIMIT 1");
        return $sql2->execute();
    }
    public function reset_update_almacenArticleSub(){
        $sql2 = $this->_db->prepare("UPDATE adm_factura_detalle SET restante = cantidad");
        return $sql2->execute();
    }
    public function get_create_vale_salida($folio_valesalida){
        $sql = $this->_db->prepare("SELECT id_pedido,cantidad, fecha_requerimiento,cod_articulo,folio,nombre_solicitante FROM adm_view_solicitud WHERE folio = $folio_valesalida");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function verifi_SumArticulo($cod_articulo){
        $sql = $this->_db->prepare("SELECT stock FROM adm_almacen WHERE cod_articulo = '$cod_articulo'");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_propArticulo($cod_articulo){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_almacen_detail WHERE adm_view_almacen_detail.cod_articulo = :cod_articulo LIMIT 1");
        $sql->execute(array('cod_articulo' => $cod_articulo));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_propArticuloInv($cod_articulo){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_almacen_activos_fijos WHERE adm_view_almacen_activos_fijos.cod_articulo = :cod_articulo LIMIT 1");
        $sql->execute(array('cod_articulo' => $cod_articulo));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_update_articulo($cod_articulo,$id_articulo, $cod_barra,$descripcion,$especificacion,$tipo_unidad,$marca,$id_categoria,$stock_min,$stock_max,$ubicacion,$salida_rapida){
        $sql1 = $this->_db->prepare("UPDATE adm_articulo SET cod_barra='$cod_barra', descripcion='$descripcion', especificacion= '$especificacion', tipo_unidad= '$tipo_unidad', marca= '$marca', id_categoria= $id_categoria WHERE $id_articulo LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen SET stock_min=$stock_min,stock_max=$stock_max,ubicacion='$ubicacion', salida_rapida = $salida_rapida WHERE cod_articulo = '$cod_articulo'");
        $exe1 = $sql2 -> execute();
        if ($exe1){
            $exe2 = $sql1 -> execute();
            if($exe2){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function set_update_personal($id_empleado,$id_persona,$cargo,$especialista,$email,$telefono_empleo,$id_departamento,$idambito,$id_puesto,$email_personal,$direccion,$ciudad,$edo_prov,$cod_postal,$telefono,$curp){
        $sql1 = $this->_db->prepare("UPDATE adm_empleado SET cargo='$cargo',especialista='$especialista',email='$email',telefono_empleo='$telefono_empleo', id_departamento=$id_departamento, idambito=$idambito, id_puesto=$id_puesto WHERE id_empleado = $id_empleado LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_persona SET email_personal='$email_personal',direccion='$direccion',ciudad='$ciudad',edo_prov='$edo_prov',cod_postal='$cod_postal',telefono='$telefono',curp='$curp' WHERE id_persona = $id_persona");
        $exe1 = $sql1 -> execute();
        if ($exe1){
            $exe2 = $sql2 -> execute();
            if($exe2){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function set_delete_personal($id_empleado, $fecha_baja, $comentario_baja){
        $sql1 = $this->_db->prepare("UPDATE adm_empleado SET fecha_baja='$fecha_baja',comentario_baja='$comentario_baja', status = 0 WHERE id_empleado = $id_empleado LIMIT 1");
        $exe1 = $sql1 -> execute();
        if ($exe1){
            return true;
        }else{
            return false;
        }
    }
    public function set_insert_persona($nombre,$apellidos,$email_personal,$direccion,$ciudad,$edo_prov,$cod_postal,$telefono,$sexo,$curp){
        $sql1 = $this->_db->prepare("INSERT INTO adm_persona(nombre, apellidos, email_personal, direccion, ciudad, edo_prov, cod_postal, telefono, sexo, curp) VALUES ('$nombre', '$apellidos', '$email_personal', '$direccion', '$ciudad', '$edo_prov', '$cod_postal', '$telefono','$sexo', '$curp')");
        
        try {
            $this ->_db-> beginTransaction();
            $sql1 -> execute();
            $id_persona = $this ->_db-> lastInsertId();
            $this ->_db-> commit();
            return $id_persona;
        } catch(PDOExecption $e){
            $this ->_db-> rollback();
            return "Error!: " . $e -> getMessage();
        }
    }
    public function set_insert_empleado($id_persona,$fecha_alta,$cargo,$especialista,$email,$telefono_empleo,$id_departamento,$idambito,$id_puesto){
        $sql1 = $this->_db->prepare("INSERT INTO adm_empleado(id_persona, cargo, especialista, fecha_alta, email, telefono_empleo, id_departamento, idambito, id_puesto) VALUES ($id_persona,'$cargo','$especialista','$fecha_alta','$email','$telefono_empleo',$id_departamento,$idambito,$id_puesto)");
        
        try {
            $this ->_db-> beginTransaction();
            $sql1 -> execute();
            $id_empleado = $this ->_db-> lastInsertId();
            $this ->_db-> commit();
            return $id_empleado;
        } catch(PDOExecption $e){
            $this ->_db-> rollback();
            return "Error!: " . $e -> getMessage();
        }
    }
    public function set_insert_articulo($cod_barra,$descripcion,$especificacion,$tipo_unidad,$marca,$id_categoria){
        $sql1 = $this->_db->prepare("INSERT INTO adm_articulo(cod_barra,descripcion,especificacion,tipo_unidad,marca,id_categoria) VALUES ('$cod_barra','$descripcion','$especificacion','$tipo_unidad','$marca',$id_categoria)");
        
        try {
            $this ->_db-> beginTransaction();
            $sql1 -> execute();
            $id_articulo = $this ->_db-> lastInsertId();
            $this ->_db-> commit();
            return $id_articulo;
        } catch(PDOExecption $e){
            $this ->_db-> rollback();
            //return "Error!: " . $e -> getMessage();
            return 0;
        }
    }
    public function set_insert_almacen($cod_articulo,$id_articulo,$salida_rapida){
        $almacen = $this->_db->prepare("INSERT INTO adm_almacen (cod_articulo,id_articulo, stock, activo,salida_rapida) VALUES ('$cod_articulo','$id_articulo',0,1,$salida_rapida)");
        $resultado = $almacen->execute();
        return $resultado;
    }
    public function set_insert_activo($tiempo_utilidad,$fecha_alta,$costo,$no_inventario,$no_serie,$status,$operable,$disponible,$cod_articulo,$id_categoria){
        $activo = $this->_db->prepare("INSERT INTO adm_activo (tiempo_utilidad,fecha_alta,costo,no_inventario,no_serie,status,operable,disponible,cod_articulo,id_categoria_activo) VALUES ('$tiempo_utilidad','$fecha_alta','$costo','$no_inventario','$no_serie',$status,$operable,$disponible,'$cod_articulo',$id_categoria)");
        $resultado = $activo->execute();
        return $resultado;
    }
    public function set_update_activo($cod_articulo,$id_articulo, $cod_barra,$descripcion,$especificacion,$marca,$fecha_adquisicion, $tiempo_utilidad, $fecha_baja,$costo, $no_inventario, $no_serie,$status,$disponible,$operable,$salida_rapida){
        $sql1 = $this->_db->prepare("UPDATE adm_articulo SET cod_barra='$cod_barra', descripcion='$descripcion', especificacion= '$especificacion', marca= '$marca' WHERE id_articulo = $id_articulo LIMIT 1");
        $sql2 = $this->_db->prepare("UPDATE adm_almacen  SET salida_rapida = $salida_rapida WHERE cod_articulo = '$cod_articulo'");
        $sql3 = $this->_db->prepare("UPDATE adm_activo   SET tiempo_utilidad=$tiempo_utilidad, fecha_alta='$fecha_adquisicion', fecha_baja='$fecha_baja', costo = $costo, no_inventario = '$no_inventario', no_serie = '$no_serie', disponible=$disponible, operable = $operable, status = $status WHERE cod_articulo = '$cod_articulo' LIMIT 1");
        
        $exe1 = $sql1 -> execute();
        if ($exe1){
            $exe2 = $sql2 -> execute();
            if($exe2){
                $exe3 = $sql3 -> execute();
                if($exe3){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function get_activofijo($filtro = ""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_almacen_activos_fijos $filtro ORDER BY id_categoria_activo ASC");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
     public function get_movimiento($filtro=""){
        $sql = $this->_db->prepare("SELECT * FROM adm_trazabilidad $filtro");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function set_new_trazabilidad($fecha_movimiento,$motivo,$responsable,$ubicacion,$condicion,$cod_articulo){
        $almacen = $this->_db->prepare("INSERT INTO adm_trazabilidad(fecha_registro,fecha_movimiento,motivo,responsable,ubicacion,condicion,cod_articulo) VALUES (NOW(),'$fecha_movimiento','$motivo','$responsable','$ubicacion','$condicion','$cod_articulo')");
        $resultado = $almacen->execute();
        return $resultado;
    }
    public function get_personal($filtro = "",$limit = ""){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_empleado $filtro ORDER BY ambito, nombre ASC $limit");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_ambito(){
        $sql = $this->_db->prepare("SELECT * FROM adm_ambito");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_departamento(){
        $sql = $this->_db->prepare("SELECT * FROM adm_departamento");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_puesto(){
        $sql = $this->_db->prepare("SELECT * FROM adm_nivel_org");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function get_personalDetail($id_personal){
        $sql = $this->_db->prepare("SELECT * FROM adm_view_empleado WHERE id_empleado = $id_personal LIMIT 1");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function get_precio_unitario_inv($cod_articulo){
        $sql = $this->_db->prepare("SELECT id_factura_detalle, precio_unidad FROM adm_factura_detalle WHERE cod_articulo = '$cod_articulo' AND restante > 0");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
