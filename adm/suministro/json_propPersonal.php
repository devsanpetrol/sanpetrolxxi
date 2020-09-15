    <?php
require_once './suministro.php';
$suministro = new suministro();

$datos = array(
            'nombre' => '', //OK
            'apellidos' => '',
            'email_personal' => '',
            'direccion' => '',
            'ciudad' => '',
            'edo_prov' => '',
            'cod_postal' => '',
            'telefono' => '',
            'sexo' => '',
            'curp' => '',
            'id_empleado' => '',
            'cargo' => '',
            'especialista' => '',
            'fecha_alta' => '',
            'fecha_baja' => '',
            'email' => '',
            'telefono_empleo' => '',
            'status' => '',
            'autoriza_solicitud_mat' => '',
            'id_persona' => '',
            'departamento' => '',
            'id_departamento' => '',
            'idambito' => '',
            'ambito' => '',
            'nivel' => '',
            'puesto' => '',
            'fecha_baja' => ''
        );

if(!empty($_POST['idempleado'])){
    $dato = $suministro->get_personalDetail($_POST['idempleado']);
    if( count($dato) > 0 ){
        $datos = array(
            'nombre' => $dato[0]['nombre'], //OK
            'apellidos' => $dato[0]['apellidos'], //OK
            'email_personal' => $dato[0]['email_personal'], //OK
            'direccion' => $dato[0]['direccion'], //OK
            'ciudad' => $dato[0]['ciudad'], //OK
            'edo_prov' => $dato[0]['edo_prov'], //OK
            'cod_postal' => $dato[0]['cod_postal'],
            'telefono' => $dato[0]['telefono'],
            'sexo' => $dato[0]['sexo'], //OK
            'curp' => $dato[0]['curp'],
            'id_empleado' => $dato[0]['id_empleado'],
            'cargo' => $dato[0]['cargo'],
            'especialista' => $dato[0]['especialista'],
            'fecha_alta' => $dato[0]['fecha_alta'],
            'fecha_baja' => $dato[0]['fecha_baja'],
            'email' => $dato[0]['email'],
            'telefono_empleo' => $dato[0]['telefono_empleo'],
            'status' => $dato[0]['status'],
            'autoriza_solicitud_mat' => $dato[0]['autoriza_solicitud_mat'],
            'id_persona' => $dato[0]['id_persona'],
            'departamento' => $dato[0]['departamento'],
            'id_departamento' => $dato[0]['id_departamento'],
            'idambito' => $dato[0]['idambito'],
            'ambito' => $dato[0]['ambito'],
            'nivel' => $dato[0]['nivel'],
            'puesto' => $dato[0]['puesto'],
            'fecha_baja' => $dato[0]['fecha_baja']
        );
    }
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);