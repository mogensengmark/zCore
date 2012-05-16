<?php

/**
 * Datamodel for handling user data
 */

class Application_Model_User
{
    private $_username;
    private $_password;
    private $_userRights;
    private $_name;

    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setUserRights($userRights)
    {
        /**
         * PLEASE ENSURE THAT RIGHTS ARE PROVIDED AS AN ARRAY
         */
        $this->_userRights = $userRights;
    }

    public function getAllUserRights()
    {
        return $this->_userRights;
    }

    public function validateUserRight($userRight)
    {
        return in_array($userRight, $this->_userRights);
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getName()
    {
        return $this->_name;
    }

}


?>
