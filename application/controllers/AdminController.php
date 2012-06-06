<?php

/**
 * {0}
 *
 * @author
 * @version
 */

class AdminController extends Zend_Controller_Action
{
	// Default option for forms.
	private $options = '';


	/**
	 * The default action - show the home page
	 */
    public function indexAction()
    {
        // TODO Auto-generated {0}::indexAction() default action




    }

    public function userformAction()
    {
    	$options = '';
    	$form = new Default_Form_userForm($options);
    	$this->view->form = $form;
    }


}

