<?php
require_once 'zCore/zCoreDB.php';


class zCoreDbPages extends zCoreDB {
	
	/**
	 * 
	 * Gets list of page Types, ordered alphabetical
	 * @param unknown_type $params
	 */
	public function getPageTypes()
	{
		$this->_sql = "
			SELECT
				pageTypeId,
				pageType
			FROM
				pagetypes
			ORDER BY
				pageType ASC";
		
		// Retrieves database result
		return $this->fetchAll();
	}
	
	public function createPage($pageName, $organisationId, $pageType, $state = null)
	{
		// Table
		$this->_table = 'pages';
		// Data
		$this->_data['pagename'] = $pageName;
		$this->_data['fk_organisationid'] = $organisationId;
		$this->_data['fk_pagetypeid'] = $pageType;
		$this->_data['pagestate'] = true;
		// Return Id
		$this->_returnId = true;
		
		// Executes query
		return $this->insertRow();
	}
	
	public function getPageList($organisationId)
	{
		$this->_sql = "
			SELECT
				pages.pageId,
				pages.pageName,
				pages.pageState,
				pagetypes.pageType
			FROM
				pages
			INNER JOIN pageTypes ON (pages.fk_pageTypeId = pageTypes.pageTypeId)
			WHERE
				pages.fk_organisationID = ?
			ORDER BY
				pages.pageName";
		
		$this->_params[] = $organisationId;
		
		return $this->fetchAll();
	}
	
	public function insertPageContent($pageContent, $pageId)
	{
		// Table
		$this->_table = 'pageContent';
		// Data
		$this->_data['pageContent'] = $pageContent;
		$this->_data['fk_pageId'] = $pageId;
		
		// Executes query
		$this->insertRow();
		
	}
	
	
	
	
	
}