<?php
namespace App\Services\Business;

use Illuminate\Http\Request;
use App\Services\Data\UserDataService;
use App\Services\Data\AdminDataService;
use App\Model\User;
use App\Services\Utility\db_connector;

class UserBusinessService
{

    /**
     * register business service method: Creating a user in the database.
     *
     * @param User $user
     * @return boolean
     */
    public function register(User $user)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $userData = new UserDataService($conn);

        $isRegistered = $userData->create($user);

        $conn = null;

        if($isRegistered)
        {
            return true;
        }
        return false;
    }

    /**
     * 
     * @param User $user
     * @return boolean
     */
    public function modify(User $user)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $userService = new UserDataService($conn);
        
        $userData = $userService->update($user);
        
        $conn = null;
        
        return $userData;
    }

    /**
     * 
     * @param User $user
     * @return \App\Services\Data\$result|boolean
     */
    public function profile(User $user)
    {
        // Create the database connection object.
        $db = new db_connector();
        $conn = $db->getConnection();

        // Call the User Data Service to findById:
        $service = new UserDataService($conn);
        $result = $service->findById($user);

        // if Result has some value, which it should, it should return
        if($result)
            return $result;
        else
            return false;
    }
    
    public function search($param)
    {
        // Create the database connection object.
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the User Data Service to findById:
        $service = new AdminDataService($conn);
        $result = $service->findJob($param);
        
        // if Result has some value, which it should, it should return
        if($result)
            return $result;
        else
            return false;
    }
    
    public function getAllUsers() 
    {
        ;
    }
}