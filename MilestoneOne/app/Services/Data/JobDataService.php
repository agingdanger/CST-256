<?php
namespace App\Services\Data;

use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;
use PDOException;
use App\Model\Job;

class JobDataService
{
    // Create Class Variables: 
    private $db;
    private $conn;
    
    // Default Constructor: 
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
        try
        {
            // Find all jobs.
            $result = $this->conn->prepare("SELECT * FROM job");
            $result->execute();
            
            // Return an array of fetched results to the Business Service: 
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch(Exception $exc)
        {
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
                Log::info("Exit JobDataService.create() with true");
                return true;
            }
            else
            {
                Log::info("Exit JobDataService.create() with false");
                return false;
            }
        }
        catch (PDOException $pdoExc)
        {
            Log::error("Exception: ", array("message" => $pdoExc->getMessage));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch(Exception $e)
        {
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
            // Throwing Exception with message: 
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
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
        catch (Exception $exc)
        {
            // Throwing Exception with message: 
            throw $exc->getMessage();
        }
    }
}