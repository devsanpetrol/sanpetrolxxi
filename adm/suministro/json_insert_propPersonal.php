<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
   
    if(!empty($_POST['nombre']) && !empty($_POST['apellidos'])){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $sexo = $_POST['genero'];
        $email_personal = $_POST['email_personal'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $edo_prov = $_POST['edo_prov'];
        $cod_postal = $_POST['cod_postal'];
        $curp = $_POST['curp'];
        $telefono = $_POST['telefono'];
        $fecha_alta = $_POST['fecha_alta'];
        $idambito = $_POST['ambito'];
        $id_departamento = $_POST['departamento'];
        $id_puesto = $_POST['puesto'];
        $cargo = $_POST['cargo'];
        $especialista = $_POST['especialista'];
        $email = $_POST['email'];
        $telefono_empleo = $_POST['telefono_empleo'];
        
        $guarda = $suministro->set_insert_personal($fecha_alta, $cargo, $especialista, $email, $telefono_empleo, $id_departamento, $idambito, $id_puesto, $nombre, $apellidos, $email_personal, $direccion, $ciudad, $edo_prov, $cod_postal, $telefono, $sexo, $curp);
        
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