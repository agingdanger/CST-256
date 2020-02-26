<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Model\User;
use App\Services\Data\UserDataService;
use App\Model\userCredentials;
use App\Services\Utility\db_connector;


class SecurityService
{
    /**
     * Authenticate function to authenticate entered login credentials. 
     * @param userCredentials $userAttempt
     * @return boolean
     */
    public function authenticate(userCredentials $userAttempt)
    {        
        $db = new db_connector();
        $conn = $db->getConnection();
        $userData = new UserDataService($conn);
        
        $result = $userData->findbyUser($userAttempt);
        
        // Close the PDO connection
        $conn = null;

        if (($result))
        {   
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
}