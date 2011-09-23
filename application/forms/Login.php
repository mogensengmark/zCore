<?php
class Default_Form_Login extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);

        $decor_form = array(array('HtmlTag', array('tag' => 'div', 'id' => 'login_form')));

        $decor_input = array(array('HtmlTag', array('tag' => 'div')),
                             array('Label', array('tag' => 'div')));

        $decor_button = array(array('HtmlTag', array('tag' => 'div', 'id' => 'login_submit')));

        $this->addDecorators($decor_form);
        $this->setName('login');

        $username = new Zend_Form_Element_Text('username');
        $username->addDecorators($decor_input);
        $username->setLabel('Brugernavn:')
                 ->setRequired(true)
                 ->addValidator('NotEmpty', true)
                 ->addValidator('Alnum');

        $password = new Zend_Form_Element_Password('password');
        $password->addDecorators($decor_input);
        $password->setLabel('Kodeord:')
                 ->setRequired(true)
                 ->addValidator('NotEmpty', true)
                 ->addValidator('Alnum');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->removeDecorator('DtDdWrapper')
               ->addDecorators($decor_button);
        $submit->setAttrib('id', 'submitbutton')
               ->setLabel('Login');

        $this->addElements(array($username, $password, $submit));
    }
}
?>