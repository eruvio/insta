<?php

abstract class Insta_MainController
    extends Zend_Controller_Action {
    
    protected $_controller = null;
    protected $_action = null;
    protected $_auth = null;
    protected $_user = null;
    protected $imageWidths = array(
        'l' => 600,
        'm' => 300,
        's' => 100
    );

    public function init(){
        // Retreive account from session
        $authNamespace = new Zend_Session_Namespace('Insta_Auth');
        $this->_auth = $authNamespace;
        
        $this->_user = $authNamespace->user;
        $this->view->user = $authNamespace->user;
        
        // Populate controler/action
        $this->_controller = $this->_request->getControllerName();
        $this->_action = $this->_request->getActionName();
        $this->view->controller = $this->_controller;
        $this->view->action = $this->_action;
    }
          
}
