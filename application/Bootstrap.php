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

		// Loading menu data mapper
		$menuMapper = new Application_Model_Mapper_Menu();
		// Get menu value
		$menuStructure = $menuMapper->getMenu(1);
/**
		echo "CONFIG";
		Zend_Debug::dump($config);
/**/
	    // Assigning to view
		$view->navigation($menuStructure);
	}
}

