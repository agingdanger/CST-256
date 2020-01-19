<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Data\UserDataService;
use App\Services\Business\UserBusinessService;

class UserController extends Controller
{
    //
    
    // Creating a login Controller method: 
    public function onLogin(Request $request) 
    {
        // Calling Business Services -
        $user = new SecurityService();
        $user->authenticate($request);
        
    }
    
    public function onRegister(Request $request)
    {
        $user = new UserBusinessService();
        $user->register($request);
    }
}
