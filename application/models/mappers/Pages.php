<?php

/**
 * 
 * Class for mapping pages model and database
 * @author Mogens Engmark
 *
 */
class Application_Model_Mapper_Pages
{
	private $_db;
	
	function __construct() {
		$this->_db = Zend_Registry::get('db');
		//$this->_db = Zend_Registry::getDefaultAdapter();
	}
	
	
	function getPageData($pageId) {
		$sql = "
			SELECT
				pages.pageId,
				pages.pageName,
				pages.pageState,
				pagetypes.pageType
			FROM
				pages
			INNER JOIN pagetypes ON (pages.fk_pageTypeId = pagetypes.pageTypeId)
			WHERE
				pages.pageId = ?";
		
//		Zend_Debug::dump($this->_db);
		
		
		// Preparing and executing statement
		$statement = $this->_db->prepare($sql);
		$statement->execute(array($pageId));
		
		// Pulls result
		$result = $statement->fetch();
		
		// Loading Pages model
		$pageModel = new Application_Model_Pages();
		// Assigning data
		$pageModel->setPageId($result['pageId']);
		$pageModel->setPageName($result['pageName']);
		$pageModel->setPageState($result['pageState']);
		$pageModel->setPageType($result['pageType']);
		
		// Returning data
		return $pageModel;
		
	}
	
	function getPageList($organisationId){
		$sql = "
			SELECT
				pages.pageId,
				pages.pageName,
				pages.pageState,
				pagetypes.pageType
			FROM
				pages
			INNER JOIN pagetypes ON (pages.fk_pageTypeId = pagetypes.pageTypeId)
			WHERE
				pages.fk_organisationID = ?
			ORDER BY
				pages.pageName";
		
	}
	
	
}


?>