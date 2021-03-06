<?php
namespace App\Services\Business;

use App\Model\User;
use App\Services\Data\AdminDataService;
use App\Services\Data\UserDataService;
use App\Services\Utility\MyLogger2;
use App\Services\Utility\db_connector;
use App\Services\Utility\ILoggerService;

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
        MyLogger2::info("Enter UserBusinessService.register()");
        
        // Call the database connection
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DAO to create a User in the database
        $userData = new UserDataService($conn);
        $isRegistered = $userData->create($user);

        // Close the PDO Connection
        $conn = null;

        if ($isRegistered)
        {
            MyLogger2::info("Exit UserBusinessService.register() with true.");
            return true;
        }
        
        MyLogger2::info("Exit UserBusinessService.register() with false.");
        return false;
    }

    /**
     *
     * @param User $user
     * @return boolean
     */
    public function modify(User $user)
    {
        MyLogger2::info("Enter UserBusinessService.modify()");
        
        // Call the database connection
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DAO to update a User's info
        $userService = new UserDataService($conn);
        $userData = $userService->update($user);

        // Close the PDO connection
        $conn = null;

        MyLogger2::info("Exit UserBusinessService.modify()");
        return $userData;
    }

    /**
     *
     * @param User $user
     * @return \App\Services\Data\$result|boolean
     */
    public function profile(User $user)
    {
        MyLogger2::info("Enter UserBusinessService.profile()");
        
        // Create the database connection object.
        $db = new db_connector();
        $conn = $db->getConnection();

        // Call the User Data Service to findById:
        $service = new UserDataService($conn);
        $result = $service->findById($user);
        
        // Close the PDO Connection
        $conn = null;

        // if Result has some value, which it should, it should return
        if ($result)
        {
            MyLogger2::info("Exit UserBusinessService.profile() with true");
            return $result;
        }
        else
        {
            MyLogger2::info("Exit UserBusinessService.profile() with false");
            return false;
        }
    }

    public function search($param)
    {
        MyLogger2::info("Enter UserBusinessService.search()");
        
        // Create the database connection object.
        $db = new db_connector();
        $conn = $db->getConnection();

        // Call the User Data Service to findById:
        $service = new AdminDataService($conn);
        $result = $service->findJob($param);
        
        // Close the PDO Connection
        $conn = null;

        // if Result has some value, which it should, it should return
        if ($result)
        {
            MyLogger2::info("Exit UserBusinessService.search() with true");
            return $result;
        }
        else
        {
            MyLogger2::info("Exit UserBusinessService.search() with false");
            return false;
        }
    }

    /** -------------------------------- REST Business Methods -------------------------------- **/
    
    /**
     * 
     * 
     * @return array|\App\Model\User[]
     */
    public function getAllUsers()
    {
        MyLogger2::info("Enter UserBusinessService.getAllUsers()");
        
        // Create the database connection object.
        $db = new db_connector();
        $conn = $db->getConnection();

        // Call the User Data Service to findAllUsers:
        $service = new UserDataService($conn);
        $users = $service->findAllUsers();

        // Close the PDO Connection
        $conn = null;
        
        MyLogger2::info("Exit UserBusinessService.getAllUsers()");
        
        // Return the result
        return $users;
    }
    
    /**
     * 
     * 
     * @param $id
     * @return \App\Services\Data\$user|\App\Model\User
     */
    public function getUserByID($id)
    {
        MyLogger2::info("Enter UserBusinessService.getUserByID()");
        
        // Create the database connection object.
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the User Data Service to findByUserID:
        $service = new UserDataService($conn);
        $users = $service->findByUserID($id);
        
        // Close the PDO Connection
        $conn = null;
        
        MyLogger2::info("Exit UserBusinessService.getUserByID()");
        
        // Return the result
        return $users;
    }
}