<?php
namespace App\Services\Business;

use App\Model\Education;
use App\Model\JobHistory;
use App\Model\Skill;
use App\Services\Utility\db_connector;
use App\Services\Data\PortfolioDataService;

class PortfolioBusinessService
{
    public function postJobExperience($job)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->createJob($job);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function postEducationExperience($ed)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->createEducation($ed);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function postSkillExperience($skill)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->createSkill($skill);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function retrieveUserJobs($userID)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->findAllUserJobs($userID);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function retrieveUserSkills($userID)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->findAllUserSkills($userID);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function retrieveUserEducation($userID)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->findAllUserEducation($userID);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function removeUserJob($id)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->deleteJob($id);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function modifyJobHistory(JobHistory $job)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->updateJobHistory($job);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function modifyEducationHistory(Education $ed)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->updateEducation($ed);
        
        $conn = null;
        
        return $portfolioData;
    }
    
    public function modifySkillHistory(Skill $skill)
    {
        $db = new db_connector();
        $conn = $db->getConnection();
        $portfolioService = new PortfolioDataService($conn);
        
        $portfolioData = $portfolioService->updateSkill($skill);
        
        $conn = null;
        
        return $portfolioData;
    }
}