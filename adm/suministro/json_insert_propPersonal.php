<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
   
    if(!empty($_POST['nombre']) && !empty($_POST['apellidos'])){
        $nombre = mb_strtoupper($_POST['nombre']);
        $apellidos = mb_strtoupper($_POST['apellidos']);
        $sexo = $_POST['genero'];
        $email_personal = mb_strtolower ($_POST['email_personal']);
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $edo_prov = $_POST['edo_prov'];
        $cod_postal = $_POST['cod_postal'];
        $curp = mb_strtoupper($_POST['curp']);
        $telefono = $_POST['telefono'];
        $fecha_alta = $_POST['fecha_alta'];
        $idambito = $_POST['ambito'];
        $id_departamento = $_POST['departamento'];
        $id_puesto = mb_strtoupper($_POST['puesto']);
        $cargo = mb_strtoupper($_POST['cargo']);
        $especialista = mb_strtoupper($_POST['especialista']);
        $email = mb_strtolower ($_POST['email']);
        $telefono_empleo = $_POST['telefono_empleo'];
        
        $id_persona = $suministro->set_insert_persona($nombre, $apellidos, $email_personal, $direccion, $ciudad, $edo_prov, $cod_postal, $telefono, $sexo, $curp);
        
        if($id_persona > 0){
            $id_empleado = $suministro->set_insert_empleado($id_persona,$fecha_alta, $cargo, $especialista, $email, $telefono_empleo, $id_departamento, $idambito, $id_puesto);
                $data[] = array("result"=>"exito","id_empleado"=>$id_empleado,"id_persona"=>$id_persona);
        }else{
            $data[] = array("result"=> $id_persona);
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    header('Content-Type: application/json');
    echo json_encode($data);