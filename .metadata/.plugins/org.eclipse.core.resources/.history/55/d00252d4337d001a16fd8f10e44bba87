<?php
namespace App\Services\Business;

use App\Services\Utility\db_connector;
use App\Services\Data\JobDataService;

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
        $db = new db_connector();
        $conn = $db->getConnection();
        $jobData = new JobDataService($conn);

        $jobResults = $jobData->findMatches($id);

        $conn = null;

        return $jobResults;
    }
}

