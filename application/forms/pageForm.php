<?php
/**
 * 
 * Form for creating and editing pages
 * @author Mogens Engmark
 *
 */

require_once 'zCore/zCoreDefaultForm.php';

//class Default_Form_pageForm extends Zend_Form
class Default_Form_pageForm extends zCoreDefaultForm
{
	public function __construct($options)
	{
		parent::__construct($options);
		
		// DATABASE CONNECTIONS
        $db = new zCoreDbPages();
        
        // Loads list of pageTypes
        $pageTypeData = $db->getPageTypes();
		
		// Decorations and html adjustments
        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_form')));

        // Input fields
        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));
        
        // Buttons
        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_submit')));
        
		// Generates form
        $this->addDecorators($decor_form);
        $this->setName('pageForm');
                             
		// Creates all fields
		// pageId
        $pageId = new Zend_Form_Element_Hidden('pageId');
		
		// pageName
		$pageName = new Zend_Form_Element_Text('pageName');
		$pageName->addDecorators($decor_input);
		$pageName->setLabel('Side navn')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('Alnum');
				
		// pageType
		$pageTypeSelect = new Zend_Form_Element_Select('pageTypeSelect');
		$pageTypeSelect->addDecorators($decor_input);
        $pageTypeSelect->setLabel('Vælg side type:');

        // Adds options to select
        foreach($pageTypeData as $data) {
	    	$pageTypeSelect->addMultiOption($data['pageTypeId'], $data['pageType']);
        }
        
        // pageSubmit
        $pageSubmit = new Zend_Form_Element_Submit('pageSubmit');
		$pageSubmit->removeDecorator('DtDdWrapper')
        		->addDecorators($decor_button);
        $pageSubmit->setAttrib('id', 'submitbutton')
                ->setLabel('Submit');
		
                
        // Adding it up
        $this->addElements(array(
        						$pageId,
        						$pageName,
        						$pageTypeSelect,
        						$pageSubmit
        						));       
                
                
	}
}
?>
