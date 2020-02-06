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
            return true;
        }
        else
        {
            return false;
        }
    }
}