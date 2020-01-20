<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Data\UserDataService;
use App\Services\Business\UserBusinessService;
use App\Model\User;
use App\Model\userAttempt;

/**
 *
 * @author mrabi
 * User controller will handle all authenticate method
 */
class UserController extends Controller
{
    /**
     * Creating a login Controller method:
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onLogin(Request $request)
    {
        // Calling Business Services -
        $userAttempt = new userAttempt($request->input('username'), $request->input('password'));

        // $userAttempt = new userAttempt($username, $password);

        $user = new SecurityService();
        $isLoggedIn = $user->authenticate($userAttempt);

        if ($isLoggedIn)
        {
            $message = "Login Success";
        } else
        {
            $message = "Login Failure";
        }
        return view('loginStatus')->with('message', $message);
    }

    /**
     * onRegister Controller method that is used for registration. 
     * @param Request $request
     * @return view('registerstatus') with a message. 
     */
    public function onRegister(Request $request)
    {
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = $request->input('role');
        
        $user = new User($firstName, $lastName, $username, $password, $email, $phone, $role);
        
        $userBusiness = new UserBusinessService();
        $isRegisterAttempt = $userBusiness->register($user);

        // if Registration process is true. 
        if ($isRegisterAttempt)
        {
            return view('registerstatus')->with('message', $message = "Registered Successfully!");
        }
        return view('registerstatus')->with('message', $message = "Did not register. Try again.");
    }
}
