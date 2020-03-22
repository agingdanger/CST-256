<?php
namespace App\Services\Business;

use App\Services\Utility\db_connector;
use App\Services\Data\JobDataService;

class JobBusinessService
{
    public function searchJobs($search)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $jobData = new JobDataService($conn);
        
        $jobResults = $jobData->findJobsBySearch($search);
        
        $conn = null;
        
        return $jobResults;
    }
    
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

