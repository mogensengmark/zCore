<?php
class Default_Form_Blog extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        
        // Loads and appends blog categories
        $db = new zCoreDb();
        $categories = $db->getBlogCategories();
        
//        Zend_Debug::dump($categories);
        
        // Decorations and html adjustments
        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_form')));

        // Input fields
        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));
        
        // Buttons
        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'blog_submit')));
        
		// Generates form
        $this->addDecorators($decor_form);
        $this->setName('blog');
                             
		// Creates all fields
		$blogID = new Zend_Form_Element_Hidden('blogID');
        
        $blogCategory = new Zend_Form_Element_Select('blogCategory');
		$blogCategory->addDecorators($decor_input);
        $blogCategory->setLabel('Vælg kategori:');
        // Adds options to select
        foreach($categories as $c) {
	        $blogCategory->addMultiOption($c['id'], $c['category_name']);
        }
        	
        $blogTitle = new Zend_Form_Element_Text('blogTitle');
        $blogTitle->addDecorators($decor_input);
        $blogTitle->setLabel('Titel:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('Alnum');
        
        $blogSubTitle = new Zend_Form_Element_Text('blogSubTitle');
        $blogSubTitle->addDecorators($decor_input);
        $blogSubTitle->setLabel('Undertitel:')
                ->addValidator('NotEmpty', true)
                ->addValidator('Alnum');
        
		$blogText = new Zend_Form_Element_Textarea('blogText');
		$blogText->addDecorators($decor_input);
		$blogText->setLabel('Tekst')
				->setRequired(true);
		$blogText->class = 'ckeditor';
		//$blogText->class = 'editor1';
		
		
		$blogSubmit = new Zend_Form_Element_Submit('blogSubmit');
		$blogSubmit->removeDecorator('DtDdWrapper')
        		->addDecorators($decor_button);
        $blogSubmit->setAttrib('id', 'submitbutton')
                ->setLabel('Submit');
		
		
        $this->addElements(array(
        						$blogID, 
        						$blogCategory,
        						$blogTitle, 
        						$blogSubTitle,
        						$blogText,
        						$blogSubmit
        						));
    }
}
?>