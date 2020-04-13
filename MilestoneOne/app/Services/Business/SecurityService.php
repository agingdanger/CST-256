<?php
namespace App\Services\Business;

use App\Model\userCredentials;
use App\Services\Data\UserDataService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use App\Services\Utility\db_connector;

class SecurityService
{    
    /**
     * Authenticate function to authenticate entered login credentials.
     *
     * @param userCredentials $userAttempt
     * @return boolean
     */
    public function authenticate(userCredentials $userAttempt)
    {
        MyLogger2::info("Enter SecurityService.authenticate()");
        
        // Call the database connection
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DAO to find by UserCredentials
        $userData = new UserDataService($conn);
        $result = $userData->findbyUserCredentials($userAttempt);

        // Close the PDO connection
        $conn = null;

        if (($result))
        {
            MyLogger2::info("Exit SecurityService.authenticate() successfully");
            return $result;
        }
        else
        {
            MyLogger2::info("Exit SecurityService.authenticate() unsuccessfully");
            return FALSE;
        }
    }
}