<?php

class LoginController
    extends Zend_Controller_Action {
    
    public function init(){
        parent::init();
        
        // Disable layout/view
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
    public function indexAction(){
        
        if($this->_request->isPost()){

            // Validate login request
            if($this->_executeLogin() === Zend_Auth_Result::SUCCESS){
                $this->redirect('/profile');
            } 

        }

        // @todo: add flash messages
        $this->redirect('');
    }
    
    private function _executeLogin(){
        $auth = Zend_Auth::getInstance();
        $authAdapter = new Insta_Auth_Adapter($this->getParam('email'), $this->getParam('password'));
        $result = $auth->authenticate($authAdapter);
        return $result->getCode();
    }
        
    public function logoutAction(){
        $modelLogin = new Application_Model_Login();
        $authNamespace = new Zend_Session_Namespace('Insta_Auth');
        if($user = $modelLogin->getRowByID($this->_user->id)){
            $user->logged_in = '0';
            $user->save();   
        }
        
        // Clear session
        $authNamespace->unsetAll();
        Zend_Auth::getInstance()->clearIdentity();
        $this->redirect('');
    }
    
}