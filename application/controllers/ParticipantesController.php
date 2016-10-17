<?php

class ParticipantesController extends Zend_Controller_Action
{
    // Entity Manager
    private $em;

    public function init()
    {
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
       
        
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
   
   
    public function guardarparticipanteAction(){
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
      // Realizamos la consulta dql, para que se listen los Programas, en la vista Agregar Asignatura..
     $dql ="select p from Application_Model_Programas p";
        
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $programas = $query->getArrayResult();
        
        // Pasarle la información de programas a la vista ..
        $this->view->programas= $programas; 
    
     //Recibo los parametros por ajax, para participante Docente...
     
     try {
     $doce= $this->_getParam('doce');
     var_dump($doce);
     $docente= $this->_getParam('docente');
     var_dump($docente);
     $tipo_docente= $this->_getParam('tipo_docente');
     var_dump($tipo_docente);
     $programa= $this->_getParam('programa');
     
      $participante_objeto = new Application_Model_Participantes();
      $participante_objeto->setnombre($doce);
      $participante_objeto-> setidentificacion($docente);
      $participante_objeto-> settipo_participante($tipo_docente);
      $participante_objeto->setid_programa($this->em->getRepository('Application_Model_Programas')->find($programa));
      
      //recibo los parametros por ajax, para participante Auxiliares..
    /**  $aux= $this->_getParam('aux');
      var_dump($aux);
      $auxiliar= $this->_getParam('auxiliar');
      var_dump($auxiliar);
      $tipo_auxiliar= $this->_getParam('tipo_auxiliar');
      var_dump($tipo_auxiliar);
      $program= $this->_getParam('program'); 
      
      $participante_objeto-> setnombre($aux);
      $participante_objeto->setidentificacion($auxiliar);
      $participante_objeto->settipo_participante($tipo_auxiliar);
      $participante_objeto->setid_programa($this->em->getRepository('Application_Model_Programas')->find($program));
      
      //Recibo los parametros por ajax, para el participante asesor..
      $ase= $this->_getParam('ase');
      var_dump($ase);
      $asesor= $this->_getParam('asesor');
      var_dump($asesor);
      $tipo_asesor= $this->_getParam('tipo_asesor');
      var_dump($tipo_asesor);
      $progra= $this->_getParam('progra');
      
      $participante_objeto->setnombre($ase);
      $participante_objeto->setidentificacion($asesor);
      $participante_objeto->settipo_participante($tipo_asesor);
      $participante_objeto->setid_programa($this->em->getRepository('Application_Model_Programas')->find($progra)); */
      
      
      
      //da la orden de guardar...
     $this->em->persist($participante_objeto);
     var_dump($participante_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush(); 
         
     } catch (Exception $e) {
         echo $e->getMessage();
         
     }
        
    }
    
   
    
}



