<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Services\Data\UserDataService;
use App\Model\User;
use App\Services\Utility\db_connector;

class UserBusinessService
{
    /**
     * register business service method: Creating a user in the database. 
     * @param User $user
     * @return boolean
     */
    public function register(User $user)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $userData = new UserDataService($conn);
        
        $isRegistered = $userData->create($user);
        
        if($isRegistered)
        {
            return true;
        }
            return false; 
    }
}