<?php

class UsuariosController extends Zend_Controller_Action
{
    private $em;


    public function init()
    {
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        
         $this->_helper->layout->setLayout('admin');
     //  $this->_helper->layout->setLayout('prueba'); 
         $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
        
        
        
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
    public function agregarusuarioAction()
    { 
     
       //Consulta dql para listar las facultades
        $dql1 ="select p from Application_Model_Programas p";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query1 = $this->em->createQuery($dql1);
        
        //Resultados de la consulta en un Vector, en este caso en Array
      $programas = $query1->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->programas= $programas;
        //
        //Consulta dql para listar las facultades
        $dql2 ="select r from Application_Model_Roles r";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query2 = $this->em->createQuery($dql2);
        
        //Resultados de la consulta en un Vector, en este caso en Array
      $roles = $query2->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->roles= $roles;
        
        
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
     $this->view->headScript()->appendFile('/admin/usuarios.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
    }
    public function listarusuarioAction()
    { 
       
            //Codigo de editar programas
        
        // Con left join salen los datos sin existir las llaves foraneas
        //Preparo la consulta 
        $dql="select u, usu, r from Application_Model_Usuarios u left join u.cod_programa usu left join u.id_rol r";
        
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $usuarios = $query->getArrayResult();
        //var_dump($usuarios);
        
        // Pasarle la información de programas a la vista ..
        $this->view->usuarios= $usuarios;
        
      
      $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
      $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
      $this->view->headLink()->appendStylesheet('/css/facultad.css');
      $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
      $this->view->headScript()->appendFile('/js/facultad.js');
      $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
      $this->view->headScript()->appendFile('/admin/usuarios.js');
      $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
      $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
      $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
      $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
    }
   public function guardarusuarioAction(){
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
    
          //$usuario recibe los datos que se les pasa por petición ajax
     $nom =$this->_getParam('nom');
     $ape =$this->_getParam('ape');
     $ide =$this->_getParam('ide');
     $correo =$this->_getParam('correo');
     $usuario =$this->_getParam('usuario');
     $pass =$this->_getParam('pass');
     $programa =$this->_getParam('programa');
     $rol =$this->_getParam('rol');
      // var_dump($facultad);
         // Instancia del modelo Facultades. crea una facultad automatico..
     $usuario_objeto = new Application_Model_Usuarios();
     //la instancia le asigna una facultad, hacer el nombre de la facultad..
     $usuario_objeto->setnombre(htmlentities($nom));
     $usuario_objeto->setapellidos(htmlentities($ape));
     $usuario_objeto->setidentificacion($ide);
     $usuario_objeto->setcorreo($correo);
     $usuario_objeto->setusuario(htmlentities($usuario));
     $usuario_objeto->setcontrasena(md5($pass));
     $usuario_objeto->setcod_programa($this->em->getRepository('Application_Model_Programas')->find($programa));
     $usuario_objeto->setid_rol($this->em->getRepository('Application_Model_Roles')->find($rol));
     // Almacena en el objecto la usuario que tiene el id..
    // var_dump($usuario_objeto);     
    //da la orden de guardar...
   $this->em->persist($usuario_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush(); 
     
     //capturar excepciones
   /**  try {
     } catch (Exception $e) {
         echo $e->getMessage();
     } */
     
   }
    public function editarusuarioAction()
    { 
       
        
       //Consulta dql para listar las facultades
     /**   $dql3 ="select p from Application_Model_Programas p";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query3 = $this->em->createQuery($dql3);
        
       $programas = $query3->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->programas= $programas;
       
       
       //Consulta dql para listar las Roles
        $dql4 ="select r from Application_Model_Roles r";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query4 = $this->em->createQuery($dql4);
        
        //Resultados de la consulta en un Vector, en este caso en Array
       $roles = $query4->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->roles= $roles;
        
            //Codigo de editar programas
        $programa_id =$this->_getParam('id');
       // var_dump($programa_id);
        //Preparo la consulta 
        $dql5="select p from Application_Model_Programas p";
        // Creo un Nuevo Query donde se guarda la consulta.
        $query5= $this->em->createQuery($dql5);
        //Donde se guarda el id del Programa...
        $query5->setParameter('programa', $programa_id);
       // var_dump($query);
        //Muestre el resultado en un array
        $programa=  $query5->getArrayResult();
        
       // var_dump();
        
          try{ 
    
     } catch (Exception $e) {
         echo $e->getMessage();
     }  */
    
       // $this->view->programa= $programa;  
        
        
        
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
     $this->view->headScript()->appendFile('/admin/usuarios.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
     $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
    }  
     public function actualizarusuarioAction(){
          //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     //Recibir id como parametro
     $id= $this->_getParam('id');   
     //Se hace un condicional que el id es mayo que cero
     if($id>0){
      //Proceso a editar
       //$facultad recibe los datos que se les pasa por petición ajax
     $programa =$this->_getParam('programa');  
     //var_dump($programa);
     //Nombre de la facultad donde esta asociada la llave foranea...
     $facultad =  $this->_getParam('facultad');
     
     // Almacena en el objecto Programa que tiene el id..
    $programa_objeto = ($this->em->getRepository('Application_Model_Programas')->find($id));
     //la instancia le asigna una facultad, hacer el nombre de la facultad..
     $programa_objeto->setnombre($programa);
     //da la orden de guardar...
     $programa_objeto->setcod_facultad($this->em->getRepository('Application_Model_Facultades')->find($facultad));
             
     $this->em->persist($programa_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush();
     
    $this->view->headScript()->appendFile('/admin/usuarios.js');
     }      
    }
     public function eliminarusuarioAction(){
          //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     //Recibo el dato por ajax
     try {
     $programa_id= $this->_getParam('programa_id');  
     
     $programa_objeto= ($this->em->getRepository('Application_Model_Programas')->find($programa_id));
     
     // da la orden de guardar
     $this->em->remove($programa_objeto);
     
     //Ejecuta la Orden de Guardar
     $this->em->flush();
         
     } catch (Exception $ex) {
     header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
         
     }
           
    }

}



