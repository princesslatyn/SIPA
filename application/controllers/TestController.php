<?php

class TestController extends Zend_Controller_Action
{
    // Entity Manager
    private $em;

    public function init()
    {
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        
         $this->_helper->layout->setLayout('admin');
         $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
         $this->view->headLink()->appendStylesheet('/css/facultad.css');
        
    }

    public function indexAction(){
           //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
       
     try {
         //Conexión con la Base de datos del software academico power Campus
      /**   $serverName = "172.16.14.241"; //serverName\instanceName
         $connectionInfo = array( "Database"=>"Campus", "UID"=>"lila", "PWD"=>"lila12345");
         $conn = sqlsrv_connect( $serverName, $connectionInfo);

          if( $conn ) {
     
          echo "Conexión establecida.<br />";
          //Preparo la consulta....
         $sql = "SELECT * FROM V_Programas, V_Asignaturas, V_Grupos WHERE Semestre='8' AND Asignatura='ADMINISTRACION DE EMPRESAS ACUICOLAS' AND Programa='MAESTRIA EN SALUD PUBLICA' AND Matriculados='12' AND Grupo='G-1'";
          $stmt = sqlsrv_query( $conn, $sql );
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          echo " ".$row['Semestre'].", ".$row['Asignatura'].", ".$row['Programa'].", ".$row['Matriculados'].", ".$row['Grupo']."<br />";
          //var_dump($sql);
       }
       sqlsrv_free_stmt( $stmt);
          
            }else{
                 echo "Conexión no se pudo establecer.<br />";
                 die( print_r( sqlsrv_errors(), true));
            } */
//          $servername="172.16.14.241";
//          $conn= new PDO("sqlsrv:server=$servername;Database=Campus;", "lila", "lila12345");
//          if($conn){
//            echo 'Ok';
//          }else{
//            echo 'Error de Conexión ):';
//            }
   //Conexión con la Base de datos del software de Gestión Humana
    //Conexión con la Base de datos del software academico power Campus
         $serverName = "10.0.4.51"; //serverName\instanceName
         $connectionInfo = array( "Database"=>"KACTUS", "UID"=>"Unicor", "PWD"=>"123456789ABC");
         $conn = sqlsrv_connect( $serverName, $connectionInfo);

          if( $conn ) {
     
          echo "Conexión establecida Con Kactus.<br />";
          $sql = "SELECT * FROM VIEW_SIPA";
          var_dump($sql);
          $stmt = sqlsrv_query($conn, $sql);
          var_dump($stmt);
         exit();
         while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
        // echo $row['Cedula'].", ".$row['Apellidos'].", ".$row['Nombres'].", ".$row['Cargo']."<br />";
          }
          sqlsrv_free_stmt($stmt);
          var_dump($row);
          
            }else{
                 echo "Conexión no se pudo establecer.<br />";
                 die( print_r( sqlsrv_errors(), true));
            }        
         
     } catch (Exception $e) {
         echo $e->getMessage();
         
     }
                
       
    }
    
    public function agregarfacultadAction()
    { 
     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/fuelux.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
     $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
     $this->view->headLink()->appendStylesheet('/css/facultad.css');
//     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.css.map');
     $this->view->headScript()->appendFile('/js/fuelux.min.js');
     $this->view->headScript()->appendFile('/js/wizard.js');
     $this->view->headScript()->appendFile('/bootstrap/js/moment.min.js');   
     $this->view->headScript()->appendFile('/bootstrap/js/bootstrap-datepicker.js');      
     $this->view->headScript()->appendFile('/bootstrap/js/datepicker.es.min.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/js/practica.js');
     $this->view->headScript()->appendFile('/admin/facultades.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
    }
    public function listarfacultadAction()
    { 
       
        
        //Consulta dql para listar las facultades
        $dql ="select f from Application_Model_Facultades f";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $facultades = $query->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->facultades= $facultades;
        
      
      $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
      $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
      $this->view->headLink()->appendStylesheet('/css/facultad.css');
      $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
      $this->view->headScript()->appendFile('/js/facultad.js');
      $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
      $this->view->headScript()->appendFile('/admin/facultades.js');
      $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
      $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
      $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
      $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
      
    }
    public function guardarfacultadAction(){
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     //$facultad recibe los datos que se les pasa por petición ajax
     $facultad =$this->_getParam('facultad');  
     //var_dump($facultad);
     
     // Instancia del modelo Facultades. crea una facultad automatico..
     $facultad_objeto = new Application_Model_Facultades();
     //la instancia le asigna una facultad, hacer el nombre de la facultad..
     $facultad_objeto->setnombre($facultad);
     //da la orden de guardar...
     $this->em->persist($facultad_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush();   
        
        
    }
     public function editarfacultadAction() { 
       
         //capturo el id de la facultad
         $facultad_id =$this->_getParam('id');
         //Realizo la consulta para obtener el codigo de la facultad...
         $dql= "select f from Application_Model_Facultades f where f.id_facultad=:facultad";
         //Crear el query para que se guarde la consulta...
         $query= $this->em->createQuery($dql);
         //Se guarde el id de facultad..
         $query->setParameter('facultad', $facultad_id);
         //muestre el resultado en un array...
         $facultad =$query->getArrayResult();
        // var_dump($facultad);     
      
       /** try{  
     } catch (Exception $e) {
         echo $e->getMessage();
     } */
         //Se le pasa la variable a la vista...
        $this->view->facultad= $facultad; 
         
     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/fuelux.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
     $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
     $this->view->headLink()->appendStylesheet('/css/facultad.css');
//     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.css.map');
     $this->view->headScript()->appendFile('/js/fuelux.min.js');
     $this->view->headScript()->appendFile('/js/wizard.js');
     $this->view->headScript()->appendFile('/bootstrap/js/moment.min.js');   
     $this->view->headScript()->appendFile('/bootstrap/js/bootstrap-datepicker.js');      
     $this->view->headScript()->appendFile('/bootstrap/js/datepicker.es.min.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/js/practica.js');
     $this->view->headScript()->appendFile('/admin/facultades.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
     $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
    }
    public function actualizarfacultadAction(){
          //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     //Recibir id como parametro
     $id= $this->_getParam('id');   
     //Se hace un condicional que el id es mayor que cero
     if($id>0){
      //Proceso a editar
       //$facultad recibe los datos que se les pasa por petición ajax
     $facultad =$this->_getParam('facultad');  
     //var_dump($facultad);
     
     // Almacena en el objecto la facultad que tiene el id..
     $facultad_objeto = ($this->em->getRepository('Application_Model_Facultades')->find($id));
     //la instancia le asigna una facultad, hacer el nombre de la facultad..
     $facultad_objeto->setnombre($facultad);
     //da la orden de guardar...
     $this->em->persist($facultad_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush();     
     }      
    }
      public function eliminarfacultadAction(){
          //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     //Recibo el dato por ajax
     try {
     $facultad_id= $this->_getParam('facultad_id');  
     
     $facultad_objeto= ($this->em->getRepository('Application_Model_Facultades')->find($facultad_id));
     
     // da la orden de guardar
     $this->em->remove($facultad_objeto);
     
     //Ejecuta la Orden de Guardar
     $this->em->flush();
         
     } catch (Exception $ex) {
     header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
         
     }
           
    }
}



