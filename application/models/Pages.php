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
	public $pageContent;
	public $pageAuthor;
	public $pageUpdated;
	
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

	function getPageContent() {
		return $this->pageContent;
	}
	
	function setPageContent($pageContent) {
		$this->pageContent = $pageContent;
	}
	
	function getPageAuthor() {
		return $this->pageAuthor;
	}
	
	function setPageAuthor($pageAuthor) {
		$this->pageAuthor = $pageAuthor;
	}
	
	function getPageUpdated() {
		return $this->pageUpdated;
	}
	
	function setPageUpdated($pageUpdated) {
		$this->pageUpdated = $pageUpdated;
	}
	
}

