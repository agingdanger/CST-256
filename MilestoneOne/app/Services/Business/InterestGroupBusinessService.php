<?php

namespace App\Services\Business;

use App\Services\Utility\db_connector;
use App\Services\Data\InterestGroupDataService;
use App\Model\InterestGroup;

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
    
    /**
     * 
     * @return $result
     */
    public function addition()
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
    
    public function modify(InterestGroup $interestGroup) 
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to update the interest Group's information:
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->update($interestGroup);
        
        // Close the Connection: 
        $conn = null;
        
        // Return the array of results: 
        return $result;
    }
}