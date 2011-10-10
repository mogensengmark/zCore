<?php
//require_once 'Zend/View/Helpers/Abstract.php';


class Zend_View_Helper_PageBasic extends Zend_View_Helper_Abstract {
	
	public function pageBasic()
	{
		$test = "Dette er page basic";
		return $test;
	}
}

?>