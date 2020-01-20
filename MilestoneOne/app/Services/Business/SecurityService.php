<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Model\User;
use App\Services\Data\UserDataService;
use App\Model\userAttempt;

class SecurityService
{
    /**
     * Authenticate function to authenticate entered login credentials. 
     * @param userAttempt $userAttempt
     * @return boolean
     */
    public function authenticate(userAttempt $userAttempt)
    {        
        $userData = new UserDataService();
        $result = $userData->findbyId($userAttempt);
        
        if (mysqli_num_rows($result))
        {

            //Will be used later to set Session variables for the current user
            /* $_SESSION['firstName'] = $row['FIRSTNAME'];
            $_SESSION['lastName'] = $row['LASTNAME'];
            $_SESSION['username'] = $row['USERNAME'];
            $_SESSION['password'] = $row['PASSWORD'];
            $_SESSION['email'] = $row['EMAIL'];
            $_SESSION['phone'] = $row['PHONE'];
            $_SESSION['role'] = $row['ROLE']; */
            
            return true;
        }
        else
        {
            return false;
        }
    }
}