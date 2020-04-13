<?php
namespace App\Services\Data;

use App\Services\Utility\DatabaseException;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;
use PDOException;
use App\Model\Job;
use App\User;

class JobDataService
{
    // Declare class variables:
    private $conn;
    
    // Non-Default Constructor:
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    /**
     * Get all Jobs to populate the datatable
     *
     * @throws DatabaseException
     * @return
     */
    public function findAllJobs()
    {
        MyLogger2::info("Enter JobDataService.findAllJobs()");
        try
        {
            // Find all jobs.
            $result = $this->conn->prepare("SELECT * FROM job");
            $result->execute();
            
            MyLogger2::info("Exit JobDataService.findAllJobs()");
            
            // Return an array of fetched results to the Business Service: 
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            MyLogger2::error("PDOException: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(Exception $exc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $exc->getMessage()
            ));
            throw $exc->getMessage();
        }
    }
    
    
    
    /**
     * Add a new Job to the Database: 
     * 
     * @param $job
     * @throws DatabaseException
     * @return boolean
     */
    public function create($job) 
    {
        MyLogger2::info("Enter JobDataService.create()");
        
        try
        {
            // Put all the data from $job into variables: 
            $id = $job->getId();
            $name = $job->getName();
            $description = $job->getDescription();
            $company = $job->getCompany();
            $requirements = $job->getRequirements();
            $skills = $job->getSkills();
            
            // Build the Query to add a job into the database: 
            $result = $this->conn->prepare("INSERT INTO job (`ID`, `NAME`, `DESCRIPTION`, `COMPANY`, `REQUIREMENTS`, `SKILLS`) VALUES (:id, :name, :description, :company, :requirements, :skills)");
            // Bind all the values by matching them with the variables created: 
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':description', $description);
            $result->bindParam(':company', $company);
            $result->bindParam(':requirements', $requirements);
            $result->bindParam(':skills', $skills);
            // Execute the query:
            $result->execute();
            
            // Check if result was successful: 
            if($result->rowCount() == 1)
            {
                MyLogger2::info("Exit JobDataService.create() with rowCount and true");
                return true;
            }
            else
            {
                MyLogger2::info("Exit JobDataService.create() with no rowCount false");
                return false;
            }
        }
        catch (PDOException $pdoExc)
        {
            MyLogger2::error("PDOException: ", array("message" => $pdoExc->getMessage));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch(Exception $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            // Throwing Exception with message: 
            throw $e->getMessage();
        }
    }
    
    /**
     * Update the Job's info in the Job Edit Form.
     * 
     * @param Job $job
     * @throws DatabaseException
     * @return boolean
     */
    public function update(Job $job)
    {
        MyLogger2::info("Enter JobDataService.update()");
        try
        {
            // Put all the data from $job into variables:
            $id = $job->getId();
            $name = $job->getName();
            $description = $job->getDescription();
            $company = $job->getCompany();
            $requirements = $job->getRequirements();
            $skills = $job->getSkills();
            
            // Build the Query to Update the Job's info into the database: 
            $result = $this->conn->prepare("UPDATE job SET NAME=:jobname, DESCRIPTION=:desc, COMPANY=:company, REQUIREMENTS=:requirements, SKILLS=:skills WHERE ID=:id");
            // Bind all the query variables with the method variables:
            $result->bindParam(':id', $id);
            $result->bindParam(':jobname', $name);
            $result->bindParam(':desc', $description);
            $result->bindParam(':company', $company);
            $result->bindParam(':requirements', $requirements);
            $result->bindParam(':skills', $skills);
            // Execute the Query: 
            $result->execute();
            
            // Check if the result was true: 
            if($result)
            {
                MyLogger2::info("Exit JobDataService.update() with true");
                return true;
            }
            else
            {
                MyLogger2::info("Exit JobDataService.update() with false");
                return false;
            }
        }
        catch(PDOException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(DatabaseException $dbe)
        {
            // Throwing Exception with message: 
            MyLogger2::error("Exception: ", array(
                "message" => $dbe->getMessage()
            ));
            return false;
        }
    }
    
    /**
     * Delete a Job from the Database: 
     * 
     * @param Job $job
     * @throws DatabaseException
     * @return \App\Model\$id|boolean
     */
    public function delete(Job $job)
    {
        MyLogger2::info("Enter JobDataService.delete()");
        try
        {
            // Store the ID of the Job into a variable from the Job object: 
            $id = $job->getId();
            // Build the Query to delete a job from the Database: 
            $result = $this->conn->prepare("DELETE FROM job WHERE ID =:id");
            // Bind the query variables with the method variables: 
            $result->bindParam(':id', $id);
            // Execute the Query: 
            $result->execute();
            
            // Check if result is true: 
            if($result)
            {
                MyLogger2::info("Exit JobDataService.delete() with true");
                return $id;
            }
            
            MyLogger2::info("Exit JobDataService.delete() with false");
            
            return false;
        }
        catch(PDOException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch (Exception $exc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $exc->getMessage()
            ));
            // Throwing Exception with message: 
            throw $exc->getMessage();
        }
    }
    
    /**
     * Finds matches based on userID
     * 
     * @param User $id
     * @throws DatabaseException
     */
    public function findMatches($id)
    {
        MyLogger2::info("Enter JobDataService.findMatches()");
        try
        {
            // Find all matching jobs.
            $result = $this->conn->prepare
                ("SELECT s.NAME, 
                		 j.ID, j.NAME, j.DESCRIPTION, j.COMPANY, j.REQUIREMENTS, j.SKILLS
                		 FROM 
                         skill as s
                         INNER JOIN job as j
                         ON j.SKILLS LIKE concat('%', s.NAME, '%') AND s.users_ID = :id");
            $result->bindParam(':id', $id);
            $result->execute();
            
            MyLogger2::info("Exit JobDataService.findMatches()");
            
            // Return an array of fetched results to the Business Service:
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch (Exception $exc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $exc->getMessage()
            ));
            // Throwing Exception with message:
            throw new $exc->getMessage();
        }
        
    }
    
    /**
     * Find available jobs by search
     * 
     * @throws DatabaseException
     * @return $results
     */
    public function findJobsBySearch($search)
    {
        MyLogger2::info("Enter JobDataService.findJobsBySearch()");
        try
        {
            // Find all matching jobs.
            $result = $this->conn->prepare
            ("SELECT * 
                FROM job
                WHERE concat(job.ID, '', job.NAME, '', job.DESCRIPTION, '', job.COMPANY, '', job.REQUIREMENTS, '', job.SKILLS)
                LIKE concat('%', :search, '%')");
            $result->bindParam(':search', $search);
            $result->execute();
            
            MyLogger2::info("Exit JobDataService.findJobsBySearch()");
            
            // Return an array of fetched results to the Business Service:
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            MyLogger2::error("PDOException: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch (Exception $exc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $exc->getMessage()
            ));
            throw new $exc->getMessage();
        }
    }
    
    
}