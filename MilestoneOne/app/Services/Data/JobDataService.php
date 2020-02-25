<?php
namespace App\Services\Data;

use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;
use PDOException;

class JobDataService
{
    private $db;
    private $conn;
    
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
            // $userID = Session::get('userID');
            $result = $this->conn->prepare("SELECT * FROM job");
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
        catch(Exception $exc)
        {
            throw $exc->getMessage();
        }
    }
    
    
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
            
            $result = $this->conn->prepare("INSERT INTO job (`ID`, `NAME`, `DESCRIPTION`, `COMPANY`, `REQUIREMENTS`, `SKILLS`) VALUES (:id, :name, :description, :company, :requirements, :skills)");
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':description', $description);
            $result->bindParam(':company', $company);
            $result->bindParam(':requirements', $requirements);
            $result->bindParam(':skills', $skills);
            
            $result->execute();
            
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
            throw $e->getMessage();
        }
    }
}