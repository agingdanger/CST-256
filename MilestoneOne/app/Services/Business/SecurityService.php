<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Model\User;
use App\Services\Data\UserDataService;
use App\Model\userAttempt;
use App\Services\Utility\db_connector;


class SecurityService
{
    /**
     * Authenticate function to authenticate entered login credentials. 
     * @param userAttempt $userAttempt
     * @return boolean
     */
    public function authenticate(userAttempt $userAttempt)
    {        
        $db = new db_connector();
        $conn = $db->getConnection();
        $userData = new UserDataService($conn);
        
        $result = $userData->findbyUser($userAttempt);
        
        // Close the PDO connection
        $conn = null;
        
        
        
        if (($result))
        {

            //Will be used later to set Session variables for the current user
            /* $_SESSION['firstName'] = $row['FIRSTNAME'];
            $_SESSION['lastName'] = $row['LASTNAME'];
            $_SESSION['username'] = $row['USERNAME'];
            $_SESSION['password'] = $row['PASSWORD'];
            $_SESSION['email'] = $row['EMAIL'];
            $_SESSION['phone'] = $row['PHONE'];
            $_SESSION['role'] = $row['ROLE']; */
            
            return $result;
        }
        else
        {
            return false;
        }
    }
}