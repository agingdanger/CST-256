<?php
namespace App\Services\Business;

use App\Model\Job;
use App\Model\User;
use App\Services\Data\AdminDataService;
use App\Services\Data\JobDataService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use App\Services\Utility\db_connector;

class AdminBusinessService
{
        
    /**
     * Populating the userdata into the datatable
     * 
     * @return $userData
     */
    public function populate()
    {
        MyLogger2::info("Enter AdminBusinessService.populate()");
        
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService. 
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Sending it to Data Service: 
        $adminData = new AdminDataService($conn);
        $userData = $adminData->findAll();
        
        // Close the PDO connection
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.populate()");
        
        return $userData;
    }
    
    /**
     * Populating Jobs into the datatable
     *
     * @return $userData
     */
    public function populateJobs()
    {
        MyLogger2::info("Enter AdminBusinessService.populateJobs()");
        
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Sending it to Data Service:
        $adminData = new JobDataService($conn);
        $jobsData = $adminData->findAllJobs();
        
        // Close the PDO connection
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.populateJobs()");
        
        return $jobsData;
    }
    
    /**
     * Populate jobs to REST service
     * @return Job() Array
     */
    public function populateJobsREST()
    {
        MyLogger2::info("Enter AdminBusinessService.populateJobsREST()");
        
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Sending it to Data Service:
        $adminData = new JobDataService($conn);
        $jobsData = $adminData->findAllJobsREST();
        
        // Close the PDO connection
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.populateJobsREST()");
        
        return $jobsData;
    }
    
    
    public function publishJob($job) 
    {
        MyLogger2::info("Enter AdminBusinessService.publishJob()");
        
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Sending job to Data Service:
        $service = new JobDataService($conn);
        $jobsData = $service->create($job);
        
        // Close the PDO connection
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.publishJob()");
        
        return $jobsData;
    }
    
    /**
     * Modify the User's Requested changes
     * @param User $user
     * @return boolean
     */
    public function modify(User $user)
    {
        MyLogger2::info("Enter AdminBusinessService.modify()");
        
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Send user and conn to the Data Service to Update: 
        $adminData = new AdminDataService($conn);        
        $userData = $adminData->update($user);
        
        // Close the PDO Connection
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.modify()");
        
        return $userData;
    }
    
    /**
     * Modify the Job's info: 
     * @param Job $job
     * @return boolean
     */
    public function jobModify(Job $job)
    {
        MyLogger2::info("Enter AdminBusinessService.jobModify()");
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the Data Service to Update the Jobpost: 
        $adminData = new JobDataService($conn);        
        $isJobData = $adminData->update($job);
        
        // Close the PDO Connection: 
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.jobModify()");
        
        return $isJobData;
    }
    
    /**
     * Suspend the User by updating the role:
     * @param User $user
     */
    public function suspend(User $user)
    {
        MyLogger2::info("Enter AdminBusinessService.suspend()");
        // Take the UserID and pass it to dataservice.
        
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Send user and conn to the DataService to Update the role: 
        $service = new AdminDataService($conn);
        $adminData = $service->update($user);
        
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.suspend()");
        return $adminData;
        
    }
    
    /**
     * Remove/Delete the User from the Database
     * @param User $user
     * @return boolean value
     */
    public function remove(User $user)
    {
        MyLogger2::info("Enter AdminBusinessService.remove()");
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Send user and conn to the DataService to remove a User: 
        $service = new AdminDataService($conn);
        $adminData = $service->delete($user);
        
        // Close the PDO Connection
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.remove()");
        return $adminData;
    }
    
    /**
     * Delete the selected Job
     * @param Job $job
     * @return boolean $adminData
     */
    public function obliterateJob(Job $job)
    {
        MyLogger2::info("Enter AdminBusinessService.obliterateJob()");
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Send the Job's ID mainly to the data service to delete it: 
        $service = new JobDataService($conn);
        $adminData = $service->delete($job);
        
        // Close the PDO Connection: 
        $conn = null;
        
        MyLogger2::info("Exit AdminBusinessService.obliterateJob()");
        return $adminData;
    }
}