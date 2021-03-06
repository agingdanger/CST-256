<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\Business\AdminBusinessService;
use App\Model\User;
use App\Model\Job;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;


class AdminController extends Controller
{   
    private $logger;
    
    public function __construct(MyLogger2 $logger) 
    {
        $this->logger = $logger;
    }
    
    /**
     * onUsersPull's purpose is for the Admin to view the datatable of Users.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onUsersPull(Request $request)
    {
        $this->logger->info("Entering AdminController.onUsersPull()");
        
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

            $this->logger->info("Exiting AdminController.onUsersPull()");
            
            return view('admin.displayUsers')->with('users', $userData);
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onUsersPull()");
            
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
        $this->logger->info("Entering AdminController.onEdit()");
        
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
                $this->logger->info("Exiting AdminController.onEdit() with error");
                
                return view('error.privilege');
            }
            // $adminBusiness = new AdminBusinessService();
            // $userPull = $adminBusiness->modify($user);

            $userData = $adminBusiness->populate();

            if ($userPull)
            {
                $this->logger->info("Exiting AdminController.onEdit() with userData moving into the displayUsers page.");
                
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                $this->logger->info("Exiting AdminController.onEdit() moving into Privilege error page.");
                
                return view('error.privilege');
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onEdit() with error", $e);
            
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
        $this->logger->info("Entering AdminController.onRemoval()");
        
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
                $this->logger->info("Exiting AdminController.onRemoval() with userData into displayUsers page.");
                
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                $this->logger->info("Exiting AdminController.onRemoval() with errors moving into Common Error page.");
                
                return view('error.privilege');
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onRemoval()");
            
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
        $this->logger->info("Entering AdminController.onSuspension()");
        
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
                $this->logger->info("Exiting AdminController.onSuspension() with userData into displayUsers page.");
                
                return view('admin.displayUsers')->with('users', $userData);
            }
            else
            {
                $this->logger->info("Exiting AdminController.onSuspension() moving into Common Error page.");
                
                return view('error.privilege');
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onSuspension()");
            
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
        $this->logger->info("Entering AdminController.onJobAddition()");
        
        // Call the Validation Rules:
        $this->validateJobForm($request);

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
                $this->logger->info("Exiting AdminController.onJobAddition() with jobsData into jobs page.");
                
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
            {
                $this->logger->info("Exiting AdminController.onJobAddition() moving into Common Error page.");
                
                return view('common.error');
            }
        }
        catch (ValidationException $el)
        {            
            $this->logger->error("Errors in AdminController.onJobAddition()");
            
            throw $el;
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors AdminController.onJobAddition()");
            
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
        $this->logger->info("Entering AdminController.onViewJobList()");
        
        // Call the Validation Rules:
        try
        {
            // Call a business service and populate with jobs within a table:
            $service = new AdminBusinessService();
            $jobsData = $service->populateJobs();

            $this->logger->info("Exiting AdminController.onViewJobList()");
            
            return view('job.jobs')->with('jobs', $jobsData);
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onViewJobList()");
            
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
        $this->logger->info("Entering AdminController.onViewEditJob()");
        
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

            $this->logger->info("Exiting AdminController.onViewEditJob()");
            
            return view('job.editJobForm')->with('job', $job);
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onViewEditJob()");
            
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
        $this->logger->info("Entering AdminController.onEditJobPost()");
        
        // Validation IS NOT WORKING for Admin's Job forms.
        // Call the Validation Rules:
//         $this->validateJobForm($request);
        
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
                $this->logger->info("Exiting AdminController.onEditJobPost() with success in Job Modification.");
                
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
            {
                $this->logger->info("Exiting AdminController.onEditJobPost() with an error");
                
                $message = "Please check the information again.";
                return view('job.jobs')->with('message', $message);
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onEditJobPost()");
            
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
        $this->logger->info("Entering AdminController.onJobDeletion()");
        
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
                $this->logger->info("Exiting AdminController.onJobDeletion() with success.");
                
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
            {                
                $this->logger->info("Exiting AdminController.onJobDeletion() with wrong info.");
                
                $message = "Please check the information again.";
                return view('job.jobs')->with('message', $message);
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in AdminController.onJobDeletion()");
            
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
        $this->logger->info("Entering AdminController.validateJobForm()");
        
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules

        // Setup Data Validation Rules for Login Form.
        $rules = [
            'jobname' => 'Required | Max: 20 | Alpha',
            'description' => 'Required | Max: 1000',
            'company' => 'Required | Between: 4, 20',
            'requirements' => 'Required | Max: 1000',
            'skills' => 'Required | Between: 3, 500' 
        ];

        // Run Validation Rules:
        $this->validate($request, $rules);
        
        $this->logger->info("Exiting AdminController.validateJobForm()");
    }
}
