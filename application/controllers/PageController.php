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
        /**
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
        **/
        
        $this->view->params = $this->_request->getParams();
    }

    public function enhederAction()
    {
    }
    
    public function familiespejdAction()
    {
        /**
        // Enter your Google account credentials
        $email = 'mogens.engmark@gmail.com';
        $passwd = 'fdm2009!!';
        try {
            $client = Zend_Gdata_ClientLogin::getHttpClient($email, $passwd, 'cl');
        } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
            echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
            echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
        } catch (Zend_Gdata_App_AuthException $ae) {
            echo 'Problem authenticating: ' . $ae->exception() . "\n";
        }

        $cal = new Zend_Gdata_Calendar($client);
        **/
        
        /**
         * @todo: setup query string to google account.
         * use $calendar->id value for retrieving values from a given calendar????
         * 
         */
        
        
        
        // Parameters for ClientAuth authentication
        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        $user = "mogens.engmark@gmail.com";
        $pass = "fdm2009!!";

        // Create an authenticated HTTP client
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        
        // Create an instance of the Calendar service
        $service = new Zend_Gdata_Calendar($client);        
        /*
        try {
            $listFeed= $service->getCalendarListFeed();
            //$listFeed= $service->getCalendarEventFeed();
        } catch (Zend_Gdata_App_Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        //Zend_Debug::dump($listFeed);
        echo "<h1>Calendar List Feed</h1>";
        echo "<ul>";
        foreach ($listFeed as $calendar) {
            echo "<li>" . $calendar->title . " (Event Feed: " . $calendar->id . ") </li>";
            //echo "<li>" . $calendar->title . " " . $calendar->when[0]->startTime  . " " . $calendar->author . ") </li>";
        }
        echo "</ul>";
        */
        //Zend_Debug::dump($calendar->when);
    }
    
    public function baeverAction()
    {
        
    }
    
    public function ulveAction()
    {
            
    }
    
    public function juniorAction()
    {
        
    }
    
    public function tropAction()
    {
        
    }
    
    public function seniorAction()
    {
        
    }
    
    public function roverAction()
    {
        
    }
    
    public function billederAction()
    {
        
    }
}

?>