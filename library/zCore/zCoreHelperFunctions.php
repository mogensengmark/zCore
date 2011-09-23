<?php
//echo "zCoreHelper included<br>";

/**
 * zCoreHelper
 * Various support functions
 * 
 * @author Mogens Engmark
 *
 */
class zCoreHelper
{
	protected $_key;
	
	public function __construct()
	{
//		echo "zCoreHelper constructor<br>";
		// Sets encryption key value
		$this->_key = "jUm.w8(a11rJAerniaw&21";
	}

	/*
	 * Encodes password with specified key through salt with sha1
	 * 
	 */
    public function encodePassword($password)
    {
    	return sha1(sha1($password).$this->_key); 
    }	
	
    public function test()
    {
    	return "TEST";
    }
    
	/**
	 * 
	 * Extracts data from user identity (Zend_Auth)
	 * Takes paramater as either array of specific data to extract, as single field or as keyword 'all'   
	 * 
	 * Returns either array or if only single field is specified, only the value of the field.
	 * 
	 * There is no error handling on this function and if the requested value is not present a notice will be issued.
	 * 
	 * @param unknown_type $dataRequest
	 * @return $userData
	 */
    public function getUserData($dataRequest)
    {
    	// Default data
    	$userData = '';
    	// Check if the user is logged in
    	$authUser = Zend_Auth::getInstance()->getIdentity();
		// Is the user logged in??
    	if(!empty($authUser)) {
    		
    		// Is dataRequest an array?
    		if(is_array($dataRequest)) {
    			foreach($dataRequest as $element){
    				$userData[$element] = $authUser->$element;
    			}
    		} else {
    			// Return ALL values??
    			if($dataRequest == 'all') {
    				$userData = $authUser;
    			} else {
    				// Extract the given field from authData
    				$userData = $authUser->$dataRequest;
    			}
    		}
    	}
    	// Returns userData
    	return $userData;
    }
    
}
?>