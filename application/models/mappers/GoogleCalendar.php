<?php

/**
 * Class for mapping Google Calendar data to use in a given controller :)
 * @author: Mogens Engmark
 */

class Application_Model_Mapper_GoogleCalendar {
    // Calendar to retrieve data from
    private $_client;
    // Query 
    private $_query;
    
    function __construct($user, $pass) {
        // Service type
        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        
        // Can we get a proper calendar object?
        try
        {
            $client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$service);			
        }
        catch(Exception $e)
        {
            // prevent Google username and password from being displayed if a problem occurs
            // I'M NOT SURE IF THIS IS THE RIGHT WAY TO DO IT!!!!!!!
            echo "Could not connect to calendar.";
            die();
        }
        
        // Inintialize calendar instance.
        $gdataCal = new Zend_Gdata_Calendar($client);
 
        $this->_query = $gdataCal->newEventQuery();

        
    }
    
    // Assigning calendar to query to be sure, that this is the correct calendar, we are manipulating
    function setCalendar($calendar)
    {
        $this->_query->setUser($calendar); 
    }
    
    // Setting calendar visibility
    function setVisibility($value = NULL)
    {
        $this->_query->setVisibility($value);
    }
    
    
    function setProjection($value = NULL)
    {
        $this->_query->setProjection(NULL); 
    }
    
    function setStartDate($startDate)
    {
        $this->_query->setStartMin($startDate);
    }
    
    function setEndDate($endDate)
    {
        $this->_query->setStartMax($endDate);
    }
    
    function setOrderBy($param)
    {
        $query->setOrderby($param);
    }	
    
    
}


?>
