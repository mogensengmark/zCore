<?php
/**
 *
 * Datamodel for handling menu elements
 * @author Mogens Engmark
 *
 */
class Application_Model_Menu
{
    // Variables
    private $_menuItems;


    function __construct()
    {
        $this->_menuItems = new Zend_Navigation();
    }

    // Functions
    function setMenuItems($menuItems)
    {
        $this->_menuItems = $menuItems;
    }

    function getMenuItems()
    {
        return $this->_menuItems;
    }

    function addPageItem($values)
    {
        $this->_menuItems->addPage($values);
    }

    function addPageItemToId($values)
    {
        $this->_menuItems->findBy('id', $values['parentItem'])->addPage($values);
    }

    function findPageById($id) {
        return $this->_menuItems->findBy('id', $id);
    }


}

?>