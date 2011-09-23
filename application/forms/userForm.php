<?php
/**
 * 
 * Form for handling user creation and editing.
 * 
 * @author Mogens Engmark
 *
 */

class Default_Form_userForm extends Zend_Form
{
	public function __construct($options)
	{
		parent::__construct($options);
		
		// DATABASE CONNECTIONS
//        $db = new zCoreDb();
		
       /**
        * @todo : Replace with database call
        */
        $userTypeData = array('id' => 0, 'userType' => 'BrugerType');
		
		// Decorations and html adjustments
        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'userForm_form')));

        // Input fields decorators
        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));
        
        // Button decorators
        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'userForm_submit')));
        
		// Generates form
        $this->addDecorators($decor_form);
        $this->setName('userForm');
		
		// Form elements
		// First Name
        $userFirstName = new Zend_Form_Element_Text('userFirstName');
		
        // Middle Name
        $userMiddleName = new Zend_Form_Element_Text('userMiddleName');

        // Last Name
        $userLastName = new Zend_Form_Element_Text('userLastName');
        
        // User Type
        $userType = new Zend_Form_Element_Select('userTypeSelect');
		//$userType->addDecorator($decor_input);
        $userType->setLabel('Vælg brugertype');
		// Adds options to select
        foreach($userTypeData as $data) {
	        $userType->addMultiOption($data['id'], $data['userType']);
        }
        
		
        // Submit
        $userFormSubmit = new Zend_Form_Element_Submit('userFormSubmit');
		$userFormSubmit->removeDecorator('DtDdWrapper')
        		->addDecorators($decor_button);
        $userFormSubmit->setAttrib('id', 'submitbutton')
                ->setLabel('Submit');
                
                
        $this->addElements(array($userFirstName,
        					$userMiddleName,
        					$userLastName,
        					$userType,
        					$userFormSubmit
        					));
		
	}
}

?>