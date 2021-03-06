<?php

class LiquiconductorController extends Zend_Controller_Action
{
    // Entity Manager
    private $em;

    public function init()
    {
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        
         $this->_helper->layout->setLayout('prueba');
         $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
         $this->view->headLink()->appendStylesheet('/css/facultad.css');
        
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
    public function agregarliquiconductorAction(){ 
        
       //Consulta dql para listar las facultades
        $dql ="select pro, p from Application_Model_Programacion pro join pro.cod_practica p";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $programacion = $query->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->programacion= $programacion;
        
        $dql1= "select p, f, prog from Application_Model_Practicas p join p.id_facultad f join p.id_programa prog";
        
        $query1 = $this->em->createQuery($dql1);
        
        $practicas = $query1->getArrayResult();
        
        $this->view->practicas= $practicas; 
        
        $dql2= "select l, v, c from Application_Model_Liquiconductores l join l.cod_transporte v join l.id_conductor c";
        
        $query2= $this->em->createQuery($dql2);
        
        $liquidarconductor = $query2->getArrayResult();
        
        $this->view->liquidarconductor= $liquidarconductor;
        
        //preparo la consulta para extraer los conductores..
        $dql3= "select c from Application_Model_Conductores c";
        
        $query3= $this->em->createQuery($dql3);
        
        $conductor = $query3->getArrayResult();
        
        $this->view->conductor =$conductor; 
        
        //Preparo la consulta de los vehiculos
        $dql4= "select t from Application_Model_Transporte t";
        
        $query4= $this->em->createQuery($dql4);
        
        $transporte = $query4->getArrayResult();
        
        $this->view->transporte = $transporte;
        
         $dql5= "select p from Application_Model_Practicas p";
        
        $query5 = $this->em->createQuery($dql5);
        
        $practica = $query5->getArrayResult();
        
        $this->view->practica= $practica;
        
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
     $this->view->headScript()->appendFile('/logistica/liquidarconductor.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
    }
    public function listarliquiconductorAction()
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
      $this->view->headScript()->appendFile('/logistica/liquidarconductor.js');
      $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
      $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
      $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
      $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
      
    }
    public function listarproliquiconductorAction(){ 
       
        
        //Consulta dql para listar las facultades
        $dql ="select pro, p from Application_Model_Programacion pro join pro.cod_practica p";
        
        // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $programacion = $query->getArrayResult();
        
        //Imprimir en la pagina lo que esta en la variable en este caso facultades
       // var_dump($facultades);
        //Pasarle a la Vista la informción de la facultad
        $this->view->programacion= $programacion;
        
      
      $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
      $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
      $this->view->headLink()->appendStylesheet('/css/facultad.css');
      $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
      $this->view->headScript()->appendFile('/js/facultad.js');
      $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
      $this->view->headScript()->appendFile('/logistica/liquidarconductor.js');
      $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
      $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
      $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
      $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
      
    }
    public function guardarliquiconductorAction(){
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
     public function editarliquiconductorAction() { 
       
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
        
         //preparo la consulta para extraer los conductores..
        $dql3= "select c from Application_Model_Conductores c";
        
        $query3= $this->em->createQuery($dql3);
        
        $conductor = $query3->getArrayResult();
        
        $this->view->conductor =$conductor; 
         
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
    public function actualizarliquiconductorAction(){
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
      public function eliminarliquiconductorAction(){
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



