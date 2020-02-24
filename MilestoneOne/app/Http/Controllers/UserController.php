<?php

/*
 * Reuel Maddela and Charles Henderson
 * CST-256: Database Application Programming-III
 * 02/08/2020.
 * Professor Mark Reha
 * This is our own work. 
 */

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\userCredentials;
use App\Services\Business\SecurityService;
use App\Services\Business\UserBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Dotenv\Exception\ValidationException;

/**
 *
 * @author mrabi, agingdanger
 * User controller will handle all authenticate method
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
        // Call the ValidateForm:
        $this->validateForm($request);
        
        try
        {
            // Calling Business Services -
            $userAttempt = new userCredentials($request->input('username'), $request->input('password'));

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
        catch(ValidationException $el)
        {
            throw $el;
        }
        catch(Exception $e)
        {
            // Return the Error Page: 
            return view('error.commonError');
        }
    }

    /**
     * onRegister Controller method that is used for registration.
     *
     * @param Request $request
     * @return view('registerstatus') with a message.
     */
    public function onRegister(Request $request)
    {
        // Call the ValidateForm:
        $this->validateForm($request);
        
        try
        {
            // Get the request data into variables
            $id = "";
            $firstName = $request->input('firstname');
            $lastName = $request->input('lastname');
            $username = $request->input('username');
            $password = $request->input('password');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = $request->input('role');

            // Create a User object and populate it with the requested data.
            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            // Call the Business Service to register
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
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Edit method to be able to make changes to the current User profile data.
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onEdit(Request $request)
    {
        // Call the ValidateForm:
        $this->validateForm($request);
        
        try
        {
            /*
             * Check if it's the Admin and if it is the User editing his own profile
             */
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

                // Create a User Object and populate the data
                $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

                // Call the Business Service to modify the changes
                $userBusiness = new UserBusinessService();
                $userData = $userBusiness->modify($user);

                // Use the Profile Business method to view the new Profile changes. 
                $userData = $userBusiness->profile($user);

                // translate query array into object
                $userData = get_object_vars($userData);

                // Check if there is UserData brought from the Business Service.
                if($userData)
                {
                    return view('users.profile')->with('user', $userData);
                }
                return view('error.commonError');
            }
            // This else is if a non-Admin or another user tries to edit other's accounts.
            else
            {
                return view('error.privilege');
            }
        }
        catch(Exception $e)
        {
            // Redirect to the Common Error Page:
            return view('error.commonError');
        }
    }

    /**
     * Navigate to user profile page from displayUsers page
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onNavigate(Request $request)
    {
        try
        {
            $id = $request->input('id');
            $firstName = $request->input('firstname');
            $lastName = $request->input('lastname');
            $username = $request->input('username');
            $password = $request->input('password');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = $request->input('role');

            // Create a User Object and populate the data
            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            return view('home.account')->with('user', $user);
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Generate the Profile from Navbar based on the Session ID of the User.
     *
     * @param Request $request
     */
    public function onProfile(Request $request)
    {
        try
        {
            // Create a User object
            $user = new User(Session::get('userID'), "", "", "", "", "", "", "", "");

            // Call the User Business Service to access the profile:
            $userBusiness = new UserBusinessService();
            $userData = $userBusiness->profile($user);

            // // translate query array into object
            if($userData)
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
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    
    /**
     * Validation function that can be reused
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'username' => 'Required | Between: 4, 10 | Alpha',
            'password' => 'Required | Between: 4, 10', 
            'firstname' => 'Required | Between: 4, 10 | Alpha',
            'lastname' => 'Required | Between: 4, 10 | Alpha',
            'email' => 'Required | Between: 3, 20 | E-Mail',
            'phone' => 'Required | Digits: 10', 
            'role' => 'Required | Max: 5 | Alpha'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
    }
}
