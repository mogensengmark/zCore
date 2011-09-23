<?php
require_once 'zCore/zCoreAuthController.php';

/**
 * AuthController
 * Functionality for authentication of users
 * 
 * @author Mogens Engmark
 *
 */

class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
        $form = new Default_Form_Login();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
        	//echo "login posted<br>";
        	
            // Get posted data
        	$form_data = $this->getRequest()->getPost();
            //Zend_Debug::dump($form_data);	
            
            // Did validation pass??
            if ($form->isValid($form_data)) {
                $username = $form->getValue('username');
                $password = $form->getValue('password');
                
                // Calls validation 
                $auth_adapter = new zCore_Auth_Adapter($username, $password);
                // Using Zend_Auth for authenticating with zCore_Auth_Adapter
                Zend_Auth::getInstance()->authenticate($auth_adapter);

                
//                echo "LOGIN VALID<br>";
                
                /// @todo handle login errors
                /**/	
                $this->_redirect('/admin/index');
                /**/
            }
        }
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }
}
