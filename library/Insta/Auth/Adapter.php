<?php

class Insta_Auth_Adapter
    implements Zend_Auth_Adapter_Interface {
    
    private $_email = null;
    private $_password = null;
    private $_force = false;
    
    public function __construct($email,$password) {
        $this->_email = $email;
        $this->_password = $password;
    }
    
    public function setForce($force){
        $this->_force = (bool)$force;
    }
    
    public function authenticate() {
        $modelLogin = new Application_Model_Login();
        $modelUser  = new Application_Model_Profile();
        $authNamespace = new Zend_Session_Namespace('Insta_Auth');

        if(($modelLogin->authenticate($this->_email, $this->_password)) || $this->_force){
            $login = $modelLogin->getRowByEmail($this->_email);
            if($user = $modelUser->getUserRowById($login->id)){
                $authNamespace->user = (object)$user->toArray();
                $login->logged_in = '1';
                $login->save();
                return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->_email);
            } else{
                $authNamespace->unsetAll();
            }
         } else {
            $authNamespace->unsetAll();
        }
        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, $this->_email);
    }
    
}