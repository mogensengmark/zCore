<?php

class Default_Form_Units extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);

        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'units_form')));

        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));

        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'units_submit')));

        $this->addDecorators($decor_form);
        $this->setName('units');

        // Name of the unit
        $unit_name = new Zend_Form_Element_Text('unit_name');
        $unit_name->addDecorators($decor_input);
        $unit_name->setLabel('Enhedsnavn:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('Alnum');

        // Age specification of the members of the unit
        $unit_ages = new Zend_Form_Element_Text('unit_ages');
        $unit_ages->addDecorators($decor_input);
        $unit_ages->setLabel('Alderstrin:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('Alnum');

        /**/       
        // Unit Leaders        
        $unit_leaders = new Zend_Form_Element_Textarea('unit_leaders');
        $unit_leaders->addDecorators($decor_input);
        $unit_leaders->setLabel('Ledere:')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('Alnum');
        //$unit_leaders->class = 'ckeditor';
        
		// Unit information
		$unit_about = new Zend_Form_Element_Textarea('unit_about');
		$unit_about->addDecorators($decor_input);
		$unit_about->setLabel('Om enheden:')
				->setRequired(true) 
                 ->addValidator('NotEmpty', true)
                 ->addValidator('Alnum');
		/**/	
        // Unit logo
        $unit_logo = new Zend_Form_Element_File('unit_logo');
        $unit_logo->addDecorators($decor_input);
        $unit_logo->addDecorators(array('File'));
        $unit_logo->setLabel('Logo')
        		->setDestination('c:\test');
        // Limit to only 1 file		
        $unit_logo->addValidator('Count', false, 1);
		// limit to 100K
		$unit_logo->addValidator('Size', false, 102400);
		// only JPEG, PNG, and GIFs
		$unit_logo->addValidator('Extension', false, 'jpg,png,gif');
        
        // Submitbutton
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->removeDecorator('DtDdWrapper')
               ->addDecorators($decor_button);
        $submit->setAttrib('id', 'submitbutton')
               ->setLabel('Upload');

               
        // Summary of form       
        $this->addElements(array($unit_name, $unit_ages, $unit_leaders, $unit_about, $unit_logo, $submit));
        //$this->addElements(array($unit_name, $unit_ages, $unit_logo, $submit));
        
        // Sets encoding type on  form
        $this->setAttrib('enctype', 'mulitpart/form-data');
    }
}
?>