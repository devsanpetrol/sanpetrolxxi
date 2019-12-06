<?php
    
    require_once './suministro.php'; 
    
    $suministro = new suministro(); 
    $a_users = $suministro->get_almacen_categoria();
    
    echo json_encode($a_users);
   
    
    
    
    
