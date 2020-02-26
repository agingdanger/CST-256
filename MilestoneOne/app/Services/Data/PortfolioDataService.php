<?php
namespace App\Services\Data;

use App\Model\Education;
use App\Model\JobHistory;
use App\Model\Skill;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDOException;


class PortfolioDataService
{
    private $db;
    private $conn;
    
    // Default Constructor: 
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    /* ------------------------------- READ Methods ------------------------------ */
    
    /**
     * Find the Job history of a User.
     * @param unknown $userID
     * @throws DatabaseException
     * @return unknown
     */
    public function findAllUserJobs($userID)
    {
        try
        {
            // Find all the jobs for the user
            $result = $this->conn->prepare("SELECT * FROM JOB_HISTORY WHERE users_ID = :userid");
            $result->bindParam('userid', $userID);
            $result->execute();
            
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function findAllUserSkills($userID)
    {
        try
        {
            // Find all the jobs for the user
            $result = $this->conn->prepare("SELECT * FROM SKILL WHERE users_ID = :userid");
            $result->bindParam('userid', $userID);
            $result->execute();
            
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function findAllUserEducation($userID)
    {
        try
        {
            // Find all the jobs for the user
            $result = $this->conn->prepare("SELECT * FROM education WHERE users_ID = :userid");
            $result->bindParam('userid', $userID);
            $result->execute();
            
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /* ------------------------------- CREATE Methods ------------------------------ */
    public function createJob(JobHistory $job)
    {
        try
        {
            $id = $job->getId();
            $jobName = $job->getName();
            $jobPosition = $job->getPosition();
            $jobDescription = $job->getDescription();
            $jobAward = $job->getAwards();
            $jobStartDate = $job->getStartDate();
            $jobEndDate = $job->getEndDate();
            $userID = $job->getUserID();
            
            // change this to :variable for bindparam
            $result = $this->conn->prepare("INSERT INTO `JOB_HISTORY` (`ID`, `NAME`, `POSITION`, `DESCRIPTION`, `AWARDS`, `START_DATE`, `END_DATE`, `users_ID`) VALUES(:id, :name, :position, :description, :awards, :startdate, :enddate, :usersid)");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $jobName);
            $result->bindParam(':position', $jobPosition);
            $result->bindParam(':description', $jobDescription);
            $result->bindParam(':awards', $jobAward);
            $result->bindParam(':startdate', $jobStartDate);
            $result->bindParam(':enddate', $jobEndDate);
            $result->bindParam(':usersid', $userID);
            $result->execute();
            
            if($result->rowCount() == 1)
            {
                Log::info("Exit PortfolioDataservice create with true");
                return true;
            }
            else
            {
                Log::info("Exit PortfolioDataService.create() with false");
                return false;
            }
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
        /* finally{
         return false;
         } */
    }
    
    public function createEducation(Education $ed)
    {
        try
        {
            $id = $ed->getId();
            $edName = $ed->getName();
            $edYears = $ed->getYears();
            $edMajor = $ed->getMajor();
            $edMinor = $ed->getMinor();
            $edStartYear = $ed->getStartyear();
            $edEndYear = $ed->getEndyear();
            $userID = $ed->getUserID();
            
            // change this to :variable for bindparam
            $result = $this->conn->prepare("INSERT INTO `EDUCATION` (`ID`, `NAME`, `YEARS`, `MAJOR`, `MINOR`, `START_YEAR`, `END_YEAR`, `users_ID`) VALUES(:id, :name, :years, :major, :minor, :startyear, :endyear, :usersid)");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $edName);
            $result->bindParam(':years', $edYears);
            $result->bindParam(':major', $edMajor);
            $result->bindParam(':minor', $edMinor);
            $result->bindParam(':startyear', $edStartYear);
            $result->bindParam(':endyear', $edEndYear);
            $result->bindParam(':usersid', $userID);
            $result->execute();
            
            if($result->rowCount() == 1)
            {
                Log::info("Exit PortfolioDataservice create ed with true");
                return true;
            }
            else
            {
                Log::info("Exit PortfolioDataService.createEd() with false");
                return false;
            }
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
        /* finally{
         return false;
         } */
    }
    
    public function createSkill(Skill $skill)
    {
        try
        {
            $id = $skill->getId();
            $skillName = $skill->getName();
            $userID = $skill->getUserID();
            
            // change this to :variable for bindparam
            $result = $this->conn->prepare("INSERT INTO `SKILL` (`ID`, `NAME`, `users_ID`) VALUES(:id, :name, :usersid)");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $skillName);
            $result->bindParam(':usersid', $userID);
            $result->execute();
            
            if($result->rowCount() == 1)
            {
                Log::info("Exit PortfolioDataservice create skill with true");
                return true;
            }
            else
            {
                Log::info("Exit PortfolioDataService.createSkill) with false");
                return false;
            }
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
        /* finally{
         return false;
         } */
    }
    
    /* ------------------------------- DELETE Methods ------------------------------ */
    public function deleteJob($id)
    {
        try
        {
            
            $result = $this->conn->prepare("DELETE FROM job_history WHERE ID = :jobid");
            $result->bindParam(':jobid', $id);
            $result->execute();
            
            if($result)
            {
                return $id;
            }
            return false;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
        /* finally{
         return false;
         } */
    }
    
    public function deleteSkill($id)
    {
        try
        {
            
            $result = $this->conn->prepare("DELETE FROM skill WHERE ID = :skillid");
            $result->bindParam(':skillid', $id);
            $result->execute();
            
            if($result)
            {
                return $id;
            }
            return false;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
        /* finally{
         return false;
         } */
    }
    
    public function deleteEducation($id)
    {
        try
        {
            
            $result = $this->conn->prepare("DELETE FROM education WHERE ID = :edid");
            $result->bindParam(':edid', $id);
            $result->execute();
            
            if($result)
            {
                return $id;
            }
            return false;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
        /* finally{
         return false;
         } */
    }
    
    /* ------------------------------- UPDATE Methods ------------------------------ */
    public function updateJobHistory(JobHistory $job)
    {
        try
        {
            $id = $job->getId();
            $name = $job->getName();
            $position = $job->getPosition();
            $description = $job->getDescription();
            $awards = $job->getAwards();
            $startDate = $job->getStartDate();
            $endDate = $job->getEndDate();
            
            $result = $this->conn->prepare("UPDATE job_history SET NAME=:name, POSITION=:position, DESCRIPTION=:description, AWARDS=:awards, START_DATE=:startdate, END_DATE=:enddate WHERE ID=:id");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':position', $position);
            $result->bindParam(':description', $description);
            $result->bindParam(':awards', $awards);
            $result->bindParam(':startdate', $startDate);
            $result->bindParam(':enddate', $endDate);
            $result->execute();
            
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
    }
    
    public function updateEducationHistory(Education $ed)
    {
        try
        {
            $id = $ed->getId();
            $name = $ed->getName();
            $years = $ed->getYears();
            $major = $ed->getMajor();
            $minor = $ed->getMinor();
            $startyear = $ed->getStartyear();
            $endyear = $ed->getEndyear();
            
            $result = $this->conn->prepare("UPDATE education SET NAME=:name, YEARS=:years, MAJOR=:major, MINOR=:minor, START_YEAR=:startyear, END_YEAR=:endyear WHERE ID=:id");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':years', $years);
            $result->bindParam(':major', $major);
            $result->bindParam(':minor', $minor);
            $result->bindParam(':startyear', $startyear);
            $result->bindParam(':endyear', $endyear);
            $result->execute();
            
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
    }
    
    public function updateSkillHistory(Skill $skill)
    {
        try
        {
            $id = $skill->getId();
            $name = $skill->getName();
           
            
            $result = $this->conn->prepare("UPDATE skill SET NAME=:name WHERE ID=:id");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->execute();
            
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
    }
    
}