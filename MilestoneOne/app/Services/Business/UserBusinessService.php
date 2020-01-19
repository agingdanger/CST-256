<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Services\Data\UserDataService;

class UserBusinessService
{
    public function register(Request $request)
    {
        $userData = new UserDataService();
        $isRegistered = $userData->create($request);
        
        if($isRegistered)
        {
            return true;
        }
        return false; 
    }
}