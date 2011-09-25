<?php
/**
 * 
 * Datamodel for controlling pages elements
 * @author Mogens Engmark
 *
 */
class Model_Pages
{
	// Variables
	private $_pageId;
	private $_pageName;
	private $_organisationId;
	private $_pageState;
	private $_pageType;
	
	function getPageId() {
		return $this->_pageId;
	}
	
	function setPageId($pageId) {
		$this->_pageId = $pageId;
	}
	
	function getPageName() {
		return $this->_pageName;
	}

	function setPageName($name) {
		$this->_pageName = $name;
	}
	
	function getOrganisationId() {
		return $this->_organisationId;
	}

	function setOrganisationId($organisationId) {
		$this->_organisationId = $organisationId;
	}
	
	function getPageState() {
		return $this->_pageState;
	}
	
	function setPageState($pageState) {
		$this->_pageState = $pageState;
	}
	
	function getPageType() {
		return $this->_pageType;
	}
	
	function setPageType($pageType) {
		$this->_pageType = $pageType;
	}
}

