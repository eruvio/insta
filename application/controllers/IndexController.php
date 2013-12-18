<?php

class IndexController
    extends Insta_MainController {

    public function init(){
        parent::init();
        
        // Redirect to logged-in
        if(Zend_Auth::getInstance()->hasIdentity() && $this->_request->getActionName() != 'logout'){
            $this->redirect('/profile');
        }
        
        // Switch layout
        $this->_helper->layout()->setLayout('index');
        
    }
    
    public function indexAction(){
        // Init form
        $form = new Application_Form_Signup();
        
        // Assign form to view
        $this->view->assign(array(
            'signup' => $form
        ));
    }
    
    public function signupAction(){
        
        // Init
        $form = new Application_Form_Signup();
        $modelLogin = new Application_Model_Login();
        
        if($this->_request->isPost()){
            
            // Create Account
            if($modelLogin->createAccount($this->_request->getPost())){
                // @todo: implement signup, autologin
            }
                        
        }
        
        // Redirect to index
        $this->redirect('');
    }
   
}

