<?php

class Insta_Plugin_ACL
    extends Zend_Controller_Plugin_Abstract {
    
    const CONTROLLER_LOGIN = 'login';
    const CONTROLLER_HOME = 'index';
    const CONTROLLER_SIGNUP = 'index';
    const ACTION_LOGIN = 'index';
    const ACTION_SIGNUP = 'signup';
    const ACTION_HOME = 'index';
    
    static $_iterations = 0;
            
    public function routeShutdown(Zend_Controller_Request_Abstract $request) {
        parent::routeShutdown($request);
    }
    
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        parent::preDispatch($request);
        if(!self::$_iterations++){
            if(!$this->_loggedIn() && !$this->_isLoginAttempt() && !$this->_isHomePage() && !$this->_isSignupAttempt()){
                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                $redirector->gotoUrl('');
            }
        }
    }
    
    protected function _loggedIn(){
        $auth = Zend_Auth::getInstance();
        return $auth->hasIdentity();
    }
    
    private function _isLoginAttempt(){
        return (($this->getRequest()->getControllerName() == self::CONTROLLER_LOGIN) && ($this->getRequest()->getActionName() == self::ACTION_LOGIN));
    }
    
    private function _isSignupAttempt(){
        return (($this->getRequest()->getControllerName() == self::CONTROLLER_SIGNUP) && ($this->getRequest()->getActionName() == self::ACTION_SIGNUP));
    }
    
    private function _isHomePage(){
        return ($this->getRequest()->getControllerName() == self::CONTROLLER_HOME && $this->getRequest()->getActionName() == self::ACTION_HOME);
    }
}