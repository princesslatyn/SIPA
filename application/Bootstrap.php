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

}

