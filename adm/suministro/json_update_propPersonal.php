<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
   
    if(!empty($_POST['id_empleado']) && !empty($_POST['id_persona'])){
        $id_empleado = $_POST['id_empleado'];
        $id_persona = $_POST['id_persona'];
        $email_personal = $_POST['email_personal'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $edo_prov = $_POST['edo_prov'];
        $cod_postal = $_POST['cod_postal'];
        $curp = $_POST['curp'];
        $telefono = $_POST['telefono'];
        $idambito = $_POST['ambito'];
        $id_departamento = $_POST['departamento'];
        $id_puesto = $_POST['puesto'];
        $cargo = $_POST['cargo'];
        $especialista = $_POST['especialista'];
        $email = $_POST['email'];
        $telefono_empleo = $_POST['telefono_empleo'];
        
        $guarda = $suministro->set_update_personal($id_empleado, $id_persona, $cargo, $especialista, $email, $telefono_empleo, $id_departamento, $idambito, $id_puesto, $email_personal, $direccion, $ciudad, $edo_prov, $cod_postal, $telefono, $curp);
        
        if ($guarda == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    header('Content-Type: application/json');
    echo json_encode($data);