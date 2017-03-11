<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initViewHelpers(){
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView(); 
    }
    
    public function _initDoctrine() {
        $conn = Cweb_Db_Adapter::getInstance('../application/configs/dataConnectDb.xml');
    	$registry = Zend_Registry::getInstance();
        return $registry->entitymanager;
    }
    
    public function _initRestApi(){
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $restRoute = new Zend_Rest_Route($front, array(), array(
            'api',
        ));
        $router->addRoute('rest', $restRoute);
        
    }
<<<<<<< HEAD
     public function _initPowercampus(){
     // $conexion= new Powercampus_Powercampus();
      //var_dump($conexion);
       $conn = Powercampus_Powercampus::getInstance();
        $registry = Zend_Registry::getInstance();
        return $registry->powercampus_connection;
      
    }
      public function _initKactus(){
     // $conexion= new Powercampus_Powercampus();
      //var_dump($conexion);
       $conn = Kactus_Kactus::getInstance();
        $registry = Zend_Registry::getInstance();
        return $registry->kactus_connection;
      
=======
    public function _initPowercampus(){
        $conn = Powercampus_Powercampus::getInstance();
        $registry = Zend_Registry::getInstance();
        return $registry->powercampus_connection;
        
    }
    protected function _initSession(){
      Zend_Session::start();  
        
>>>>>>> ea53688cca147df01f02867777de28e3320cccb5
    }

}

