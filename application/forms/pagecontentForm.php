<?php
require_once 'zCore/zCoreDefaultForm.php';

class Default_Form_pagecontentForm extends Zend_Form
{
	public function __construct() 
	{
		parent::__construct($this->options);
				
		// Decorations and html adjustments	
        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_form')));

        // Input fields
        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));
        
        // Buttons
        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_submit')));
        
		// Generates form
        $this->addDecorators($decor_form);
		// Define form name
		$this->setName('pageContent');

		// pageId
		$pageId = new Zend_Form_Element_Hidden('pageId');

		// pageContent
		$pageContent = new Zend_Form_Element_Textarea('pageContent');
		$pageContent->addDecorators($decor_input);
		$pageContent->setAttrib('id', 'pageContent');
		//$pageContent->class = 'ckeditor';
		$pageContent->class = 'ckeditor';

		// pageSubmit
        $pageSubmit = new Zend_Form_Element_Submit('pageSubmit');
		$pageSubmit->removeDecorator('DtDdWrapper')
        		->addDecorators($decor_button);
        $pageSubmit->setAttrib('id', 'submitbutton')
                ->setLabel('Submit');
		
		// Adding it up
        $this->addElements(array(
        						$pageId,
        						$pageContent,
        						$pageSubmit
        						));       
                
		
		
	}
}
?>