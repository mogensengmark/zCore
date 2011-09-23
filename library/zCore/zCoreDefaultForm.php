<?php

class zCoreDefaultForm extends Zend_Form {

	public function __construct($options)
	{
		parent::__construct($options);
		
		// Decorations and html adjustments
        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_form')));

        // Input fields
        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));
        
        // Buttons
        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_submit')));
        
		// Generates form
        $this->addDecorators($decor_form);
		
		
	}
	
}

?>