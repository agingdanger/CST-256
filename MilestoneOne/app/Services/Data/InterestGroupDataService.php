<?php
namespace App\Services\Data;

use Exception;
use PDOException;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Model\InterestGroup;

class InterestGroupDataService
{
    // Declare class variables:
    private $conn;
    
    // Non-Default Constructor:
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * find the available Group.
     *
     * @throws DatabaseException
     * @return $result->fetchAll()
     */
    public function findInterestGroupByID($igid)
    {
        MyLogger2::info("Enter InterestGroupDataService.findInterestGroupByID()");
        try
        {
            // Run the Query to find all the Groups available from the Database
            $result = $this->conn->prepare("SELECT * FROM interest_group WHERE ID=:id");
            // Bind the params with variables:
            $result->bindParam(':id', $igid);
            // Execute the Query
            $result->execute();

            MyLogger2::info("Exit InterestGroupDataService.findInterestGroupByID()");

            // return the result
            return $result->fetchAll();
        }
        catch (PDOException $el)
        {
            // Logging in the
            MyLogger2::error("PDOException in IntGroupDataService.findInterestGroupByID(): ", array(
                "message" => $el->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $el->getMessage(), 0, $el);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exception in IntGroupDataService.findInterestGroupByID(): ", array(
                "message" => $e->getMessage()
            ));
            throw new $e->getMessage();
        }
    }

    /**
     * find the available Group.
     *
     * @throws DatabaseException
     * @return $result->fetchAll()
     */
    public function findUsersByGroup($igid)
    {
        MyLogger2::info("Enter InterestGroupDataService.findUsersByGroup()");
        try
        {
            // Run the Query to find all the Groups available from the Database
            $result = $this->conn->prepare("SELECT 
                                                i.USERNAME
                                                FROM 
                                                users as i
                                                LEFT JOIN user_interest as u
                                                ON i.ID = u.users_ID
                                                LEFT JOIN interest_group as ii
                                                on u.interest_group_id = ii.ID
                                                WHERE u.interest_group_ID=:id");
            // Bind the params with variables:
            $result->bindParam(':id', $igid);
            // Execute the Query
            $result->execute();

            MyLogger2::info("Exit InterestGroupDataService.findUsersByGroup()");
            
            // return the result
            return $result->fetchAll();
        }
        catch (PDOException $el)
        {
            MyLogger2::error("PDOException in IntGroupDataService.findUsersByGroup(): ", array(
                "message" => $el->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $el->getMessage(), 0, $el);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exception in IntGroupDataService.findUsersByGroup(): ", array(
                "message" => $e->getMessage()
            ));
            throw new $e->getMessage();
        }
    }

    /**
     * find all the Interest Groups available.
     *
     * @throws DatabaseException
     * @return $result->fetchAll()
     */
    public function findAllGroups()
    {
        MyLogger2::info("Enter InterestGroupDataService.findAllGroups()");
        try
        {
            // Run the Query to find all the Groups available from the Database
            $result = $this->conn->prepare("SELECT * FROM interest_group");
            // Execute the Query
            $result->execute();

            MyLogger2::info("Exit InterestGroupDataService.findAllGroups()");
            
            // return the result
            return $result->fetchAll();
        }
        catch (PDOException $el)
        {
            MyLogger2::error("PDOException in IntGroupDataService.findAllGroups(): ", array(
                "message" => $el->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $el->getMessage(), 0, $el);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exception in IntGroupDataService.findAllGroups(): ", array(
                "message" => $e->getMessage()
            ));
            throw new $e->getMessage();
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
        MyLogger2::info("Enter InterestGroupDataService.create()");
        try
        {
            // Put all the data from $interestGroup into variables:
            $id = $interestGroup->getId();
            $name = $interestGroup->getName();
            $description = $interestGroup->getDescription();
            $tags = $interestGroup->getTags();
            $users_id = Session::get('userID');

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

            // pull interest group ID from database that was just created to add user to interest group
            $igid = $this->conn->lastInsertId();

            $result2 = $this->conn->prepare("INSERT INTO user_interest (`ID`, `interest_group_ID`, `users_ID`) VALUES (:id, :interest_group_id, :users_id)");
            $result2->bindParam(':id', $id);
            $result2->bindParam(':interest_group_id', $igid);
            $result2->bindParam(':users_id', $users_id);

            // Execute
            $result2->execute();

            // Check if result was successful:
            if ($result->rowCount() == 1)
            {
                MyLogger2::info("Exit InterestGroupDataService.create() with true");
                return true;
            }
            else
            {
                MyLogger2::info("Exit InterestGroupDataService.create() with false");
                return false;
            }
        }
        catch (PDOException $pdoExc)
        {
            MyLogger2::error("PDOException: ", array(
                "message" => $pdoExc->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exception in IntGroupDataService.findUsersByGroup(): ", array(
                "message" => $e->getMessage()
            ));
            
            // Throwing Exception with message:
            throw new $e->getMessage();
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
        MyLogger2::info("Enter InterestGroupDataService.update()");
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
                MyLogger2::info("Exit InterestGroupDataService.update() with true");
                return true;
            }
            else
            {
                MyLogger2::info("Exit InterestGroupDataService.update() with false");
                return false;
            }
        }
        catch (PDOException $pdoExc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $pdoExc->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch (DatabaseException $e)
        {
            // Throwing Exception with message:
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
    }

    /**
     * Add an interested user to a group.
     *
     * @param InterestGroup $interestGroup
     * @throws DatabaseException
     * @return boolean
     */
    public function addInterestedUser($igid)
    {
        MyLogger2::info("Enter InterestGroupDataService.addInterestedUser()");
        try
        {
            // Place variables values to ready the queries
            $id = "";
            $users_id = Session::get('userID');

            // Build the Query:
            $result2 = $this->conn->prepare("INSERT INTO user_interest (`ID`, `interest_group_ID`, `users_ID`) VALUES (:id, :interest_group_id, :users_id)");
            // Bind the params with variables:
            $result2->bindParam(':id', $id);
            $result2->bindParam(':interest_group_id', $igid);
            $result2->bindParam(':users_id', $users_id);

            // Execute the Query:
            $result2->execute();

            // Check if result was successful:
            if ($result2->rowCount() == 1)
            {
                MyLogger2::info("Exit InterestGroupDataService.addInterestedUser() with true");
                return true;
            }
            else
            {
                MyLogger2::info("Exit InterestGroupDataService.addInterestedUser() with false");
                return false;
            }
        }
        catch (PDOException $pdoExc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $pdoExc->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exception in IntGroupDataService.addInterestedUser(): ", array(
                "message" => $e->getMessage()
            ));
            // Throwing Exception with message:
            throw new $e->getMessage();
        }
    }

    /**
     * Deletes an Interest Group along with the rows from bridging table.
     *
     * @param
     *            $id
     * @throws DatabaseException
     * @return boolean
     */
    public function delete($id)
    {
        MyLogger2::info("Enter InterestGroupDataService.delete()");
        try
        {
            // Build the Query to delete a job from the Database:
            $result = $this->conn->prepare("DELETE FROM interest_group WHERE ID =:id");
            // Bind the query variables with the method variables:
            $result->bindParam(':id', $id);
            // Execute the Query:
            $result->execute();

            // Check if result is true:
            if ($result)
            {
                MyLogger2::info("Exit InterestGroupDataService.delete() with true");
                return $id;
            }
            
            MyLogger2::info("Exit InterestGroupDataService.delete() with false");
            return false;
        }
        catch (PDOException $e)
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
            // Throwing Exception with message:
            throw new $exc->getMessage();
        }
    }
}