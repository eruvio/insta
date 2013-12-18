<?php

class Application_Form_Signup 
    extends Twitter_Bootstrap_Form_Vertical
{
    
    private $profile = null;
    
    public function setProfile($profile){
        $this->profile = $profile;
    }

    public function init()
    {
        parent::init();

        // Set enctype
        $this->setEnctype('multipart/form-data');
        
        // Set ID
        $this->setAttrib('id', 'newSignup');
        
        // Set action
        $this->setAction('/signup');
        
        // Set the method for the display form to POST
        $this->setMethod('post');

        $this->addElement('text', 'email', array(
            'label'      => 'Email: ',
            'placeholder'      => 'Email',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators'  => array(
                array('validator' => 'StringLength', 'options' => array(6, 30)),
                array('validator' => 'alnum'),
                array('validator' => 'Db_NoRecordExists', 'options' => array(
                    'table' => 'insta_login',
                    'field' => 'email'
                ))
            )
        ));
        
        $this->addElement('password', 'password', array(
            'label'      => 'Password: ',
            'placeholder'      => 'Password',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators'  => array(
                array('validator' => 'StringLength', 'options' => array(6, 30))
            )
        ));

        $this->addElement('file', 'image', array(
            'label' => 'Profile Picture:',
            'required' => true,
//            'validators' => array(
//                array('validator' => 'Count', 'options' => 1),
//                array('validator' => 'Size', 'options' => '5242880'),
//                array('validator' => 'Extension', 'options' => 'jpg')
//            )
        ));

    }
}
