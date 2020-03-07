<?php

namespace App\Services\Business;

use App\Services\Utility\db_connector;
use App\Services\Data\InterestGroupDataService;

class InterestGroupBusinessService
{
    public function gatherGroupList($param) 
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->findAllGroups();
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $result;
    }
}