 <?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $folio_vale_salida = $_POST["folio"];
    $solicitud = $suministro->get_select_query_("SELECT * FROM adm_view_valesalida_solicitud WHERE folio_vale_salida = $folio_vale_salida LIMIT 1");
    $data = array();
    
    $data[] = array("nombre_generico" => $solicitud[0]['nombre_generico'],
                    "nombre_solicitante" => $solicitud[0]['nombre_solicitante'],
                    "puesto_solicitante" => $solicitud[0]['puesto_solicitante'],
                    "fecha" => fecha($solicitud[0]['fecha_solicitud']),
                    "sitio_operacion" => $solicitud[0]['sitio_operacion'],
                    "status" => $solicitud[0]['status'],
                    "clave_solicita" => $solicitud[0]['clave_solicita'],
                    "id_equipo" => $solicitud[0]['id_equipo'],
                    "folio_vale_salida" => $solicitud[0]['folio_vale_salida'],
                    "folio_full" => $solicitud[0]['folio']."-".$solicitud[0]['folio_vale_salida'],
                    "fecha_vale" => fecha($solicitud[0]['fecha_vale']),
                    "recibe" => $solicitud[0]['recibe'],
                    "observacion" => $solicitud[0]['observacion'],
                    "status_valesalida" => $solicitud[0]['status_valesalida'],
                    "folio" => $solicitud[0]['folio'],
                    "fecha_solicitud" => fecha($solicitud[0]['fecha_solicitud'])
                    );
    function fecha($fecha){
        $date = new DateTime($fecha);
        return $date->format('F d (ga)');
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    