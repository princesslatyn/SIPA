
<?php
class LogoutController extends Zend_Controller_Action{
     private $em;

    public function init(){
        /* Initialize action controller here */
        
        $registry = Zend_Registry::getInstance();
        $this->em = $registry->entitymanager;
        
        $this->_helper->layout->setLayout('admin');
    }

    public function indexAction(){
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_helper->redirector->goToUrl('/login');
    }


}
