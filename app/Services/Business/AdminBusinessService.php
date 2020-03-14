<?php
namespace App\Services\Business;

use Illuminate\Http\Request;
use App\Services\Data\AdminDataService;
use App\Model\Job;
use App\Model\User;
use App\Services\Utility\db_connector;
use App\Services\Data\JobDataService;

class AdminBusinessService
{
    /**
     * Populating the userdata into the datatable
     * 
     * @return $userData
     */
    public function populate()
    {
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
        
        return $userData;
    }
    
    /**
     * Populating Jobs into the datatable
     *
     * @return $userData
     */
    public function populateJobs()
    {
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
        
        return $jobsData;
    }
    
    public function publishJob($job) 
    {
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
        
        return $jobsData;
    }
    
    /**
     * Modify the User's Requested changes
     * @param User $user
     * @return boolean
     */
    public function modify(User $user)
    {
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Send user and conn to the Data Service to Update: 
        $adminData = new AdminDataService($conn);        
        $userData = $adminData->update($user);
        
        $conn = null;
        
        return $userData;
    }
    
    /**
     * Modify the Job's info: 
     * @param Job $job
     * @return boolean
     */
    public function jobModify(Job $job)
    {
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
        
        return $isJobData;
    }
    
    /**
     * Suspend the User by updating the role:
     * @param User $user
     */
    public function suspend(User $user)
    {
        
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
        
        return $adminData;
        
    }
    
    /**
     * Remove/Delete the User from the Database
     * @param User $user
     * @return boolean value
     */
    public function remove(User $user)
    {
        /*
         * Creating a Connection to get the PDO from Utilities
         * and then, send it do DataService.
         */
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Send user and conn to the DataService to remove a User: 
        $service = new AdminDataService($conn);
        $adminData = $service->delete($user);
        $conn = null;
        
        return $adminData;
    }
    
    /**
     * Delete the selected Job
     * @param Job $job
     * @return boolean $adminData
     */
    public function obliterateJob(Job $job)
    {
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
        
        return $adminData;
    }
}