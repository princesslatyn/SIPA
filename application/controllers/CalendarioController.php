<?php

class CalendarioController extends Zend_Controller_Action{
     private $em;

    public function init()
    {
        /* Initialize action controller here */
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        
        $this->_helper->layout->setLayout('admin');
        $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css'); 
        $this->view->headLink()->appendStylesheet('/css/facultad.css');
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
    public function agregarcalendarioAction() { 
        //Consulta dql para listar los calendarios
        $dql ="select c from Application_Model_Calendario c";
        //var_dump($dql);
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $calendario = $query->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->calendario= $calendario;  
        
     
     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/fuelux.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
     $this->view->headLink()->appendStylesheet('/css/font-awesome.min.css');
//     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.css.map');
     $this->view->headScript()->appendFile('/js/fuelux.min.js');
     $this->view->headScript()->appendFile('/js/wizard.js');
     $this->view->headScript()->appendFile('/bootstrap/js/moment.min.js');   
     $this->view->headScript()->appendFile('/bootstrap/js/bootstrap-datepicker.js');      
     $this->view->headScript()->appendFile('/bootstrap/js/datepicker.es.min.js');
     $this->view->headScript()->appendFile('/js/practica.js');
      $this->view->headScript()->appendFile('/admin/calendario.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
    }
    public function guardarcalendarioAction(){
      //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     
    
      
     $annio =$this->_getParam('annio'); 
     $per =$this->_getParam('per');
     var_dump($per);
     $ini =$this->_getParam('ini');
     $fin =$this->_getParam('fin');
     
     $calendario_objeto = new Application_Model_Calendario();
     $calendario_objeto->setannio($annio);
     $calendario_objeto->setperiodo($per);
     $calendario_objeto->setfecha_inicio($ini);
     $calendario_objeto->setfecha_fin($fin);
     
    // var_dump($calendario_objeto);
    $this->em->persist($calendario_objeto);
     //Ejecuta la Orden de guardar..
    $this->em->flush(); 
           
     
     
    }

    public function listarcalendarioAction() { 
    
         //Consulta dql para listar los calendarios
        $dql ="select c from Application_Model_Calendario c";
        //var_dump($dql);
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $calendario = $query->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->calendario= $calendario;
     
     
      $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/fuelux.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
     $this->view->headLink()->appendStylesheet('/css/font-awesome.min.css');
//     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.css.map');
     $this->view->headScript()->appendFile('/js/fuelux.min.js');
     $this->view->headScript()->appendFile('/js/wizard.js');
     $this->view->headScript()->appendFile('/bootstrap/js/moment.min.js');   
     $this->view->headScript()->appendFile('/bootstrap/js/bootstrap-datepicker.js');      
     $this->view->headScript()->appendFile('/bootstrap/js/datepicker.es.min.js');
     $this->view->headScript()->appendFile('/js/practica.js');
     // $this->view->headScript()->appendFile('/admin/calendario.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
    
    }

}



