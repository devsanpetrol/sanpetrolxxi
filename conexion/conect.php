<?php

require_once 'config.php';

class conect 
{
    protected $_db;

    public function __construct() 
    {
        try{
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db = new PDO(DSN, DB_USER, DB_PASS, $opciones);
        }catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
        }
    } 
} 