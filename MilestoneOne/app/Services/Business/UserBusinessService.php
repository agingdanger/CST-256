<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Services\Data\UserDataService;

class UserBusinessService
{
    public function register(Request $request)
    {
        $userData = new UserDataService();
        $userData->create($request);
    }
}