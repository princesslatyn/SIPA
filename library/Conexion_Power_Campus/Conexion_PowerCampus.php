<?php

class Conexion_PowerCampus {
   private $database;
   private $usuario;
   private $contrasena;
   private $serverName;

    
    //Creo el constructor
    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->database= "Campus";
        $this->usuario= "lila";
        $this->contrasena= "lila12345";
        $this->serverName= "172.16.14.241";
           
    }
   
   
   //hago un metodo para las conexiones con power campues
   public function conectar(){
   
       //Conexión con la Base de datos del software academico power Campus
         $database= "Campus";
         $serverName = "172.16.14.241"; //serverName\instanceName
         $usuario= "lila";
         $contrasena= "lila12345";
         $conn = sqlsrv_connect( $serverName, $database, $usuario, $contrasena);

          if( $conn ) {
     
          echo "Conexión establecida.<br />";
          //Preparo la consulta....
            }else{
                 echo "Conexión no se pudo establecer.<br />";
                 die( print_r( sqlsrv_errors(), true));
            }
       
       
       
   }
  
}


