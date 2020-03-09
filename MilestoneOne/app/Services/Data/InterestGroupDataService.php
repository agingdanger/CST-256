<?php
namespace App\Services\Data;

use Exception;
use PDOException;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use App\Model\InterestGroup;

class InterestGroupDataService
{

    // Declare a connection variable
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function findAllGroups()
    {
        try
        {
            // Run the Query to find all the Groups available from the Database
            $result = $this->conn->prepare("SELECT * FROM interest_group");
            // Execute the Query
            $result->execute();
            
            // return the result
            return $result->fetchAll();            
        }
        catch(PDOException $el)
        {
            Log::error("Exception in IntGroupDataService's findAllGroups(): ", array(
                "message" => $el->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $el->getMessage(), 0, $el);
        }
        catch (Exception $e)
        {
        }
    }
    
    public function update(InterestGroup $interestGroup)
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
}