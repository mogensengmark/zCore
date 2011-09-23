<?php
// Loads classes
require_once 'zCore/zCoreHelperFunctions.php';
require_once 'zCore/zCoreDbPages.php';

class PageController extends Zend_Controller_Action {

	// Default option for forms.
	private $options = '';
	
	public function createpageAction()
    {
    	// Generates form
    	$form = new Default_Form_pageForm($this->options);
    	$form->setMethod('post')
    		->setAttrib('id', 'pageCreateForm')
    		->setAction('createpage');
    		
    	$this->view->form = $form;

    	
		// Validation and insert into database
		// Is the request a POST?
    	if ($this->getRequest()->isPost()) {
            // Extract form data from POST
    		$form_data = $this->getRequest()->getPost();
            // Is the form valid according to criterias set in form?
    		if ($form->isValid($form_data)) {
            	// Helper functions
    			$helper = new zCoreHelper();
    			// Loads values from form
    			$values = $form->getValues();
            	
				// Database            	
    			$db = new zCoreDBPages();
    			// Creates page
    			$result = $db->createPage($values['pageName'], $helper->getUserData('organisationId'), $values['pageTypeSelect']);        	
            	
            	//Zend_Debug::dump($params);	
				//Zend_Debug::dump($values);	
				Zend_Debug::dump($result);	
    			
    		}
		}
    }

    public function editpagecontentAction()
    {
    	// Default pageId
    	$pid = 2;
    	
    	
    	$form = new Default_Form_pagecontentForm($this->options);
       	$form->setMethod('post')
    		->setAttrib('id', 'pageCreateForm')
    		->setAction('editpagecontent');

    	// inserting pageId into form
    	$form->populate(array('pageId' => $pid));
    		
    	// Assinging generated form to view
        $this->view->form = $form;
        
        // Is the form posted back?
        if ($this->getRequest()->isPost()) {
        	// Get all data from form
        	$form_data = $this->getRequest()->getPost();
        	
        	// Does the form validates according to specified criterias?
        	if ($form->isValid($form_data)) {
        		// Gets Helper instance
        		$helper = new zCoreHelper();
        		// Gets database Instance
				$db = new zCoreDbPages();
				
				// Loads form values
				$values = $form->getValues();
				
				$result = $db->insertPageContent($values['pageContent'], $values['pageId']);
            } 
        }
    }
}

?>