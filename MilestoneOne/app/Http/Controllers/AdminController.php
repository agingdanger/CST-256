<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
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
            if (Session::get('role') == "admin")
            {
                $adminBusiness = new AdminBusinessService();
                $userData = $adminBusiness->populate();
            }
            else
            {
                return view('error.privilege');
            }

            // if
            if ($userData)
            {
                $message = "Login Success";
            }
            else
            {
                $message = "Login Failure";
            }

            return view('admin.displayUsers')->with('users', $userData);
        }
        catch (Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * TO BE IMPLEMENTED | IS NOT USED FOR NOW
     *
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

            // Create a User Object:
            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            // Get the role from Session:
            if (Session::get('role') == "admin")
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

            if ($userPull)
            {
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                return view('error.privilege');
            }
        }
        catch (Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Delete the User from the Table.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
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

            // Create a User Object:
            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

            $adminBusiness = new AdminBusinessService();
            $userRemove = $adminBusiness->remove($user);
            $userData = $adminBusiness->populate();

            if ($userRemove)
            {
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                return view('error.privilege');
            }
        }
        catch (Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Suspend a user
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onSuspension(Request $request)
    {
        try
        {
            if (Session::get('role') == "admin")
            {
                $id = $request->input('id');
                $firstName = $request->input('firstname');
                $lastName = $request->input('lastname');
                $username = $request->input('username');
                $password = $request->input('password');
                $email = $request->input('email');
                $phone = $request->input('phone');
                $role = $request->input('role');

                // Create a User Object:
                $user = new User($id, $firstName, $lastName, $username, $password, $email, $phone, $role);

                // Calling the Business service
                $adminBusiness = new AdminBusinessService();

                $role = $user->getRole();
                if ($role == "suspended")
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

            if ($userSuspend)
            {
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                return view('error.privilege');
            }
        }
        catch (Exception $e)
        {
            return view('error.commonError');
        }
    }

    /**
     * Add a Job after the Admin clicks on the "Add a Job" from Jobs page.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onJobAddition(Request $request)
    {
        // Call the Validation Rules:
//         $this->validateJobForm($request);

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

            if ($result)
            {
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
                return view('common.error');
        }
        catch (ValidationException $el)
        {
            throw $el;
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * View the list of Jobs from the database
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewJobList()
    {
        // Call the Validation Rules:
        try
        {
            // Call a business service and populate with jobs within a table:
            $service = new AdminBusinessService();
            $jobsData = $service->populateJobs();

            return view('job.jobs')->with('jobs', $jobsData);
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Open up the EditJobForm page after clicking on "Edit" from Jobs page.
     * Note: This does NOT Edit the Job yet. It only takes the admin to the
     * EditJobForm.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewEditJob(Request $request)
    {
        // Call the Validation Rules:
        try
        {
            // Store the information from hidden values into a Job object:
            $jobId = $request->input('id');
            $jobName = $request->input('jobname');
            $jobDesc = $request->input('description');
            $jobComp = $request->input('company');
            $jobRequire = $request->input('requirements');
            $jobSkills = $request->input('skills');

            // Create a Job Object:
            $job = new Job($jobId, $jobName, $jobDesc, $jobComp, $jobRequire, $jobSkills);

            return view('job.editJobForm')->with('job', $job);
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onEditJobPost(Request $request)
    {
        // Call the Validation Rules:
        try
        {
            // Store the information from hidden values into a Job object:
            $jobId = $request->input('jobid');
            $jobName = $request->input('jobname');
            $jobDesc = $request->input('description');
            $jobComp = $request->input('company');
            $jobRequire = $request->input('requirements');
            $jobSkills = $request->input('skills');

            // Create a Job Object:
            $job = new Job($jobId, $jobName, $jobDesc, $jobComp, $jobRequire, $jobSkills);

            // Send it to Business Service to Edit the Job:
            $service = new AdminBusinessService();
            $result = $service->jobModify($job);

            $jobsData = $service->populateJobs();

            // Check if Result is true:
            if ($result)
            {
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
            {
                $message = "Please check the information again.";
                return view('job.jobs')->with('message', $message);
            }
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Deleting Job after Admin clicks on "Delete"
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onJobDeletion(Request $request)
    {
        // Call the Validation Rules:
        try
        {
            // Store the information from hidden values into a Job object:
            $jobId = $request->input('id');
            $jobName = $request->input('job');
            $jobDesc = $request->input('description');
            $jobComp = $request->input('company');
            $jobRequire = $request->input('requirements');
            $jobSkills = $request->input('skills');

            // Create a Job Object:
            $job = new Job($jobId, $jobName, $jobDesc, $jobComp, $jobRequire, $jobSkills);

            // Send it to Business Service to Edit the Job:
            $service = new AdminBusinessService();
            $result = $service->obliterateJob($job);

            $jobsData = $service->populateJobs();

            // Check if Result is true:
            if ($result)
            {
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
            {
                $message = "Please check the information again.";
                return view('job.jobs')->with('message', $message);
            }
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Private Method to store the Rules of Job Forms' Validation:
     *
     * @param Request $request
     */
    private function validateJobForm(Request $request)
    {
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules

        // Setup Data Validation Rules for Login Form.
        $rules = [
            'jobname' => 'Required | Max: 20 | Alpha',
            'description' => 'Required | Size: 1000',
            'company' => 'Required | Between: 4, 20 | Alpha',
            'requirements' => 'Required | Max: 50 | Alpha',
            'skills' => 'Required | Between: 3, 50 | Alpha' 
        ];

        // Run Validation Rules:
        $this->validate($request, $rules);
    }
}
