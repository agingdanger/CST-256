<?php
namespace App\Services\Business;

use App\Services\Data\JobDataService;
use App\Services\Utility\MyLogger2;
use App\Services\Utility\db_connector;

class JobBusinessService
{
    /**
     * Search Jobs by an inputted search text.
     * 
     * @param $search
     * @return \App\Services\Data\$results
     */
    public function searchJobs($search)
    {
        MyLogger2::info("Enter JobBusinessService.searchJobs()");
        
        // Call the connection:
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the Job Data Service
        $jobData = new JobDataService($conn);

        // Check if the Search input text is empty. (This shouldn't happen due to validation rule)
        if ($search != "")
            $jobResults = $jobData->findJobsBySearch($search);
        else
            $jobResults = $jobData->findAllJobs();

        // Close the PDO connection.
        $conn = null;
        
        MyLogger2::info("Exit JobBusinessService.searchJobs()");

        // Return the all Job searched Results.
        return $jobResults;
    }
    
    /**
     * Search Jobs by an inputted search text.
     *
     * @param $search
     * @return \App\Services\Data\$results
     */
    public function searchJobsREST($search)
    {
        MyLogger2::info("Enter JobBusinessService.searchJobsREST()");
        
        // Call the connection:
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the Job Data Service
        $jobData = new JobDataService($conn);
        
        // Check if the Search input text is empty. (This shouldn't happen due to validation rule)
        if ($search != "")
            $jobResults = $jobData->findAllJobsBySearchREST($search);
            else
                $jobResults = $jobData->findAllJobs();
                
                // Close the PDO connection.
                $conn = null;
                
                MyLogger2::info("Exit JobBusinessService.searchJobsREST()");
                
                // Return the all Job searched Results.
                return $jobResults;
    }
    
    /**
     * Search for matched jobs by the user's profile.
     * 
     * @param $id
     * @return $jobResults
     */
    public function matchJobs($id)
    {
        MyLogger2::info("Enter JobBusinessService.matchJobs()");
        
        // Call the database connection
        $db = new db_connector();
        $conn = $db->getConnection();
        
        // Call the DAO to find matching jobs
        $jobData = new JobDataService($conn);
        $jobResults = $jobData->findMatches($id);

        // Close the PDO connection
        $conn = null;

        MyLogger2::info("Exit JobBusinessService.matchJobs()");
        
        return $jobResults;
    }
}

