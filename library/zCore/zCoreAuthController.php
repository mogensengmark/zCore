<?php

//echo "zCoreAuthController included<br>";

require_once('zCore/zCoreDB.php');
require_once('zCore/zCoreHelperFunctions.php');

/**
 * zCore Authentication Class
 * 
 * @author Mogens Engmark
 * 
 */
class zCore_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
	protected $_username;
    protected $_password;
	protected $_db;
	protected $_helper;

	public function __construct($username = null, $password = null)
    {
        // Database Object
        $this->_db = new zCoreDb();

        // Helper functions Object
        $this->_helper = new zCoreHelper();
    	
        //echo "class initiated<br>";
        foreach (array('username', 'password') as $option) {
            if ($$option !== null) {
                $method = "set".ucfirst($option);
                $this->{$method}($$option);
            }
        }
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        // Assigns password after encoding it
    	$this->_password = (string)$this->_helper->encodePassword($password);
        return $this;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function setUsername($username)
    {
        $this->_username = (string)$username;
        return $this;
    }

    public function authenticate()
    {
    	foreach (array('username', 'password') as $option) {
            if ($this->{"_$option"} === null) {
                throw new Zend_Auth_Adapter_Exception("Option '$option' must be set before authentication");
            }
        }
	
        // Default setting
        $result = array(
            'code' => Zend_Auth_Result::FAILURE,
            'identity' => (object)array('username' => $this->_username)
        	);

        // Parameters to database
        // SALT PASSWORD HERE
        	
        $db_params = array($this->_username, $this->_password);
        
        // Executing database query	
    	$db_result = $this->_db->loginValidate($db_params);	

    	// Did we get any results?
    	if (is_array($db_result)) {
            // validation is successfull
    		$result['code'] = Zend_Auth_Result::SUCCESS;

            // Loops through dataoutput and assigns it to result['identity']
            foreach($db_result as $key=>$value) {
            	$result['identity']->$key = $value;
            }
        }
		
        return new Zend_Auth_Result($result['code'], $result['identity']);
    }
}
?>