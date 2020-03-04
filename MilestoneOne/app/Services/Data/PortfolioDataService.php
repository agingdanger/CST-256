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
     * @param $userID
     * @throws DatabaseException
     * @return $result
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
    
    /**
     * Find all Skills of the User
     * @param $userID
     * @throws DatabaseException
     * @return $result
     */
    public function findAllUserSkills($userID)
    {
        try
        {
            // Find all the skills for the user
            $result = $this->conn->prepare("SELECT * FROM SKILL WHERE users_ID = :userid");
            $result->bindParam('userid', $userID);
            $result->execute();
            
            //return result as an array
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
    
    /**
     * Find all Education history from the User
     * @param $userID
     * @throws DatabaseException
     * @return $result->fetchall()
     */
    public function findAllUserEducation($userID)
    {
        try
        {
            // Find all the education for the user
            $result = $this->conn->prepare("SELECT * FROM education WHERE users_ID = :userid");
            $result->bindParam('userid', $userID);
            $result->execute();
            
            //return result as an array
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
    
    /**
     * 
     * @param JobHistory $job
     * @throws DatabaseException
     * @return boolean
     */
    public function createJob(JobHistory $job)
    {
        try
        {
            //expand the job into query variables
            $id = $job->getId();
            $jobName = $job->getName();
            $jobPosition = $job->getPosition();
            $jobDescription = $job->getDescription();
            $jobAward = $job->getAwards();
            $jobStartDate = $job->getStartDate();
            $jobEndDate = $job->getEndDate();
            $userID = $job->getUserID();
            
            // Build the query to insert the job into the users history
            $result = $this->conn->prepare("INSERT INTO `JOB_HISTORY` (`ID`, `NAME`, `POSITION`, `DESCRIPTION`, `AWARDS`, `START_DATE`, `END_DATE`, `users_ID`) VALUES(:id, :name, :position, :description, :awards, :startdate, :enddate, :usersid)");
            //Bind the query variables with the method variables
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $jobName);
            $result->bindParam(':position', $jobPosition);
            $result->bindParam(':description', $jobDescription);
            $result->bindParam(':awards', $jobAward);
            $result->bindParam(':startdate', $jobStartDate);
            $result->bindParam(':enddate', $jobEndDate);
            $result->bindParam(':usersid', $userID);
            
            //execute the query
            $result->execute();
            
            //check if result contains a result
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

    }
    
    /**
     * 
     * @param Education $ed
     * @throws DatabaseException
     * @return boolean
     */
    public function createEducation(Education $ed)
    {
        try
        {
            //expand the $ed argument into query variables
            $id = $ed->getId();
            $edName = $ed->getName();
            $edYears = $ed->getYears();
            $edMajor = $ed->getMajor();
            $edMinor = $ed->getMinor();
            $edStartYear = $ed->getStartyear();
            $edEndYear = $ed->getEndyear();
            $userID = $ed->getUserID();
            
            //Build the query to insert into education
            $result = $this->conn->prepare("INSERT INTO `education` (`ID`, `NAME`, `YEARS`, `MAJOR`, `MINOR`, `START_YEAR`, `END_YEAR`, `users_ID`) VALUES(:id, :name, :years, :major, :minor, :startyear, :endyear, :usersid)");
            //Bind the query variables to the method variables
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $edName);
            $result->bindParam(':years', $edYears);
            $result->bindParam(':major', $edMajor);
            $result->bindParam(':minor', $edMinor);
            $result->bindParam(':startyear', $edStartYear);
            $result->bindParam(':endyear', $edEndYear);
            $result->bindParam(':usersid', $userID);
            //execute the query
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
    }
    
    public function createSkill(Skill $skill)
    {
        try
        {
            //open the skill variable to build query variables
            $id = $skill->getId();
            $skillName = $skill->getName();
            $userID = $skill->getUserID();
            
            // Build the query into the 
            $result = $this->conn->prepare("INSERT INTO `skill` (`ID`, `NAME`, `users_ID`) VALUES(:id, :name, :usersid)");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $skillName);
            $result->bindParam(':usersid', $userID);
            //execute the query
            $result->execute();
            
            //see if the result contains a row
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
    }
    
    /* ------------------------------- DELETE Methods ------------------------------ */
    /**
     * 
     * @param $id
     * @throws DatabaseException
     * @return boolean
     */
    public function deleteJob($id)
    {
        try
        {
            //Build a query that will delete from the users job history
            $result = $this->conn->prepare("DELETE FROM job_history WHERE ID = :jobid");
            //Bind the method variable into the query variable
            $result->bindParam(':jobid', $id);
            //Execute the query
            $result->execute();
            
            //check if the query executed
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
    }
    
    /**
     * 
     * @param $id
     * @throws DatabaseException
     * @return boolean
     */
    public function deleteSkill($id)
    {
        try
        {
            //Build the query to delete the skill from the user's history
            $result = $this->conn->prepare("DELETE FROM skill WHERE ID = :skillid");
            //Bind the Skill id to the query parameter
            $result->bindParam(':skillid', $id);
            //Execute the query
            $result->execute();
            
            //Check if the query executed, 
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
    }
    
    /**
     * 
     * @param $id
     * @throws DatabaseException
     * @return boolean
     */
    public function deleteEducation($id)
    {
        try
        {
            //Build the query to delete the user's education based on the ID
            $result = $this->conn->prepare("DELETE FROM education WHERE ID = :edid");
            //Bind the query param to the education ID
            $result->bindParam(':edid', $id);
            //Execute the query
            $result->execute();
            
            
            //Check if the query was executed
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
    }
    
    /* ------------------------------- UPDATE Methods ------------------------------ */
    
    /**
     * 
     * @param JobHistory $job
     * @throws DatabaseException
     * @return boolean
     */
    public function updateJobHistory(JobHistory $job)
    {
        try
        {
            //Expand the JobHistory object variable into query variables
            $id = $job->getId();
            $name = $job->getName();
            $position = $job->getPosition();
            $description = $job->getDescription();
            $awards = $job->getAwards();
            $startDate = $job->getStartDate();
            $endDate = $job->getEndDate();
            
            //Build the query to update job_history with the latest user's information
            $result = $this->conn->prepare("UPDATE job_history SET NAME=:name, POSITION=:position, DESCRIPTION=:description, AWARDS=:awards, START_DATE=:startdate, END_DATE=:enddate WHERE ID=:id");
            //Bind the variables to the query parameters
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':position', $position);
            $result->bindParam(':description', $description);
            $result->bindParam(':awards', $awards);
            $result->bindParam(':startdate', $startDate);
            $result->bindParam(':enddate', $endDate);
            //Execute the query
            $result->execute();
            
            //Check if the result is executed
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
    
    /**
     * 
     * @param Education $ed
     * @throws DatabaseException
     * @return boolean
     */
    public function updateEducationHistory(Education $ed)
    {
        try
        {
            //Expand the $ed variable into query variables
            $id = $ed->getId();
            $name = $ed->getName();
            $years = $ed->getYears();
            $major = $ed->getMajor();
            $minor = $ed->getMinor();
            $startyear = $ed->getStartyear();
            $endyear = $ed->getEndyear();
            
            //Build the query to update the education of the user
            $result = $this->conn->prepare("UPDATE education SET NAME=:name, YEARS=:years, MAJOR=:major, MINOR=:minor, START_YEAR=:startyear, END_YEAR=:endyear WHERE ID=:id");
            //bind the user's updated education to the query parameters
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':years', $years);
            $result->bindParam(':major', $major);
            $result->bindParam(':minor', $minor);
            $result->bindParam(':startyear', $startyear);
            $result->bindParam(':endyear', $endyear);
            //execute the built query
            $result->execute();
            
            //check if the result is built
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
    
    /**
     * 
     * @param Skill $skill
     * @throws DatabaseException
     * @return boolean
     */
    public function updateSkillHistory(Skill $skill)
    {
        try
        {
            //take the user's updated skills to the 
            $id = $skill->getId();
            $name = $skill->getName();
           
            //build the query to update the skill of the user
            $result = $this->conn->prepare("UPDATE skill SET NAME=:name WHERE ID=:id");
            //bind the method variables to the query variables
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            //execute the query
            $result->execute();
            
            //check if the query was executed
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
    
    /* public function updateSkillHistory(Skill $skill)
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
    } */
    
}