<?php  
require_once "../conexion/conect.php"; 

class log extends conect
{     
    public function __construct() 
    {
        parent::__construct(); 
    }
    public function get_access_login($user,$pass){
        $sql = $this->_db->prepare("SELECT
                                    adm_login.id_usuario, adm_login.usuario, adm_login.estado, adm_login.avatar, adm_login.tipo,
                                    adm_empleado.cargo, adm_empleado.email,adm_empleado.especialista, adm_empleado.telefono,adm_empleado.id_empleado,
                                    adm_departamento.departamento,
                                    adm_persona.nombre,adm_persona.apellidos
                                    FROM adm_login
                                    INNER JOIN adm_empleado ON adm_empleado.id_empleado = adm_login.id_empleado
                                    INNER JOIN adm_departamento ON adm_empleado.id_departamento = adm_departamento.id_departamento
                                    INNER JOIN adm_persona ON adm_persona.id_persona = adm_empleado.id_persona
                                    WHERE usuario = :user and pass = :pass LIMIT 1");//nombre = :Nombre'
        $sql->execute(array('user' => $user,'pass'=>$pass));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}