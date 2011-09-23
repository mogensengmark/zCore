<?php
//require_once 'Zend/Controller/Action.php';
//require_once('zCore/zCoreDB.php');

/**
 * UnitController
 * Interfaces for handling units 
 * The definition of a 'Unit' in zCore can also be translated as 'Team' or 'Group'.
 * 
 * @author Mogens Engmark
 *  
 */
	
class UnitController extends Zend_Controller_Action
{
	public function init()
	{
		/** Initialize the unit controller here **/
	}
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
    	echo "index of unit controller<br>";
        // TODO Auto-generated {0}::indexAction() default action
        //$form = new Default_Form_Units();
        //$this->view->form = $form;
	}

    public function show_unitAction()
    {
    	// Retrieve data for a given unit
    	echo "show units <br>";
        //$form = new Default_Form_Units();
        //$this->view->form = $form;
    }
    
    //public function insertUnitAction()
    public function insertunitAction()
    {
    	echo "insert unit <br>";
    	// Display unit form
        $form = new Default_Form_Units();
        $this->view->form = $form;
        
        if($this->getRequest()->isPost()) {
        	echo "form posted<br>";
        }else {
        	echo "eeeeh?<br>";
        }
    }
    
    public function updateUnitAction()
    {
    	// Populate and display unit form
    }
    
    public function deleteUnitAction()
    {
    	// Deleting unit
    }
    
    
    
}

