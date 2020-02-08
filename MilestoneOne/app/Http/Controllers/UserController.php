<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\SecurityService;
use App\Services\Data\UserDataService;
use App\Services\Business\UserBusinessService;
use App\Model\User;
use App\Model\userAttempt;

/**
 *
 * @author mrabi
 *         User controller will handle all authenticate method
 */
class UserController extends Controller
{

    /**
     * Creating a login Controller method:
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onLogin(Request $request)
    {

        // Calling Business Services -
        $userAttempt = new userAttempt($request->input('username'), $request->input('password'));
        
        $service = new SecurityService();
        $userData = $service->authenticate($userAttempt);

        if(! $userData)
            return view('login.loginStatus')->with('message', "Login Failure");

        // translate query array into object
        $userData = get_object_vars($userData);

        if($userData['ROLE'] == "suspended")
        {
            return view('error.suspended');
        }

        // Creating sessions here to get the user's ID & Role.
        Session::put('userID', $userData['ID']);
        Session::put('role', $userData['ROLE']);      

        return view('home.home')->with('user', $userData);
    }

    /**
     * onRegister Controller method that is used for registration.
     *
     * @param Request $request
     * @return view('registerstatus') with a message.
     */
    public function onRegister(Request $request)
    {
        $id = "";
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = $request->input('role');

        $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

        $userBusiness = new UserBusinessService();
        $isRegisterAttempt = $userBusiness->register($user);

        // if Registration process is true.
        if($isRegisterAttempt)
        {
            Session::put('role', $request->input('role'));
            return view('registration.registerstatus')->with('message', $message = "Registered Successfully!");
        }
        return view('registration.registerstatus')->with('message', $message = "Did not register. Try again.");
    }

    public function onEdit(Request $request)
    {
        if(Session::get('role') == "admin" || Session::get('userID') == $request->input('id'))
        {
            $id = $request->input('id');
            $firstName = $request->input('firstname');
            $lastName = $request->input('lastname');
            $username = $request->input('username');
            $password = $request->input('password');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = $request->input('role');

            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            $userBusiness = new UserBusinessService();
            $userData = $userBusiness->modify($user);

            if($userData)
            {
                return view('users.profile')->with('user', $userData);
            }
            return view('error.commonError');
        }
        else
        {
            return view('error.privilege');
        }
    }

    public function onNavigate(Request $request)
    {
        $id = $request->input('id');
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = $request->input('role');

        $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

        return view('users.profile')->with('user', $user);
    }
    
    /**
     * Generate the Profile from Navbar based on the Session ID of the User.
     * @param Request $request
     */
    public function onProfile(Request $request)
    {
        // Create a User object
        $user = new User(Session::get('userID'), "", "", "", "", "", "", "", "");
        
        // Call the User Business Service to access the profile:
        $userBusiness = new UserBusinessService();
        $userData = $userBusiness->profile($user);
        
        // translate query array into object
        $userData = get_object_vars($userData);
        
        // if there is a result, then return the profile View
        if($userData)
        {
            return view('users.profile')->with('user', $userData);
        }
        else
        {
            return view('error.commonError');
        }
    }
}
