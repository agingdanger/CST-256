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
        $isLoggedIn = $user->authenticate($request);
    }

    public function onRegister(Request $request)
    {
        $user = new UserBusinessService();
        $isRegisterAttempt = $user->register($request);

        
        if ($isRegisterAttempt)
        {
            return view('registerstatus')->with('message', $message = "Registered Successfully!");
        }
        return view('registerstatus')->with('message', $message = "Did not register. Try again.");
    }
}
