<?php

class PracticasController extends Zend_Controller_Action
{
    // Entity Manager
    private $em;

    public function init()
    {
        /* Initialize action controller here */
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
    public function agregarpracticaAction(){ 
         // Realizamos la consulta dql, para que se listen los Programas, en la vista Agregar Asignatura..
     $dql ="select p from Application_Model_Programas p";
        
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $programas = $query->getArrayResult();
        
        // Pasarle la información de programas a la vista ..
        $this->view->programas= $programas; 
        //Realizamos la consulta dql, para que me liste los participantes docentes...
        $dql1= "select p from Application_Model_Participantes p where p.tipo_participante=:docente";
         
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query1 = $this->em->createQuery($dql1);
        $query1->setParameter('docente', 'docente'); 
        //Resultados de la consulta en un Vector, en este caso en Array
         $participantes = $query1->getArrayResult();
       // var_dump($participantes);
        // Pasarle la información de programas a la vista..
        $this->view->participantes= $participantes;
        
        
        //realizamos una consulta dql, para que se listen los participantes auxiliares
        $dql2= "select p from Application_Model_Participantes p where p.tipo_participante=:auxiliar";
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query2 = $this->em->createQuery($dql2);
        $query2->setParameter('auxiliar', 'auxiliar'); 
        //Resultados de la consulta en un Vector, en este caso en Array
         $participantess = $query2->getArrayResult();
       // var_dump($participantes);
        // Pasarle la información de programas a la vista..
        $this->view->participantess= $participantess;
        
         //Realizamos Una Consulta dql, Para que listen los participantes Asesores
         $dql3= "select p from Application_Model_Participantes p where p.tipo_participante=:asesor";
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query3 = $this->em->createQuery($dql3);
        $query3->setParameter('asesor', 'asesor'); 
        //Resultados de la consulta en un Vector, en este caso en Array
         $participante = $query3->getArrayResult();
       // var_dump($participantes);
        // Pasarle la información de programas a la vista..
        $this->view->participante= $participante;
        
         //preparo la consulta de facultades
        $dql4= "select fa from Application_Model_Facultades fa";
        
        $query4= $this->em->createQuery($dql4);
        
        $facultad =  $query4->getArrayResult();
        
        $this->view->facultad= $facultad;
        
        // Preparo la consulta de Asignaturas
        $dql5= "select a from Application_Model_Asignaturas a";
         // Ejecutamos la consulta con Query
         $query5 = $this->em->createQuery($dql5);
        
       //Resultados de la consulta en un Vector, en este caso en Array
       $asignatura = $query5->getArrayResult();
       
      // Pasarle la información de programas a la vista ..
       $this->view->asignatura =$asignatura;
        
       
        
        
     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/fuelux.min.css'); 
     $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
     $this->view->headLink()->appendStylesheet('/css/font-awesome.min.css');
      $this->view->headLink()->appendStylesheet('/font-awesome/css/font-awesome.css');
//     $this->view->headLink()->appendStylesheet('/css/bootstrap-datepicker.css.map');
     $this->view->headScript()->appendFile('/js/fuelux.min.js');
     $this->view->headScript()->appendFile('/js/wizard.js');
     $this->view->headScript()->appendFile('/bootstrap/js/moment.min.js');   
     $this->view->headScript()->appendFile('/bootstrap/js/bootstrap-datepicker.js');      
     $this->view->headScript()->appendFile('/bootstrap/js/datepicker.es.min.js');
     $this->view->headScript()->appendFile('/js/practica.js');
     $this->view->headScript()->appendFile('/admin/practicas.js');
     $this->view->headScript()->appendFile('/practica/participantes.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
    }
    public function listarpracticaAction()
    { 
     
     
     $this->view->headLink()->appendStylesheet('/css/jquery.dataTables.min.css');
     $this->view->headLink()->appendStylesheet('/css/font-awesome.min.css');
     $this->view->headLink()->appendStylesheet('/css/practica.css');
     $this->view->headScript()->appendFile('/js/practica.js');
     $this->view->headScript()->appendFile('/admin/practicas.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
    }
    public function guardarpracticaAction(){
    //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     //Recibo los parametros por petición ajax
     $datos= $this->_getParam('datos');
     parse_str($datos, $output);
     var_dump($output);
     $programacion= $this->_getParam('programacion');
     var_dump($programacion);
     
     
     //encapsulo los parametros en un objeto
     $practica_objeto= new Application_Model_Practicas();
     $practica_objeto->setnombre($output['nom']);
     $practica_objeto->setnum_estudiantes($output['num']);
     $practica_objeto->setnom_solicitante($output['nombre']);
     $practica_objeto->setjustificacion($output['jus']);
     $practica_objeto->setobjetivo($output['obj']);
     $practica_objeto->setactividad_doc($output['adoc']);
     $practica_objeto->setactividad_est($output['est']);
     $practica_objeto->settipo_practica($output['tipo']);
     $practica_objeto->setsemestre($output['sem']);
     $practica_objeto->setdepartamento($output['dep']); 
     $practica_objeto->setcod_asignatura($this->em->getRepository('Application_Model_Asignaturas')->find($output['asigna']));
     $practica_objeto->setid_facultad($this->em->getRepository('Application_Model_Facultades')->find($output['fac']));
     $practica_objeto->setid_programa($this->em->getRepository('Application_Model_Programas')->find($output['pro']));        
     var_dump($practica_objeto);
     
     //Hacer el ciclo para guardar las programaciones...
     try {
         foreach ($programacion as $valor){
         var_dump($valor);
       $programacion_objeto= new Application_Model_Programacion();
       $programacion_objeto->setnum_dias($valor['num']);
       $programacion_objeto->setrecorrido($valor['reco']);
       $programacion_objeto->setfecha_salida($valor['sal']);
       $programacion_objeto->setlugar_encuentro($valor['lug']);
       $programacion_objeto->setdias_pernoctados($valor['optionsRadios']);
       $programacion_objeto->setfecha_llegada($valor['lle']);
       $programacion_objeto->settipo($valor['tipo']);
       $programacion_objeto->setvalor($valor['valor']);
       $programacion_objeto->setobservaciones($valor['obs']);
      // $programacion_objeto->setid_calendario($this->em->getRepository('Application_Model_calendar')->find($valor['cal']));
       //$programacion_objeto->setid_calendario($this->em->getRepository('Application_Model_calendar')->find($valor['optradio']));
      // $programacion_objeto->setcod_practica($this->em->getRepository('Application_Model_Practicas')->find($valor['cal']));
      var_dump($programacion_objeto);
       $practica_objeto->getprogramaciones()->add($programacion);
       //da la orden de guardar...
       $this->em->persist($programacion_objeto);
       //Ejecuta la Orden de guardar..
       $this->em->flush();
       
        }  
     } catch (Exception $ex) {
         echo $ex->getMessage();  
     
     }

    }

}



