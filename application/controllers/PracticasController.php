<?php

class PracticasController extends Zend_Controller_Action
{
    // Entity Manager
    private $em;
    private $pw;
    private $ka;

    public function init()
    {
        /* Initialize action controller here */
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        $this->pw= $registry->powercampus_connection;
        $this->ka= $registry->kactus_connection;
    }

    public function indexAction()
    {
       // para que todo lo que este dentro de este metodo se ejecute en todas las Vistas..
    }
    
    public function agregarpracticaAction(){ 
     //Mantego la sesion en la pagina de agregar practica
      // $authNamespace = new Zend_Session_Namespace('Zend_Auth');
     // llamo la session
         $authNamespace = new Zend_Session_Namespace('Zend_Auth');
         //saco los datos del usuario
         $usuario= $authNamespace->usuarios;
         $rol= $authNamespace->usuarios[0]['id_rol']['id_rol'];
           $this->view->rol= $rol;
        // var_dump($rol);
      try{
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
        //visualizo los docentes responsables
         $docentes= array();
        $sql = "SELECT DISTINCT KACTUS.dbo.VIEW_SIPA.ape_empl AS ape, KACTUS.dbo.VIEW_SIPA.nom_empl AS nom FROM KACTUS.dbo.VIEW_SIPA ORDER BY ape_empl";
          $stmt = sqlsrv_query( $this->ka, $sql);
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              //para quitar las tildes
          $row['ape']= htmlentities(utf8_encode($row['ape']));
          $row['nom']= htmlentities(utf8_encode($row['nom']));
         // $row['Id_Programa']= htmlentities(utf8_encode($row['Id_Programa']));
          $docentes[]= $row;   
         // var_dump($row);
          // $row['ID_Facultad'].", ".$row['Facultad'].", ".$row['Departamento'].", ".$row['Programa'].", ".$row['ID_Departamento']."<br />";
         // var_dump($row);
       }
       sqlsrv_free_stmt( $stmt);
       $this->view->docentes= $docentes;
       //.................................//
      
         //hago un condicional
         if($rol == 1){
            //preparo la consulta de facultades
         $sql = "SELECT V_Facultades.ID AS id_facultad, V_Facultades.Facultad AS nombre  FROM V_Facultades  ORDER BY ID";
          $stmt = sqlsrv_query( $this->pw, $sql );
         $datos = array();
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
           $datos[]= $row;   
         // echo $row['ID'].", ".$row['Facultad']."<br />";
         //var_dump($row);
       }
      // var_dump($datos);
       sqlsrv_free_stmt( $stmt);
        
         $this->view->facultad= $datos;  
         }else {
             if($rol== 4){
         $datoss = array(); 
         // var_dump($datoss);
          //preparo la consulta para obtener la facultad asociada al programa..
         $sql = "SELECT DISTINCT V_Facultades.Facultad as nombre, V_Facultades.ID as id_facultad FROM V_Departamentos INNER JOIN  V_Facultades ON V_Departamentos.ID_Facultad=V_Facultades.ID INNER JOIN V_Programas ON V_Departamentos.ID_Departamento=V_Programas.ID_Departamento where V_Programas.ID_Programa= ?";
          $stmt = sqlsrv_query( $this->pw, $sql, array($authNamespace->programa[0]["cod_progra_power"]));
         $authNamespace->programa;
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          
        //  $row['ID_Facultad']= htmlentities(utf8_encode($row['ID_Facultad']));  
        //  $row['Facultad']= htmlentities(utf8_encode($row['Facultad']));
        //  $row['Departamento']= htmlentities(utf8_encode($row['Departamento']));
        //  $row['Programa']= htmlentities(utf8_encode($row['Programa']));
        //  $row['ID_Departamento']= htmlentities(utf8_encode($row['ID_Departamento']));
         
           $datoss[]= $row;   
         // echo $row['ID'].", ".$row['Facultad']."<br />";
         //var_dump($row);
       }
      // var_dump($datos);
       sqlsrv_free_stmt( $stmt);
        
         $this->view->facultad= $datoss;
      
       
        // var_dump($rol);           
             }
             }
         
        
        
 
        // Preparo la consulta de Asignaturas
        $dql5= "select a from Application_Model_Asignaturas a";
         // Ejecutamos la consulta con Query
         $query5 = $this->em->createQuery($dql5);
        
       //Resultados de la consulta en un Vector, en este caso en Array
       $asignatura = $query5->getArrayResult();
       
      // Pasarle la información de programas a la vista ..
       $this->view->asignatura =$asignatura;
       
       //Preparo la consulta dql
       $dql6= "select c, a, p from Application_Model_calendar c left join c.id_annio a left join c.id_periodo p where c.estado=:estado";                                                                                      
       
       $query6 = $this->em->createQuery($dql6);
       
       $query6->setParameter('estado', '1');
       
       //muestre el resultado en un array...
      $calendario =$query6->getArrayResult();
      
      //Pasarle a la Vista la informción de la Calendario
      $this->view->calendario= $calendario;
      
        //Preparo la consulta dql
      $dql7= "select r from Application_Model_Rutas r";
       
       $query7 = $this->em->createQuery($dql7);
       
       //muestre el resultado en un array...
      $rutas =$query7->getArrayResult();
      
      //Pasarle a la Vista la informción de la Calendario
      $this->view->rutas= $rutas; 
      
        //Preparo la consulta dql
      $dql8= "select r from Application_Model_Recurespeciales r";
       
       $query8 = $this->em->createQuery($dql8);
       
       //muestre el resultado en un array...
      $recursos =$query8->getArrayResult();
      
      //Pasarle a la Vista la informción de la Calendario
      $this->view->recursos= $recursos; 
        
          
      }  catch (Exception $e){
          echo $e->getMessage();
      }
       
        
        
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
     $this->view->headScript()->appendFile('/practica/progrecurso.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
     $this->view->headScript()->appendFile('/validacion/bootbox.min.js');

    }
    public function listarpracticaAction(){ 
         // llamo la session
         $authNamespace = new Zend_Session_Namespace('Zend_Auth');
         //saco los datos del usuario
         $usuario= $authNamespace->usuarios;
         $rol= $authNamespace->usuarios[0]['id_rol']['id_rol'];
         
         $this->view->rol= $rol;
        
    //preparo la consulta, para extraer la información de la tabla práctica..
        $dql= "select p, pro, pa, cal, asigna from Application_Model_Practicas p join p.programaciones pro join pro.participantes pa join p.id_calendario cal join p.cod_asignatura asigna order by p.cod_practica";
        
        $query = $this->em->createQuery($dql);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $practicas = $query->getArrayResult();   
        //Pasarle a la Vista la informción a listar práctica
        $this->view->practicas= $practicas;
        
     //preparo la consulta, para extraer la información de la tabla práctica..
        $dql1= "select pro from Application_Model_Programacion pro";
        
        $query1 = $this->em->createQuery($dql1);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $programacion = $query1->getArrayResult();   
        //Pasarle a la Vista la informción a listar programacion
        $this->view->programacion= $programacion;  
        
        $dql2= "select p from Application_Model_Participantes p where p.tipo_participante=:docente";
         
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query2 = $this->em->createQuery($dql2);
        $query2->setParameter('docente', 'docente'); 
        //Resultados de la consulta en un Vector, en este caso en Array
         $participantes = $query2->getArrayResult();
       // var_dump($participantes);
        // Pasarle la información de programas a la vista..
        $this->view->participantes= $participantes;
        
        
        //realizamos una consulta dql, para que se listen los participantes auxiliares
        $dql3= "select p from Application_Model_Participantes p where p.tipo_participante=:auxiliar";
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query3 = $this->em->createQuery($dql3);
        $query3->setParameter('auxiliar', 'auxiliar'); 
        //Resultados de la consulta en un Vector, en este caso en Array
         $participantess = $query3->getArrayResult();
       // var_dump($participantes);
        // Pasarle la información de programas a la vista..
        $this->view->participantess= $participantess;
        
         //Realizamos Una Consulta dql, Para que listen los participantes Asesores
         $dql4= "select p from Application_Model_Participantes p where p.tipo_participante=:asesor";
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query4 = $this->em->createQuery($dql4);
        $query4->setParameter('asesor', 'asesor'); 
        //Resultados de la consulta en un Vector, en este caso en Array
         $participante = $query4->getArrayResult();
       // var_dump($participantes);
        // Pasarle la información de programas a la vista..
        $this->view->participante= $participante;
        
                
     
     
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
     $this->view->headScript()->appendFile('/validacion/bootbox.min.js');
    
    }
    public function guardarpracticaAction(){
    //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     //Recibo los parametros por petición ajax
     $datos= $this->_getParam('datos');
     parse_str($datos, $output);
    // var_dump($output);
     $programacion= $this->_getParam('programacion');
    // var_dump($programacion);
      try {
     
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
     $practica_objeto->setid_calendario($this->em->getRepository('Application_Model_calendar')->find($output['cal']));
     $practica_objeto->setcod_asignatura($this->em->getRepository('Application_Model_Asignaturas')->find($output['asigna']));
     $practica_objeto->setid_facultad($this->em->getRepository('Application_Model_Facultades')->find($output['fac']));
     $practica_objeto->setid_programa($this->em->getRepository('Application_Model_Programas')->find($output['pro']));        
    // var_dump($practica_objeto);
     foreach ($programacion as $valor){
        // var_dump($valor);
         $programacion_objeto= new Application_Model_Programacion();
         $programacion_objeto->setcod_practica($practica_objeto);
         $programacion_objeto->setnum_dias($valor['0']);
         $programacion_objeto->setrecorrido($valor['1']);
         $programacion_objeto->setdepartamental($valor['2']);
         $fecha_salida= DateTime::createFromFormat('d/m/Y', $valor['3']);
         var_dump($valor['3']);
         $programacion_objeto->setfecha_salida($fecha_salida);
         $programacion_objeto->setlugar_encuentro($valor['4']);
         $programacion_objeto->setdias_pernoctados($valor['5']);
         $fecha_llegada= DateTime::createFromFormat('d/m/Y', $valor['6']);
         $programacion_objeto->setfecha_llegada($fecha_llegada);
       //  $programacion_objeto->settipo($valor['6']);
        // $programacion_objeto->setvalor($valor['7']);
         $programacion_objeto->setobservaciones($valor['11']);
         //declaro una variable
          $recursos= explode(",", $valor['7']);
          foreach ($recursos as $r){
          $programacion_objeto->getrecursos()->add($this->em->getRepository('Application_Model_Progrecursos')->find($r));    
          }
          
         $programacion_objeto->getparticipantes()->add($this->em->getRepository('Application_Model_Participantes')->find($valor['8']));
         $programacion_objeto->getparticipantes()->add($this->em->getRepository('Application_Model_Participantes')->find($valor['9']));
         $programacion_objeto->getparticipantes()->add($this->em->getRepository('Application_Model_Participantes')->find($valor['10']));
         $practica_objeto->getprogramaciones()->add($programacion_objeto);
         
         //da la orden de guardar...
            $this->em->persist($practica_objeto);
       //Ejecuta la Orden de guardar..
           $this->em->flush();
       
        }  
     
      } catch (Exception $ex) {
         echo $ex->getMessage();  
     
     }
     
     //Hacer el ciclo para guardar las programaciones...
    
         
    
   
    }
    
 public function editarpracticaAction(){
  
      //Preparo la consulta dql
       $dql= "select c from Application_Model_calendar c";
       
       $query = $this->em->createQuery($dql);
       
       //muestre el resultado en un array...
      $calendario =$query->getArrayResult();
      
      //Pasarle a la Vista la informción de la Calendario
      $this->view->calendario= $calendario;
      
   //capturo el id de la facultad
         $practica_id =$this->_getParam('id');
       //  var_dump($practica_id);
         //Realizo la consulta para obtener el codigo de la facultad...
         $dql1= "select p, cal from Application_Model_Practicas p join p.id_calendario cal where p.cod_practica=:practica";
         //Crear el query para que se guarde la consulta...
         $query1= $this->em->createQuery($dql1);
         //Se guarde el id de facultad..
         $query1->setParameter('practica', $practica_id);
         //muestre el resultado en un array...
       
        $practicas = $query1->getArrayResult();   
        //Pasarle a la Vista la informción a listar práctica
        $this->view->practicas= $practicas;    
     
            // Realizamos la consulta dql, para que se listen los Programas, en la vista Agregar Asignatura..
     $dql2 ="select p from Application_Model_Programas p";
        
         // Ejecutar el Query, la variable query es donde se carga la consulta.
        $query2 = $this->em->createQuery($dql2);
        
        //Resultados de la consulta en un Vector, en este caso en Array
        $programas = $query2->getArrayResult();
        
        // Pasarle la información de programas a la vista ..
        $this->view->programas= $programas; 
        
         //preparo la consulta de facultades
        $dql3= "select fa from Application_Model_Facultades fa";
        
        $query3= $this->em->createQuery($dql3);
        
        $facultad =  $query3->getArrayResult();
        
        $this->view->facultad= $facultad;
        
        // Preparo la consulta de Asignaturas
        $dql4= "select a from Application_Model_Asignaturas a";
         // Ejecutamos la consulta con Query
         $query4 = $this->em->createQuery($dql4);
        
       //Resultados de la consulta en un Vector, en este caso en Array
       $asignatura = $query4->getArrayResult();
       
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
     $this->view->headScript()->appendFile('/practica/progrecurso.js');
     $this->view->headScript()->appendFile('/js/jquery.dataTables.min.js');
     $this->view->headScript()->appendFile('/js/bootstrap-modal.js');
     $this->view->headScript()->appendFile('/validacion/jquery.validate.min.js');
     $this->view->headScript()->appendFile('/validacion/localization/messages_es.min.js');
     $this->view->headScript()->appendFile('/validacion/additional-methods.min.js');
     $this->view->headScript()->appendFile('/validacion/bootbox.min.js');     
     
 }
 public function actualizarpracticaAction(){
          //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->viewRenderer->setNoRender(TRUE);
     
     //Recibir id como parametro
     $id= $this->_getParam('id'); 
     
     //Se hace un condicional que el id es mayo que cero
     if($id>0){
     //$usuario recibe los datos que se les pasa por petición ajax
     $nom =$this->_getParam('nom');
     $ape =$this->_getParam('ape');
     $ide =$this->_getParam('ide');
     $correo =$this->_getParam('correo');
     $usuario =$this->_getParam('usuario');
    // $pass =$this->_getParam('pass');
     $programa =$this->_getParam('programa');
     $rol =$this->_getParam('rol');
     
     // Almacena en el objecto usuario que tiene el id..
     $usuario_objeto= ($this->em->getRepository('Application_Model_Usuarios')->find($id));
     $usuario_objeto->setnombre($nom);
     $usuario_objeto->setapellidos($ape);
     $usuario_objeto->setidentificacion($ide);
     $usuario_objeto->setcorreo($correo);
     $usuario_objeto->setusuario($usuario);
     $usuario_objeto->setcod_programa($this->em->getRepository('Application_Model_Programas')->find($programa));
     $usuario_objeto->setid_rol($this->em->getRepository('Application_Model_Roles')->find($rol));
    // var_dump($usuario_objeto);
     
     $this->em->persist($usuario_objeto);
     //Ejecuta la Orden de guardar..
     $this->em->flush();
     } 
   $this->view->headScript()->appendFile('/admin/practicas.js');
          
    }
    public function obtenerprogramasAction(){
        header('Content-Type: application/json'); 
       $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
       $this->_helper->viewRenderer->setNoRender(TRUE);  
         
         $departamento= $this->getParam('departamento');
          // llamo la session
         $authNamespace = new Zend_Session_Namespace('Zend_Auth');
         //saco los datos del usuario
         $usuario= $authNamespace->usuarios;
         $rol= $authNamespace->usuarios[0]['id_rol']['id_rol'];
         
        //realizo la validacion para obtener el programa asociado al departamento
         if($rol == 1){
           $programas= array();
         $sql = "SELECT * FROM V_Departamentos INNER JOIN  V_Facultades ON V_Departamentos.ID_Facultad=V_Facultades.ID INNER JOIN V_Programas ON V_Departamentos.ID_Departamento=V_Programas.ID_Departamento where V_Departamentos.ID_Departamento= ?";
          $stmt = sqlsrv_query( $this->pw, $sql,  array($departamento));
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              //para quitar las tildes
          $row['ID_Facultad']= htmlentities(utf8_encode($row['ID_Facultad']));  
          $row['Facultad']= htmlentities(utf8_encode($row['Facultad']));
          $row['Departamento']= htmlentities(utf8_encode($row['Departamento']));
          $row['Programa']= htmlentities(utf8_encode($row['Programa']));
          $row['ID_Departamento']= htmlentities(utf8_encode($row['ID_Departamento']));
          $programas[]= $row;    
          // $row['ID_Facultad'].", ".$row['Facultad'].", ".$row['Departamento'].", ".$row['Programa'].", ".$row['ID_Departamento']."<br />";
         // var_dump($row);
       }
       echo json_encode($programas);
      
       sqlsrv_free_stmt( $stmt);   
         }else{
             if($rol == 4){
                 
            $programas = array(); 
            //preparo la consulta para obtener la facultad asociada al programa..
             $sql = "SELECT V_Programas.ID_Programa AS ID_Programa, V_Programas.Programa AS Programa FROM V_Departamentos INNER JOIN  V_Programas ON V_Departamentos.ID_Departamento=V_Programas.ID_Departamento WHERE V_Programas.ID_Programa= ?";
            $stmt = sqlsrv_query($this->pw, $sql, array($authNamespace->programa[0]["cod_progra_power"]));
            $authNamespace->programa;
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
         
            $row['Programa']= htmlentities(utf8_encode($row['Programa']));
            $row['ID_Programa']= htmlentities(utf8_encode($row['ID_Programa']));
         
            $programas[]= $row;   
       }
    
         sqlsrv_free_stmt( $stmt);
       
         echo json_encode($programas);   
                 
             }
         }     
            
    }
    public function obtenerdepartamentoAction(){
         header('Content-Type: application/json'); 
        $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
       $this->_helper->viewRenderer->setNoRender(TRUE);  
        //recibo el departamento por peticiòn ajax
        $id_facultad= $this->getParam('facultad');
    
       // llamo la session
         $authNamespace = new Zend_Session_Namespace('Zend_Auth');
         //saco los datos del usuario
         $usuario= $authNamespace->usuarios;
         $rol= $authNamespace->usuarios[0]['id_rol']['id_rol'];
        if($rol == 1){
            //declaro el vector de los departamentos
        $departamentos= array();
       // var_dump($departamentos);
        $sql = "SELECT V_Departamentos.ID_Departamento AS ID, V_Departamentos.Departamento AS Departa, V_Departamentos.ID_Facultad As id_fa  FROM V_Departamentos where V_Departamentos.ID_Facultad= ?";
          $stmt = sqlsrv_query( $this->pw, $sql,  array($id_facultad));
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
              //para quitar las tildes
          $row['Departa']= htmlentities(utf8_encode($row['Departa']));
          $row['ID']= htmlentities(utf8_encode($row['ID']));
          $row['id_fa']= htmlentities(utf8_encode($row['id_fa']));
          $departamentos[]= $row;   
         // var_dump($row);
          // $row['ID_Facultad'].", ".$row['Facultad'].", ".$row['Departamento'].", ".$row['Programa'].", ".$row['ID_Departamento']."<br />";
         // var_dump($row);
       }
       echo json_encode($departamentos);
      
       sqlsrv_free_stmt( $stmt);
        }  else {
            if($rol == 4){
          try{        
          $departamento = array(); 
        // var_dump($departamento);
          //preparo la consulta para obtener la facultad asociada al programa..
         $sql = "SELECT V_Departamentos.Departamento as Departa, V_Departamentos.ID_Departamento as ID FROM V_Departamentos INNER JOIN  V_Facultades ON V_Departamentos.ID_Facultad=V_Facultades.ID INNER JOIN V_Programas ON V_Departamentos.ID_Departamento=V_Programas.ID_Departamento where V_Programas.ID_Programa= ?";
         $stmt = sqlsrv_query($this->pw, $sql, array($authNamespace->programa[0]["cod_progra_power"]));
          $authNamespace->programa;
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
         
          $row['Departa']= htmlentities(utf8_encode($row['Departa']));
          $row['ID']= htmlentities(utf8_encode($row['ID']));
         
           $departamento[]= $row;   
        
       }
      // var_dump($datos);
       sqlsrv_free_stmt( $stmt);
       
         echo json_encode($departamento);
       
       
        
      
        // var_dump($departamento);
                    
                } catch (Exception $e) {
                echo $e->getMessage();    
                }   
                
            }
        }
         
    }
    public function obtenersemestreAction(){
         header('Content-Type: application/json'); 
        $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
       $this->_helper->viewRenderer->setNoRender(TRUE);  
        //recibo el departamento por peticiòn ajax
        $id_programa= $this->getParam('programas');
       // var_dump($id_facultad);
        //declaro el vector de los departamentos
        $semestre= array();
        $sql = "SELECT DISTINCT V_Asignaturas.Semestre AS sem FROM  V_Asignaturas where Id_Programa= ? ORDER BY Semestre";
          $stmt = sqlsrv_query( $this->pw, $sql,  array($id_programa));
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              //para quitar las tildes
          $row['sem']= htmlentities(utf8_encode($row['sem']));
          
          $semestre[]= $row;   
         // var_dump($row);
          // $row['ID_Facultad'].", ".$row['Facultad'].", ".$row['Departamento'].", ".$row['Programa'].", ".$row['ID_Departamento']."<br />";
         // var_dump($row);
       }
       echo json_encode($semestre);
      
       sqlsrv_free_stmt( $stmt);
        
    }
     public function obtenerasignaturaAction(){
         header('Content-Type: application/json'); 
        $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
       $this->_helper->viewRenderer->setNoRender(TRUE);  
        //recibo el departamento por peticiòn ajax
        $semestre= $this->getParam('semestre');
        $id_programa= $this->getParam('programa');
       // var_dump($id_programa);
      
       // var_dump($id_facultad);
        //declaro el vector de los departamentos
        $asignatura= array();
        $sql = "SELECT DISTINCT V_Asignaturas.Id_Asignatura AS id_asigna, V_Asignaturas.Asignatura AS asigna FROM V_Asignaturas WHERE Semestre= ? AND Id_Programa= ?";
          $stmt = sqlsrv_query( $this->pw, $sql,  array($semestre, $id_programa));
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              //para quitar las tildes
          $row['asigna']= htmlentities(utf8_encode($row['asigna']));
          $row['id_asigna']= htmlentities(utf8_encode($row['id_asigna']));
         // $row['Id_Programa']= htmlentities(utf8_encode($row['Id_Programa']));
          $asignatura[]= $row;   
         // var_dump($asignatura);
          // $row['ID_Facultad'].", ".$row['Facultad'].", ".$row['Departamento'].", ".$row['Programa'].", ".$row['ID_Departamento']."<br />";
         // var_dump($row);
       }
       echo json_encode($asignatura);
      
       sqlsrv_free_stmt( $stmt);
        
    }
     public function obtenergruposAction(){
         header('Content-Type: application/json'); 
        $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
       $this->_helper->viewRenderer->setNoRender(TRUE);  
        //recibo el departamento por peticiòn ajax
        try {
            $asignatura= $this->getParam('asignatura');
        
      // var_dump($asignatura);
        $grupos= array();
      $sql = "SELECT V_Grupos.Grupo AS gru FROM V_Grupos WHERE V_Grupos.ID_Asignatura=?";
          $stmt = sqlsrv_query( $this->pw, $sql,  array($asignatura));
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              //para quitar las tildes
          $row['gru']= htmlentities(utf8_encode($row['gru']));
        
          $grupos[]= $row;   
         // var_dump($row);
         
       }
       echo json_encode($grupos);
      
       sqlsrv_free_stmt( $stmt);
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
     public function obtenermatriculadosAction(){
         header('Content-Type: application/json'); 
        $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
       $this->_helper->viewRenderer->setNoRender(TRUE);  
        //recibo el departamento por peticiòn ajax
        $grupo= $this->getParam('grupo');
        
      // var_dump($asignatura);
      
       // var_dump($id_facultad);
        //declaro el vector de los departamentos
        $matriculados= array();
       // $sql = "SELECT V_Grupos.Matriculados AS mat FROM V_Grupos WHERE V_Grupos.ID_Asignatura=?";
        $sql = "SELECT V_Grupos.Matriculados AS mat FROM V_Grupos WHERE V_Grupos.Grupo= ?";
          $stmt = sqlsrv_query( $this->pw, $sql,  array($grupo));
          //var_dump($sql);
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              //para quitar las tildes
          $row['mat']= htmlentities(utf8_encode($row['mat']));
         // $row['ID_Asignatura']= htmlentities(utf8_encode($row['ID_Asignatura']));
         // $row['Id_Programa']= htmlentities(utf8_encode($row['Id_Programa']));
          $matriculados[]= $row;   
         // var_dump($row);
          // $row['ID_Facultad'].", ".$row['Facultad'].", ".$row['Departamento'].", ".$row['Programa'].", ".$row['ID_Departamento']."<br />";
         // var_dump($row);
       }
       echo json_encode($matriculados);
      
       sqlsrv_free_stmt( $stmt);
        
    }
  
}



