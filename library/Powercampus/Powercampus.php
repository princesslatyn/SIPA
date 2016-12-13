<?php

class Powercampus {
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
        //llamar el metodo conectar
        $this->conectar();
               
    }
   
   //hago un metodo para las conexiones con power campues
   public function conectar(){
   
         //Conexión con la Base de datos del software academico power Campus
         //serverName\instanceName
         $ServerName= $this->serverName;
         $connection = array( "Database"=>  $this->database, "UID"=>$this->usuario, "PWD"=>$this->contrasena);
         $conn = sqlsrv_connect($ServerName, $connection);

          if( $conn ) {
     
          echo "Conexión establecida.<br />";
          //Preparo la consulta....
            }else{
                 echo "Conexión no se pudo establecer.<br />";
                 die( print_r( sqlsrv_errors(), true));
            }
       
       
       
   }
  
}


