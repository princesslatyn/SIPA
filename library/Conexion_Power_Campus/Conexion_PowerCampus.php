<?php

class Conexion_PowerCampus {
   private $database;
   private $usuario;
   private $contrasena;
   
   //hago un metodo para las conexiones con power campues
   public function conectar(){
   
       //Conexión con la Base de datos del software academico power Campus
         $serverName = "172.16.14.241"; //serverName\instanceName
         $connectionInfo = array( "Database"=>"Campus", "UID"=>"lila", "PWD"=>"lila12345");
         $conn = sqlsrv_connect( $serverName, $connectionInfo);

          if( $conn ) {
     
          echo "Conexión establecida.<br />";
          //Preparo la consulta....
            }else{
                 echo "Conexión no se pudo establecer.<br />";
                 die( print_r( sqlsrv_errors(), true));
            }
       
       
       
   }
}


