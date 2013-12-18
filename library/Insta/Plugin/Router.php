<?php

class Insta_Plugin_Router
    extends Zend_Controller_Plugin_Abstract {
        
    public function routeStartup(Zend_Controller_Request_Abstract $request) {
        parent::routeStartup($request);
        $this->_configureCustomRoutes();
    }
    
    private function _configureCustomRoutes(){
        $router = Zend_Controller_Front::getInstance()->getRouter();
        
        // Route: /logout
        $router->addRoute('logout', new Zend_Controller_Router_Route_Static(
            'logout',
            array('controller' => 'index', 'action' => 'logout')
        ));
        
        // Route: /signup
        $router->addRoute('signup', new Zend_Controller_Router_Route('signup',
            array(
                'controller' => 'index',
                'action' => 'signup'
            )
        ));

    }
    
}