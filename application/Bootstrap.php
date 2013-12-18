<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Insta_')->registerNamespace('Twitter_');
    }
    protected function _initDoctype(){
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    
    protected function _initMVC(){
        Zend_Layout::startMvc();
        $this->bootstrap('view');
    }
    
    protected function _initConfig(){
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
        Zend_Registry::set('config', $config);
    }


    protected function _initDatabase(){
        $this->bootstrap('db');
    }
    
    protected function _initPlugins(){
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->registerPlugin(new Insta_Plugin_Router());
        $frontController->registerPlugin(new Insta_Plugin_ACL());
    }
    
}

