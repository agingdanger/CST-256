<?php

namespace App\Services\Business;

use App\Services\Utility\db_connector;
use App\Services\Data\InterestGroupDataService;

class InterestGroupBusinessService
{
    /**
     * 
     * @return $listOfGroups
     */
    public function gatherGroupList() 
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $listOfGroups = $dataService->findAllGroups();
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $listOfGroups;
    }
    
    public function interestGroupAddition()
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->create();
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $result;
    }
}