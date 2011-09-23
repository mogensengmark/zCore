<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        /**
        require_once 'zCore/zCoreHelperFunctions.php';
        $helper = new zCoreHelper();
        $pass="300m486e";
        echo "pass: " . $helper->encodePassword($pass);
        /**/
        //echo "hest";
        

    }
    
    public function aboutAction()
    {
    	//echo "ABOUT FUNCTION";
    }

    public function contactAction()
    {
    	//echo "CONTACT FUNCTION";
    }
    
    public function loginAction()
    {
    	echo "Du er nu logget ind";
    }
}

