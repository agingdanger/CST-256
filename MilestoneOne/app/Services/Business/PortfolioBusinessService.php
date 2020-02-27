<?php
namespace App\Services\Business;

use App\Model\Education;
use App\Model\JobHistory;
use App\Model\Skill;
use App\Services\Utility\db_connector;
use App\Services\Data\PortfolioDataService;

/**
 * 
 * @author agingdanger
 *
 */
class PortfolioBusinessService
{
    /**
     * 
     * @param unknown $job
     * @return boolean
     */
    public function postJobExperience($job)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        
        //passes the job into the data service to be created
        $portfolioData = $portfolioService->createJob($job);
        
        //close the connection
        $conn = null;
        
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    public function postEducationExperience($ed)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        
        //passes the education into the data service to be created
        $portfolioData = $portfolioService->createEducation($ed);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param unknown $skill
     * @return boolean
     */
    public function postSkillExperience($skill)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the skill into the data service to be created
        $portfolioData = $portfolioService->createSkill($skill);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    /**
     * 
     * @param unknown $userID
     * @return \App\Services\Data\$result
     */
    public function retrieveUserJobs($userID)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the userID into the dataservice to retrieve all jobs
        $portfolioData = $portfolioService->findAllUserJobs($userID);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param unknown $userID
     * @return \App\Services\Data\$result
     */
    public function retrieveUserSkills($userID)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the userID into the dataservice to retrieve all skills
        $portfolioData = $portfolioService->findAllUserSkills($userID);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param unknown $userID
     * @return \App\Services\Data\$result->fetchall()
     */
    public function retrieveUserEducation($userID)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the userID into the dataservice to retrieve all education
        $portfolioData = $portfolioService->findAllUserEducation($userID);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param unknown $id
     * @return \App\Services\Data\unknown|boolean
     */
    public function removeUserJob($id)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the ID into the dataservice to delete the job
        $portfolioData = $portfolioService->deleteJob($id);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param unknown $id
     * @return \App\Services\Data\unknown|boolean
     */
    public function removeUserEducation($id)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the ID into the data service to remove the education
        $portfolioData = $portfolioService->deleteEducation($id);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param unknown $id
     * @return \App\Services\Data\unknown|boolean
     */
    public function removeUserSkill($id)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the ID into the data service to remove the skill
        $portfolioData = $portfolioService->deleteSkill($id);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param JobHistory $job
     * @return boolean
     */
    public function modifyJobHistory(JobHistory $job)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the JobHistory object into the data service to be edited
        $portfolioData = $portfolioService->updateJobHistory($job);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
    
    /**
     * 
     * @param Education $ed
     * @return boolean
     */
    public function modifyEducationHistory(Education $ed)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        return $portfolioData;
    }
    
     * 
     * @param Skill $skill
     * @return boolean
     */
    public function modifySkillHistory(Skill $skill)
    {
        //Creates a db_connector object
        $db = new db_connector();
        //creates an instance of db
        $conn = $db->getConnection();
        //passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        //passes the Skill object into the data service to be edited
        $portfolioData = $portfolioService->updateSkillHistory($skill);
        //close the connection
        $conn = null;
        //passes the returned status of the query from the data service
        return $portfolioData;
    }
}