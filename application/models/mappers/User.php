<?php

/**
 *
 * Class for mapping user model with database
 * @author Mogens Engmark
 *
 */

class Application_Model_Mapper_User
{
    // Database
    private $_db;

	// Loads default database
    public function __construct() {
		// Loads db
        $this->_db = Zend_Registry::get('db');
        // Defines default menuData
        $this->_menuData = array();
	}

	/**
	 *
	 * Validates username and login
	 * @param unknown_type $username
	 * @param unknown_type $password
	 */
	public function validateUser($username, $password)
	{
	    // Loads user data
		$sql = "
			SELECT
				users.userId AS userId,
				CONCAT_WS(' ', firstName, middleName, lastName) AS userName,
				userroles.userRolesId AS roleId,
				userroles.userRole,
				users.fk_organisationId as organisationId
			FROM
				users
			INNER JOIN userroles on users.fk_userRolesId = userroles.userRolesId
			WHERE
				users.login = ?
			AND
				users.password = ?";

	    // Preparing and executing statement
		$statement = $this->_db->prepare($sql);
		$statement->execute(array($username, $password));

		// Pulls result
		$result = $statement->fetchAll();

		Zend_Debug::dump($result);

		$userModel =  new Application_Model_User();





	}

}
