<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Services\Business\AdminBusinessService;
use App\Model\User;

class AdminController extends Controller
{

    /**
     * onUsersPull's purpose is for the Admin to view the datatable of Users.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onUsersPull(Request $request)
    {
        try
        {
            // Check if the user is Admin; then only move on to the Business Service
            // If not, send the user to a privilege view page.
            if(Session::get('role') == "admin")
            {
                $adminBusiness = new AdminBusinessService();
                $userData = $adminBusiness->populate();
            }
            else
            {
                return view('error.privilege');
            }

            // if
            if($userData)
            {
                $message = "Login Success";
            }
            else
            {
                $message = "Login Failure";
            }

            return view('admin.displayUsers')->with('users', $userData);
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     *  TO BE IMPLEMENTED | IS NOT USED FOR NOW
     * @param Request $request
     */
    public function onEdit(Request $request)
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

            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            // Get the role from Session:
            if(Session::get('role') == "admin")
            {
                // Call to BusinessService
                $adminBusiness = new AdminBusinessService();
                $userPull = $adminBusiness->modify($user);
            }
            else
            {
                return view('error.privilege');
            }
            // $adminBusiness = new AdminBusinessService();
            // $userPull = $adminBusiness->modify($user);

            $userData = $adminBusiness->populate();

            if($userPull)
            {
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                return view('error.privilege');
            }
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Delete the User from the Table. 
     * @param Request $request
     */
    public function onRemoval(Request $request)
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

            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            $adminBusiness = new AdminBusinessService();
            $userRemove = $adminBusiness->remove($user);
            $userData = $adminBusiness->populate();

            if($userRemove)
            {
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                return view('error.privilege');
            }
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Suspend a user
     *
     * @param Request $request
     */
    public function onSuspension(Request $request)
    {
        try
        {
            if(Session::get('role') == "admin")
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

                // Calling the Business service
                $adminBusiness = new AdminBusinessService();

                $role = $user->getRole();
                if($role == "suspended")
                {
                    $user->setRole($role = "user");
                }
                else
                {
                    $user->setRole($role = "suspended");
                }
            }
            
            // Suspend the User 
            $userSuspend = $adminBusiness->suspend($user);
            $userData = $adminBusiness->populate();

            if($userSuspend)
            {
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                return view('error.privilege');
            }
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
}
