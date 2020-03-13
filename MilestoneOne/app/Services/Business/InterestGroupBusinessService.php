<?php

namespace App\Services\Business;

use App\Services\Utility\db_connector;
use App\Services\Data\InterestGroupDataService;
use App\Model\InterestGroup;

class InterestGroupBusinessService
{
    /**
     * Get the list of Interest Groups
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
     * Get the group from the database.
     *
     * @return $listOfGroups
     */
    public function gatherGroup($igid)
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $group = $dataService->findInterestGroupByID($igid);
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $group;
    }
    
    /**
     * Returns the Members of a specific Group to controller method
     * 
     * @return $users
     */
    public function gatherUsers($igid)
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findUsersByGroup
        $dataService = new InterestGroupDataService($conn);
        $users = $dataService->findUsersByGroup($igid);
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $users;
    }
    
    /**
     * Add a User to the Group. 
     * 
     * @param $igid
     * @return boolean
     */
    public function joinGroup($igid)
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findUsersByGroup
        $dataService = new InterestGroupDataService($conn);
        $users = $dataService->addInterestedUser($igid);
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $users;
    }
    
    
    /**
     * Create a new Interest Group. 
     * @return $result
     */
    public function addition(InterestGroup $interestGroup)
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->create($interestGroup);
        
        // Close the Connection
        $conn = null;
        
        // Return the array of results-
        return $result;
    }
    
    /**
     * Modify the Interest Group's info.
     * 
     * @param InterestGroup $interestGroup
     * @return boolean
     */
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
    
    /**
     * Remove the Interest Group
     * 
     * @param $interestGroup_id
     * @return boolean
     */
    public function remove($interestGroup_id)
    {
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to update the interest Group's information:
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->delete($interestGroup_id);
        
        // Close the Connection:
        $conn = null;
        
        // Return the array of results:
        return $result;
    }
}