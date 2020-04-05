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
use App\Services\Utility\ILoggerService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Exception;

/**
 *
 * @author mrabi, agingdanger
 * User controller will handle all authenticate method
 */
class UserController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger) 
    {
        $this->logger = $logger;
    }
    
    /**
     * Creating a login Controller method:
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onLogin(Request $request)
    {
        $this->logger->info("Entered UserController's onLogin()");
        
        // Call the ValidateForm:
        $this->validateLoginForm($request);
        
        try
        {
            // Calling Business Services -
            $userAttempt = new userCredentials($request->input('username'), $request->input('password'));

            $service = new SecurityService();
            $userData = $service->authenticate($userAttempt);

            // If no such User was registered
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
            Session::put('principal', 'true');

            $this->logger->info("Exiting UserController's onLogin()", $userData);
            
            return view('home.home')->with('user', $userData);
        }
        catch(ValidationException $el)
        {
            $this->logger->error("Validation error in UserController's onLogin()");
            throw $el;
        }
        catch(Exception $e)
        {
            $this->logger->error("Error in UserController's onLogin()");
            
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
        $this->logger->info("Entered UserController's onRegister()");
        
        // Call the ValidateForm:
        $this->validateRegistrationForm($request);
        
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
            
            $this->logger->info("Exited UserController's onRegister()");
            
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
        $this->logger->info("Entered UserController's onEdit()");
        
        // This piece of code needs to be used later for validation in the Edit form. 
        /* // Call the ValidateForm:
        $this->validateRegistrationForm($request); */
        
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
                
                $this->logger->info("Exited UserController's onEdit()");
                
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
        $this->logger->info("Entered UserController's onNavigate()");
        
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

            $this->logger->info("Exited UserController's onNavigate()");
            
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
        $this->logger->info("Entered UserController's onProfile()");
        
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
                $this->logger->info("Exiting UserController's onProfile()");
                
                return view('users.profile')->with('user', $userData);
            }
            else 
            {
                $this->logger->info("Exiting UserController's onProfile()");
                
                return view('error.commonError');
            }
            
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    /**
     * Log out the User by killing all the session variables.
     * 
     * @return route: /welcome
     */
    public function onLogout() 
    {
        $this->logger->info("Entered UserController's onLogout()");
        
        try
        {
            // Flush out everything from a session:
            //         session()->flush();
            Session::flush();
            
            $this->logger->info("Exiting UserController's onLogout()");
            
            // Return the logged in Home page:
//             return redirect()->route('welcome');
            return Redirect::to('welcome'); 
        }
        catch(Exception $e)
        {
            throw $e->getCode();
        }
        
    }
    
    /**
     * Validation function that can be reused
     * @param Request $request
     */
    private function validateLoginForm(Request $request)
    {
        $this->logger->info("Entered UserController's validateLoginForm()");
        
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'username' => 'Required | Max: 20 | Alpha',
            'password' => 'Required | Between: 4, 15'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
        
        $this->logger->info("Exiting UserController's validateLoginForm()");
    }
    
    /**
     * Validation function that can be reused
     * @param Request $request
     */
    private function validateRegistrationForm(Request $request)
    {
        $this->logger->info("Entering UserController's validateRegistrationForm()");
        
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'username' => 'Required | Max: 20 | Alpha',
            'password' => 'Required | Between: 4, 15',
            'firstname' => 'Required | Between: 4, 10 | Alpha',
            'lastname' => 'Required | Between: 4, 10 | Alpha',
            'email' => 'Required | Between: 3, 20 | E-Mail',
            'phone' => 'Required | Digits: 10',
            'role' => 'Required | Max: 5 | Alpha'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
        
        $this->logger->info("Exiting UserController's validateRegistrationForm()");
    }
    
    /**
     * Validation function that can be reused
     * @param Request $request
     */
    private function validateEditForm(Request $request)
    {
        $this->logger->info("Entering UserController's validateEditForm()");
        
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'password' => 'Required | Between: 4, 15',
            'firstname' => 'Required | Between: 4, 10 | Alpha',
            'lastname' => 'Required | Between: 4, 10 | Alpha',
            'phone' => 'Required | Digits: 10'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
        
        $this->logger->info("Exiting UserController's validateEditForm()");
    }
    
    
}
