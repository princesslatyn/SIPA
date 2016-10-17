<?php

class calendarController extends Zend_Controller_Action
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
         //$this->view->headLink()->appendStylesheet('/css/facultad.css');
        
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
    public function agregarcalendarAction(){
        
        //Consulta dql para listar los calendarios
        $dql ="select c from Application_Model_calendar c";
        //var_dump($dql);
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $calendario = $query->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->calendario= $calendario;  
        
         //Enlaces    
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
     $this->view->headScript()->appendFile('/admin/calendario.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
        
    }

    public function listarcalendarAction()
    { 
         //Consulta dql para listar los calendarios
        $dql ="select c from Application_Model_calendar c";
        //var_dump($dql);
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $calendario = $query->getArrayResult();
        
        
        $this->view->calendario= $calendario;
       
        
      //Los Enlaces
      $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
      $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
      $this->view->headLink()->appendStylesheet('/css/facultad.css');
      $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
      $this->view->headScript()->appendFile('/js/facultad.js');
      $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
      $this->view->headScript()->appendFile('/admin/calendario.js');
      $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
      $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
      $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
      $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
      
    }
    public function guardarcalendarAction(){
        
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
   

     //Recibo los parametros por ajax
     $annio =$this->_getParam('annio'); 
     $per =$this->_getParam('per');
     $ini =$this->_getParam('ini');
     $fin =$this->_getParam('fin');
     try{
        //formato para convertir string a datetime
         $fecha_inicio = new DateTime($ini);
         $fecha_inicio->format('d/m/Y');
     
        $fecha_fin = DateTime::createFromFormat('d/m/Y', $fin);
     } catch (Exception $ex) {
        echo $ex->getMessage();
     }
      
     var_dump($ini);
     var_dump($fin);
     
     
     //condicional para validar la fecha de inicio, con la fecha de fin
        
        $fecha_ini = strtotime($ini);
        $fecha_fi =  strtotime($fin);
        
        if($fecha_ini < $fecha_fi){
            
        echo 'Las Fechas Son correctas';
        $calendario_objeto = new Application_Model_calendar();
        $calendario_objeto->setannio($annio);
        $calendario_objeto->setperiodo($per);
        $calendario_objeto->setfecha_inicio($fecha_inicio);
        $calendario_objeto->setfecha_fin($fecha_fin);
         // var_dump($calendario_objeto);
        $this->em->persist($calendario_objeto);
        //Ejecuta la Orden de guardar..
        $this->em->flush(); 
           
                
        }  else {
           header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        } 
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad    
        
    }
     public function editarcalendarAction() { 
       //le paso el id, por petición Ajax
      $calendario_id =$this->_getParam('id');
      //Preparo la Consulta....
      $dql="select c from Application_Model_calendar c where c.id=:calendario";
      //Crear el query para que se guarde la consulta...
      $query= $this->em->createQuery($dql);
      //Se guarde el id de calendario..
      $query->setParameter('calendario', $calendario_id);
      //muestre el resultado en un array...
      $calendario =$query->getArrayResult();
      
      //Pasarle a la Vista la informción de la Calendario
      $this->view->calendario= $calendario;
      
         
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
     $this->view->headScript()->appendFile('/admin/calendario.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
    }
    public function actualizarcalendarAction(){
   //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
       //Recibir id como parametro
     $ide= $this->_getParam('ide');   
     //Se hace un condicional que el id es mayor que cero
     if($ide>0){
      //Proceso a editar
       //$facultad recibe los datos que se les pasa por petición ajax
     $annio =$this->_getParam('annio');  
     $per =$this->_getParam('per');
     $ini =$this->_getParam('ini');
     var_dump($ini);
     $fin =$this->_getParam('fin');
     try{
         //formato para convertir string a datetime
         $fecha_inicio = new DateTime($ini);
         $fecha_fin = new DateTime($fin);
         $fecha_inicio->format('d/m/Y');  
         $fecha_fin->format('d/m/Y'); 
         //variables para comparar fechas 
          $fecha_ini = strtotime($ini);
          $fecha_fi =  strtotime($fin);
          
       if($fecha_ini < $fecha_fi){
           
        echo 'Las Fechas Son correctas';   
        // Almacena en el objecto del calendario que tiene el id..
     $calendario_objeto = ($this->em->getRepository('Application_Model_calendar')->find($ide));
     //la instancia le asigna una facultad, hacer el nombre de la facultad..
     $calendario_objeto->setannio($annio);
     $calendario_objeto->setperiodo($per);
     $calendario_objeto->setfecha_inicio($fecha_inicio);
     $calendario_objeto->setfecha_fin($fecha_fin);
     //da la orden de guardar...
     $this->em->persist($calendario_objeto);
     var_dump($calendario_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush();  
       }  else {
         header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);  
       } 
     } catch (Exception $ex) {
        echo $ex->getMessage();
     }
      var_dump($ini);
      var_dump($fin);
     
         
     }      
    }
    
  
  public function eliminarcalendarAction(){
   //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
    $this->_helper->layout->disableLayout();
    //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
    $this->_helper->viewRenderer->setNoRender(TRUE); 
    
    try {
         //Recibo los parametros por Ajax
    $calendario_id= $this->_getParam('calendario_id');
    
    //meto el id en un objeto
    $calendario_objeto= ($this->em->getRepository('Application_Model_calendar')->find($calendario_id));
    
    // da la orden de eliminar
     $this->em->remove($calendario_objeto);
     
     //Ejecuta la Orden de Guardar
     $this->em->flush();
    } catch (Exception $ex) {
       //Mensaje de Error en el Servidor  
      header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);   
        
    } 
    }
   
}



