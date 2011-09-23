<?php

/**
 * BlogController
 * Controller for handling blog elements
 * 
 * @author
 * @version 
 */
	
require_once 'Zend/Controller/Action.php';
require_once 'zCore/zCoreDb.php';

class BlogController extends Zend_Controller_Action
{
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        echo "this is default blog action";
    }
    
    
    public function createblogAction()
    {
    	require_once 'zCore/zCoreDbBlogs.php';
    }
    
    
    /**
     * Shows a given blog
     */
    public function viewblogAction()
    {
    	// Database Connection
    	$db = new zCoreDb();
    	
    	$blog_id = 1;
    	
    	
    	// Get data from database
    	$blogEntry = $db->getBlogEntry($blog_id);
		$this->_helper->layout()->blogEntry = $blogEntry;
		
		
    	//Zend_Debug::dump($entries);
    	
    }
    
    /**
     * Retrieves list of the last 5 blog entries from the database
     */
    public function viewlastfiveentriesAction()
    {
    	// Database Connection
    	$db = new zCoreDb();
    	
    	
    	// Get data from database
    	$entries = $db->listBlogsLimited(1, 250, 'date');

    	$this->_helper->layout()->entries = $entries;
    	
    	//Zend_Debug::dump($entries);
    }
    
    /**
     * Retrieves list of blog entries for editing purposes
     */
    public function viewbloglistAction()
    {
    	// Database Connection
    	$db = new zCoreDb();

		// Retrieves list of blog entries ordered by ID descending
    	$entries = $db->listBlogsLimited(0, 50, 'id');

		$this->_helper->layout()->entries = $entries;		
    	
    }
    
    
    /**
     * Edits a given blog entry
     */
    public function editblogAction()
    {
    	// Database Connection
    	$db = new zCoreDb();

		// Retrieves given blog entry
    	$blogEntry = $db->getBlogEntry($_POST['blogID']);

		$this->_helper->layout()->entries = $blogEntry;

		// Initializes form
		$form = new Default_Form_Blog();
        $this->view->form = $form;

        
		// Checks if form is posted
		if($this->_request->isPost())
		{
			// Get posted values
			$formData = $this->_request->getPost();
			
			// Hide Blog
			if(!empty($formData['disableBlog']))
			{
				
			}
			
			// Update Blog
			if(!empty($formData['blogSubmit']))
			{
				
			}

			// Edit blog
			// Retrieve data from database 
			$data = $db->getBlogEntry($formData['blogID']);
			// Assigning form data from database
			$form->blogID->setValue($data['id']);
			$form->blogCategory->setValue($data['category_id']);
			$form->blogTitle->setValue($data['title']);
			$form->blogSubTitle->setValue($data['subtitle']);
			$form->blogText->setValue($data['main_text']);
			$form->blogSubmit->setLabel('Opdatér');
			//$form->populate($formData);
			Zend_Debug::dump($data);
        
		}
    }
}

