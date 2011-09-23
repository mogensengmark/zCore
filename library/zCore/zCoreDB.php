<?php
/** 
 * zCoreDB - Base Class for database communication functions.
 * 
 * @author Mogens Engmark
 * 
 */
class zCoreDB 
{
	private $_db;
	private $_search_result;
	// Various containers
	protected $_sql;
	protected $_params;
	protected $_table;
	protected $_data;
	protected $_returnId;
	
	public function __construct() 
	{
		// Database object
		$this->_db = Zend_Db_Table_Abstract::getDefaultAdapter();
		// Ensures that no old result set is stored
        $this->_search_result = null;
        // Resetting containers
        $this->_sql = null;
        $this->_params = null;
        $this->_table = null;
        $this->_data = null;
        $this->_returnId = null;
	}

	/**
	 * Executes database query and returns data as specified in $fetchMode
	 * 
	 * @param unknown_type $fetchMode
	 * @param unknown_type $sql
	 * @param unknown_type $parameter
	 */	
	public function executeQuery($fetchMode, $sql, $parameter = null)
	{
		try {
			return $this->_db->$fetchMode($sql, $parameter);
		} catch (Exception $e) {
			die($e->getMessage());
			//throw $e;	
		}
	}

	/**
	 * 
	 * Inserts _values to _table specified in class variables.
	 * Option for returning last insterted id through class variable _returnId 
	 */
	protected function insertRow()
	{
		try {
			$this->_db->insert($this->_table, $this->_data);
			if($this->_returnId) {
				return $this->_db->lastInsertId();
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
		
	}

	/**
	 * 
	 * Retrieves a single row specified by a given sql statement and according parameters
	 * 
	 */
	protected function fetchRow() {
		try {
			return $this->_db->fetchRow($this->_sql, $this->_params);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	
	/**
	 * 
	 * Retrieves all entries specified by a given sql statement and according parameters
	 * 
	 */
	protected function fetchAll() {
		try {
			return $this->_db->fetchAll($this->_sql, $this->_params);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	
	/*
	 * VALIDATES USERNAME AND PASSWORD
	 * RETURNS userId, userName, roleId, userRole, organisationId 
	 * Expects $parameters to be 
	 * Array('login', 'password')
	 */
	public function loginValidate($params)
	{
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

		// Retrieves database result
		return $this->executeQuery('fetchRow', $sql, $params);

		//Zend_Debug::dump($result);
		
	}
	
	
	
	
}

?>