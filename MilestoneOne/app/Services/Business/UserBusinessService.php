<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Services\Data\UserDataService;
use App\Model\User;

class UserBusinessService
{
    /**
     * register business service method: Creating a user in the database. 
     * @param User $user
     * @return boolean
     */
    public function register(User $user)
    {
        $userData = new UserDataService();
        $isRegistered = $userData->create($user);
        
        if($isRegistered)
        {
            return true;
        }
        return false; 
    }
}