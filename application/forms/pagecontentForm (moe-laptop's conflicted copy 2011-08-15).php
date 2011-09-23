<?php
require_once 'zCore/zCoreDefaultForm.php';

class Default_Form_pagecontentForm extends Zend_Form
{
	public function __construct() {
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

		// Add fields - adjust with ckeditor
	}
}
?>