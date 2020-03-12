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

    /**
     * find all the Interest Groups available. 
     * 
     * @throws DatabaseException
     * @return $result->fetchAll()
     */
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
        catch (PDOException $el)
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

    /**
     * Create an Interest Group.
     *
     * @param InterestGroup $interestGroup
     * @throws DatabaseException
     * @return boolean
     */
    public function create(InterestGroup $interestGroup)
    {
        try
        {
            // Put all the data from $interestGroup into variables:
            $id = $interestGroup->getId();
            $name = $interestGroup->getName();
            $description = $interestGroup->getDescription();
            $tags = $interestGroup->getTags();
            $users_id;

            // Build the Query to add a job into the database:
            $result = $this->conn->prepare("INSERT INTO interest_group (`ID`, `NAME`, `DESCRIPTION`, `TAGS`, `USERS_ID`) VALUES (:id, :name, :description, :tags, :users_id)");
            // Bind all the values by matching them with the variables created:
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':description', $description);
            $result->bindParam(':tags', $tags);
            $result->bindParam(':users_id', $users_id);

            // Execute the query:
            $result->execute();

            // Check if result was successful:
            if ($result->rowCount() == 1)
            {
                Log::info("Exit InterestGroupDataService.create() with true");
                return true;
            }
            else
            {
                Log::info("Exit InterestGroupDataService.create() with false");
                return false;
            }
        }
        catch (PDOException $pdoExc)
        {
            Log::error("Exception: ", array(
                "message" => $pdoExc->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Update the Interest Group's fields.
     *
     * @param InterestGroup $interestGroup
     * @throws DatabaseException
     * @return boolean
     */
    public function update(InterestGroup $interestGroup)
    {
        try
        {
            // Put all the data from $job into variables:
            $id = $interestGroup->getId();
            $name = $interestGroup->getName();
            $description = $interestGroup->getDescription();
            $tags = $interestGroup->getTags();

            // Build the Query to Update the Job's info into the database:
            $result = $this->conn->prepare("UPDATE interest_group SET NAME=:name, DESCRIPTION=:desc, TAGS=:tags WHERE ID=:id");
            
            // Bind all the query variables with the method variables:
            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':desc', $description);
            $result->bindParam(':tags', $tags);

            // Execute the Query:
            $result->execute();

            // Check if the result was true:
            if ($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        catch (DatabaseException $e)
        {
            // Throwing Exception with message:
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
    }
    
    public function delete($id)
    {
        try
        {
            // Build the Query to delete a job from the Database:
            $result = $this->conn->prepare("DELETE FROM interest_group WHERE ID =:id");
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