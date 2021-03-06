<?php

namespace App\Services\Business;

use App\Model\InterestGroup;
use App\Services\Data\InterestGroupDataService;
use App\Services\Utility\MyLogger2;
use App\Services\Utility\db_connector;

class InterestGroupBusinessService
{
    
    /**
     * Get the list of Interest Groups
     * 
     * @return $listOfGroups
     */
    public function gatherGroupList() 
    {
        MyLogger2::info("Enter InterestBusinessService.gatherGroupList()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $listOfGroups = $dataService->findAllGroups();
        
        // Close the Connection
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.gatherGroupList()");
        
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
        MyLogger2::info("Enter InterestBusinessService.gatherGroup()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $group = $dataService->findInterestGroupByID($igid);
        
        // Close the Connection
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.gatherGroup()");
        
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
        MyLogger2::info("Enter InterestBusinessService.gatherUsers()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findUsersByGroup
        $dataService = new InterestGroupDataService($conn);
        $users = $dataService->findUsersByGroup($igid);
        
        // Close the Connection
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.gatherUsers()");
        
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
        MyLogger2::info("Enter InterestBusinessService.joinGroup()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findUsersByGroup
        $dataService = new InterestGroupDataService($conn);
        $users = $dataService->addInterestedUser($igid);
        
        // Close the Connection
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.joinGroup()");
        
        // Return the array of results-
        return $users;
    }
    
    
    /**
     * Create a new Interest Group. 
     * @return $result
     */
    public function addition(InterestGroup $interestGroup)
    {
        MyLogger2::info("Enter InterestBusinessService.addition()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to findAllGroups
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->create($interestGroup);
        
        // Close the Connection
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.addition()");
        
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
        MyLogger2::info("Enter InterestBusinessService.modify()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to update the interest Group's information:
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->update($interestGroup);
        
        // Close the Connection: 
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.modify()");
        
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
        MyLogger2::info("Enter InterestBusinessService.remove()");
        
        // Create a database connection object
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DataService to update the interest Group's information:
        $dataService = new InterestGroupDataService($conn);
        $result = $dataService->delete($interestGroup_id);
        
        // Close the Connection:
        $conn = null;
        
        MyLogger2::info("Exit InterestBusinessService.remove()");
        
        // Return the array of results:
        return $result;
    }
}