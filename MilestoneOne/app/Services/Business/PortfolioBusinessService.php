<?php
namespace App\Services\Business;

use App\Model\Education;
use App\Model\JobHistory;
use App\Model\Skill;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
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
     * @param
     *            $job
     * @return boolean
     */
    public function postJobExperience($job)
    {
        MyLogger2::info("Enter PortfolioBusinessService.postJobExperience()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);

        // passes the job into the data service to be created
        $portfolioData = $portfolioService->createJob($job);

        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.postJobExperience()");
        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    public function postEducationExperience($ed)
    {
        MyLogger2::info("Enter PortfolioBusinessService.postEducationExperience()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);

        // passes the education into the data service to be created
        $portfolioData = $portfolioService->createEducation($ed);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.postEducationExperience()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $skill
     * @return boolean
     */
    public function postSkillExperience($skill)
    {
        MyLogger2::info("Enter PortfolioBusinessService.postSkillExperience()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the skill into the data service to be created
        $portfolioData = $portfolioService->createSkill($skill);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.postSkillExperience()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $userID
     * @return \App\Services\Data\$result
     */
    public function retrieveUserJobs($userID)
    {
        MyLogger2::info("Enter PortfolioBusinessService.retrieveUserJobs()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the userID into the dataservice to retrieve all jobs
        $portfolioData = $portfolioService->findAllUserJobs($userID);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.retrieveUserJobs()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $userID
     * @return \App\Services\Data\$result
     */
    public function retrieveUserSkills($userID)
    {
        MyLogger2::info("Enter PortfolioBusinessService.retrieveUserSkills()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the userID into the dataservice to retrieve all skills
        $portfolioData = $portfolioService->findAllUserSkills($userID);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.retrieveUserSkills()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $userID
     * @return \App\Services\Data\$result->fetchall()
     */
    public function retrieveUserEducation($userID)
    {
        MyLogger2::info("Enter PortfolioBusinessService.retrieveUserEducation()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the userID into the dataservice to retrieve all education
        $portfolioData = $portfolioService->findAllUserEducation($userID);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.retrieveUserEducation()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $id
     * @return boolean
     */
    public function removeUserJob($id)
    {
        MyLogger2::info("Enter PortfolioBusinessService.removeUserJob()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the ID into the dataservice to delete the job
        $portfolioData = $portfolioService->deleteJob($id);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.removeUserJob()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $id
     * @return boolean
     */
    public function removeUserEducation($id)
    {
        MyLogger2::info("Enter PortfolioBusinessService.removeUserEducation()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the ID into the data service to remove the education
        $portfolioData = $portfolioService->deleteEducation($id);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.removeUserEducation()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param
     *            $id
     * @return boolean
     */
    public function removeUserSkill($id)
    {
        MyLogger2::info("Enter PortfolioBusinessService.removeUserSkill()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the ID into the data service to remove the skill
        $portfolioData = $portfolioService->deleteSkill($id);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.removeUserSkill()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param JobHistory $job
     * @return boolean
     */
    public function modifyJobHistory(JobHistory $job)
    {
        MyLogger2::info("Enter PortfolioBusinessService.modifyJobHistory()");

        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the JobHistory object into the data service to be edited
        $portfolioData = $portfolioService->updateJobHistory($job);
        // close the connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.modifyJobHistory()");

        // passes the returned status of the query from the data service
        return $portfolioData;
    }

    /**
     *
     * @param Education $ed
     * @return boolean
     */
    public function modifyEducationHistory(Education $ed)
    {
        MyLogger2::info("Enter PortfolioBusinessService.modifyEducationHistory()");

        // Creates a db_connector object
        $db = new db_connector();
        $conn = $db->getConnection();

        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        $portfolioData = $portfolioService->updateEducationHistory($ed);

        // Close the PDO Connection
        $conn = null;

        MyLogger2::info("Exit PortfolioBusinessService.modifyEducationHistory()");

        return $portfolioData;
    }

    /**
     *
     * @param Skill $skill
     * @return boolean
     */
    public function modifySkillHistory(Skill $skill)
    {
        MyLogger2::info("Enter PortfolioBusinessService.modifySkillHistory()");
        
        // Creates a db_connector object
        $db = new db_connector();
        // creates an instance of db
        $conn = $db->getConnection();
        // passes the connection to the DataService
        $portfolioService = new PortfolioDataService($conn);
        // passes the Skill object into the data service to be edited
        $portfolioData = $portfolioService->updateSkillHistory($skill);
        // close the connection
        $conn = null;
        
        MyLogger2::info("Exit PortfolioBusinessService.modifySkillHistory()");
        
        // passes the returned status of the query from the data service
        return $portfolioData;
    }
}