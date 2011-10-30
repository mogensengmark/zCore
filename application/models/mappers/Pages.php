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
				
		// Checking what additional infomation we need to load
		switch($result['pageType']) {
			case 'custom':
				$sql = "
					SELECT
						pagecontent.pageContentId,
						pagecontent.pageContent,
						pagecontent.pageInserted,
						CONCAT_WS(' ', users.firstName, users.middleName, users.lastName) AS pageInsertedBy
					FROM
						pagecontent
					INNER JOIN users ON pagecontent.pageInsertedBy = users.userId
					WHERE
						pagecontent.fk_pageId = ?
					ORDER BY pagecontent.pageInserted DESC
					LIMIT 1";
				
				$pageDataStatement = $this->_db->prepare($sql);
				$pageDataStatement->execute(array($pageId));
				$contentResult = $pageDataStatement->fetch();

				$pageModel->setPageContent(stripslashes($contentResult['pageContent']));
				$pageModel->setPageAuthor($contentResult['pageInsertedBy']);
				$pageModel->setPageUpdated($contentResult['pageInserted']);
				
				
				break;
				
			case 'blog':
				$sql = "
					SELECT
						blogs.blogId,
						blogs.blogName,
						blogentries.headLine,
						blogentries.subHeader,
						blogentries.content,
						blogentries.entryEdited,
						CONCAT_WS(' ', users.firstName, users.middleName, users.Lastname) AS editedBy,
					 FROM
					 	pagesblogsmap
				 	INNER JOIN blogs ON pagesblogsmaps.fk_blogId = blogs.blogId
				 	INNER JOIN blogentries ON blogs.blogId = blogentries.fk_blogsId
				 	INNER JOIN users ON blogentries.entryEditedBy = users.userId
				 	WHERE
				 		pagesblogsmap.fk_pageId = ?";
				break;
		}
		
		
		// Returning data
		return $pageModel;
		
	}
	
	function getPageDataByName($pageName) {
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
				pages.pageName = ?";
		
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