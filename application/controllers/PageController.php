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
				
				$result = $db->insertPageContent(mysql_real_escape_string(nl2br($values['pageContent'])), $values['pageId']);
            } 
        }
    }
    
    public function showpageAction()
    {
    	// Default page ID
    	$pid = 2;
		// Gets Helper instance
  		$helper = new zCoreHelper();
  		
  		// Loading data Model
  		$pageModel = new Application_Model_Mapper_Pages();
  		// Get data from model
  		$data = $pageModel->getPageData($pid);
  		// Assigning data
  		$this->view->pageName = $data->pageName;
  		$this->view->pageType = $data->pageType;
  		$this->view->pageAuthor = $data->pageAuthor;
  		$this->view->pageUpdated = $data->pageUpdated;
  		
  		$this->view->pageContent = $data->pageContent;
  		
  		
  		
  		$container = new Zend_Navigation(array(
    array(
        'label' => 'Page 1',
        'id' => 'home-link',
        'uri' => '/'
    ),
    array(
        'label' => 'Zend',
        'uri' => 'http://www.zend-project.com/',
        'order' => 100
    ),
    array(
        'label' => 'Page 2',
        'controller' => 'page2',
        'pages' => array(
            array(
                'label' => 'Page 2.1',
                'action' => 'page2_1',
                'controller' => 'page2',
                'class' => 'special-one',
                'title' => 'This element has a special class',
                'active' => true
            ),
            array(
                'label' => 'Page 2.2',
                'action' => 'page2_2',
                'controller' => 'page2',
                'class' => 'special-two',
                'title' => 'This element has a special class too'
            )
        )
    ),
    array(
        'label' => 'Page 2 with params',
        'action' => 'index',
        'controller' => 'page2',
        // specify a param or two
        'params' => array(
            'format' => 'json',
            'foo' => 'bar'
        )
    ),
    array(
        'label' => 'Page 2 with params and a route',
        'action' => 'index',
        'controller' => 'page2',
        // specify a route name and a param for the route
        'route' => 'nav-route-example',
        'params' => array(
            'format' => 'json'
        )
    ),
    array(
        'label' => 'Page 3',
        'action' => 'index',
        'controller' => 'index',
        'module' => 'mymodule',
        'reset_params' => false
    ),
    array(
        'label' => 'Page 4',
        'uri' => '#',
        'pages' => array(
            array(
                'label' => 'Page 4.1',
                'uri' => '/page4',
                'title' => 'Page 4 using uri',
                'pages' => array(
                    array(
                        'label' => 'Page 4.1.1',
                        'title' => 'Page 4 using mvc params',
                        'action' => 'index',
                        'controller' => 'page4',
                        // let's say this page is active
                        'active' => '1'
                    )
                )
            )
        )
    ),
    array(
        'label' => 'Page 0?',
        'uri' => '/setting/the/order/option',
        // setting order to -1 should make it appear first
        'order' => -1
    ),
    array(
        'label' => 'Page 5',
        'uri' => '/',
        // this page should not be visible
        'visible' => false,
        'pages' => array(
            array(
                'label' => 'Page 5.1',
                'uri' => '#',
                'pages' => array(
                    array(
                        'label' => 'Page 5.1.1',
                        'uri' => '#',
                        'pages' => array(
                            array(
                                'label' => 'Page 5.1.2',
                                'uri' => '#',
                                // let's say this page is active
                                'active' => true
                            )
                        )
                    )
                )
            )
        )
    ),
    array(
        'label' => 'ACL page 1 (guest)',
        'uri' => '#acl-guest',
        'resource' => 'nav-guest',
        'pages' => array(
            array(
                'label' => 'ACL page 1.1 (foo)',
                'uri' => '#acl-foo',
                'resource' => 'nav-foo'
            ),
            array(
                'label' => 'ACL page 1.2 (bar)',
                'uri' => '#acl-bar',
                'resource' => 'nav-bar'
            ),
            array(
                'label' => 'ACL page 1.3 (baz)',
                'uri' => '#acl-baz',
                'resource' => 'nav-baz'
            ),
            array(
                'label' => 'ACL page 1.4 (bat)',
                'uri' => '#acl-bat',
                'resource' => 'nav-bat'
            )
        )
    ),
    array(
        'label' => 'ACL page 2 (member)',
        'uri' => '#acl-member',
        'resource' => 'nav-member'
    ),
    array(
        'label' => 'ACL page 3 (admin',
        'uri' => '#acl-admin',
        'resource' => 'nav-admin',
        'pages' => array(
            array(
                'label' => 'ACL page 3.1 (nothing)',
                'uri' => '#acl-nada'
            )
        )
    ),
    array(
        'label' => 'Zend Framework',
        'route' => 'zf-route'
    )
));

	$this->view->testMenu = $container;
  		
  		
    }
    
}

?>