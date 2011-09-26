<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Bootstrap autoloader for application resources
     *
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default',
            'basePath'  => dirname(__FILE__),
        ));
        return $autoloader;
    }	
	
    /**/
    protected function _initView()
    {
        $view = new Zend_View();

        $view->doctype('XHTML11');

        $view->headTitle()->setSeparator(' : ');
        $view->headTitle('zCore');
        $view->headMeta()->appendHttpEquiv('Content-Type',
                                           'text/html; charset=utf-8');

        return $view;
    }
    
    
    protected function _initzCoreDB()
    {
    	$this->bootstrap('db');
    	$db = $this->getResource('db');
    	
    	Zend_Registry::set('db', $db);
    }
    
    /**
    
	protected function _initDocType()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	}
	/**/
	
	
	protected function _initNavigation()
	{
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
		
		$navigation = new Zend_Navigation($config);
		$view->navigation($navigation); 
	}
}

