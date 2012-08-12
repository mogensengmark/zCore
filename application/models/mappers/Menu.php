<?php

/**
 *
 * Class for mapping menu model with database
 * @author Mogens Engmark
 *
 */
class Application_Model_Mapper_Menu {

    // Database
    private $_db;
    // Menu data
    private $_menuData;

    // Loads default database
    function __construct() {
        // Loads db
        $this->_db = Zend_Registry::get('db');
        // Defines default menuData
        $this->_menuData = array();
    }

    // Loads menu for a given organisation
    function getMenu($organisationId) {
        $sql = "
    		SELECT
                    menuitems.menuItemId,
                    menuitems.menuItemLabel,
                    menuitems.menuItemController,
                    menuitems.menuItemAction,
                    menuitems.menuItemParameters,
                    `menus-menuitems-map`.menuItemWeight,
                    `menus-menuitems-map`.fk_parentItemId
                FROM
                    menus
                    INNER JOIN `menus-menuitems-map` ON `menus-menuitems-map`.fk_menusId = menus.menuId
                    INNER JOIN menuitems ON menuitems.menuItemId = `menus-menuitems-map`.fk_menuItemsId
                    WHERE
                        menus.fk_organisationId = ?
                    ORDER BY
                        `menus-menuitems-map`.fk_parentItemId,
                        `menus-menuitems-map`.menuItemWeight";

        // Enforcing right organisation
        $organisationId = 2;
        
        // Preparing and executing statement
        $statement = $this->_db->prepare($sql);
        $statement->execute(array($organisationId));

        // Pulls result
        $result = $statement->fetchAll();
        /**
          echo "DATABASE:";
          Zend_Debug::dump($result);
          /* */
        // Loading Pages model
        $menuModel = new Application_Model_Menu();

        // Establishing menu structure
        // It is expected that the database returns entries ordered by parentItemId
        // Sorting into sections
        foreach ($result as $menuElement) {
            $rawMenuData = array(
                'id' => $menuElement['menuItemId'],
                'label' => $menuElement['menuItemLabel'],
                'controller' => $menuElement['menuItemController'],
                'action' => $menuElement['menuItemAction'],
                'order' => $menuElement['menuItemWeight'],
                'parentItem' => $menuElement['fk_parentItemId'],
                'pages' => array()
            );

            // Is parentId 0?
            if ($rawMenuData['parentItem'] == '0') {
                // Toplevel menu item
                $menuModel->addPageItem($rawMenuData);
            } else {
                $menuModel->addPageItemToId($rawMenuData);
            }
        }
        /**
          echo "MODEL:";
          Zend_Debug::dump($menuModel->getMenuItems());
          /* */
        // Do we need to return this?
        // How about caching menu?
        return $menuModel->getMenuItems();
        //return $menuData;
    }

}

?>