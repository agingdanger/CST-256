<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Services\Business\AdminBusinessService;
use App\Model\User;
use App\Model\Job;

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
    
    public function onJobAddition(Request $request) 
    {
        // Call the Validation Rules: 
        
        
        try 
        {
            // Store all the Requested info into Variables:
            $jobId = $request->input('id');
            $jobName = $request->input('jobname');
            $jobDesc = $request->input('description');
            $jobComp = $request->input('company');
            $jobRequire = $request->input('requirements');
            $jobSkills = $request->input('skills');
            
            // Create Job Object: 
            $job = new Job($jobId, $jobName, $jobDesc, $jobComp, $jobRequire, $jobSkills);
            
            // Send it to Business Service to Add the Job: 
            $service = new AdminBusinessService();
            $result = $service->publishJob($job);
            $jobsData = $service->populateJobs();
            
            
            if($result)
            {
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
                return view('common.error');
            
        } 
        catch (Exception $e) 
        {
            throw $e->getMessage();
        }
    }
    
    
    public function onViewJobList()
    {
        // Call the Validation Rules:
        
        
        /* try
        { */
            // Check to see if the Session's Role is an Admin: 
            if(Session::get('role') == "admin")
            {
                // Call a business service and populate with jobs within a table: 
                $service = new AdminBusinessService();
                $jobsData = $service->populateJobs();
            }
            else
            {
                return view('error.privilege');
            }
            
            return view('job.jobs')->with('jobs', $jobsData);
        /* }
        catch (Exception $e)
        {
            throw $e->getMessage();
        } */
    }
}
