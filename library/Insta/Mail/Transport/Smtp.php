<?php

/**
 * @see Zend_Mail_Transport_Smtp
 */
class Insta_Mail_Transport_Smtp
    extends Zend_Mail_Transport_Smtp {

    /**
     * Insta Mail Transport SMTP Class
     */
    public function __construct()
    {

        // Configure AWS SES credentials
        $host = 'email-smtp.us-east-1.amazonaws.com';
        $config    = array(
            'ssl'      => 'ssl',
            'port'     => '465',
            'auth'     => 'plain',
            'username' => '__AWS_KEY_REMOVED_RUVIO__',
            'password' => '__AWS_KEY_REMOVED_RUVIO__'
        );

        parent::__construct($host, $config);
    }

}