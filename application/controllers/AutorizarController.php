<?php

class AutorizarController extends Zend_Controller_Action{
    // Entity Manager
    private $em;

    public function init(){
        // Activar el Entity Manager
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        
        
        
    }

    public function indexAction(){
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
     $this->_helper->layout->disableLayout();
     //Le dice a las acciones que no se muestre en la vista html, sino que va a mostrar otro tipo de información
    $this->_helper->viewRenderer->setNoRender(TRUE);    
    $authNamespace = new Zend_Session_Namespace('Zend_Auth');
    $authNamespace->setExpirationSeconds('60');
    
    //Creo un swich para que me controle todas los roles
  // var_dump($authNamespace->usuarios[0]['id_rol']['id_rol']);
    switch ($authNamespace->usuarios[0]['id_rol']['id_rol']){
        case "1": 
            $this->_redirect('/inicio/admin');
            break;
        case "2": 
            echo "hola";
            $this->_redirect('/inicio/logistica');
            break;
        case "3": 
            echo "hola";
            $this->_redirect('/inicio/financiera');
            break;
        case "4":
            $this->_redirect('/inicio/departamento');
            break;
    }
    
  
          
    
    
    }
    
   
    
   
}



