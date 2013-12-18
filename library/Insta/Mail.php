<?php

class Insta_Mail
    extends Zend_Mail {
    
    public function __construct($charset = 'UTF-8') {
        parent::__construct($charset);
        
        // Use AWS SES for SMTP
        $tr = new Insta_Mail_Transport_Smtp();
        Zend_Mail::setDefaultTransport($tr);
    }
    
}