<?php
namespace App\Services\Business;

use Illuminate\Http\Request;
use App\Services\Data\AdminDataService;
use App\Model\User;
use App\Services\Utility\db_connector;

class AdminBusinessService
{
    /**
     * Populating the userdata into the datatable
     * 
     * @return $userData
     */
    public function populate()
    {
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService. 
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Sending it to Data Service: 
        $adminData = new AdminDataService($conn);
        $userData = $adminData->findAll();
        
        // Close the PDO connection
        $conn = null;
        
        return $userData;
    }
    
    public function modify(User $user)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $adminData = new AdminDataService($conn);
        
        $userData = $adminData->update($user);
        
        $conn = null;
        
        return $userData;
    }
    
    /**
     * 
     * @param User $user
     */
    public function suspend(User $user)
    {
        
        // Take the UserID and pass it to dataservice.
        $db = new db_connector();
        $conn = $db->getConnection();
        
        $service = new AdminDataService($conn);
        $adminData = $service->update($user);
        
        $conn = null;
        
        return $adminData;
        
    }
    
    public function remove(User $user)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        
        $service = new AdminDataService($conn);
        $adminData = $service->delete($user);
        $conn = null;
        
        return $adminData;
    }
}