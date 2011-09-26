<?php
/**
 * 
 * Datamodel for controlling pages elements
 * @author Mogens Engmark
 *
 */
class Application_Model_Pages
{
	// Variables
	public $pageId;
	public $pageName;
	public $organisationId;
	public $pageState;
	public $pageType;
	
	function getPageId() {
		return $this->pageId;
	}
	
	function setPageId($pageId) {
		$this->pageId = $pageId;
	}
	
	function getPageName() {
		return $this->pageName;
	}

	function setPageName($name) {
		$this->pageName = $name;
	}
	
	function getOrganisationId() {
		return $this->organisationId;
	}

	function setOrganisationId($organisationId) {
		$this->organisationId = $organisationId;
	}
	
	function getPageState() {
		return $this->pageState;
	}
	
	function setPageState($pageState) {
		$this->pageState = $pageState;
	}
	
	function getPageType() {
		return $this->pageType;
	}
	
	function setPageType($pageType) {
		$this->pageType = $pageType;
	}
}

