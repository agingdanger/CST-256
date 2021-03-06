<?php
namespace App\Services\Data;

use App\Model\User;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;
use PDO;
use PDOException;
use App\Services\Utility\ILoggerService;

class AdminDataService
{
    // Declare class variables: 
    private $conn;

    // Default Constructor: 
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Get all users to populate the datatable
     *
     * @throws DatabaseException
     * @return
     */
    public function findAll()
    {
        MyLogger2::info("Enter AdminDataService.findAll()");
        try
        {
            // Find all the users except for the current userID.
            $userID = Session::get('userID');
            // Build the Query to find the User with the right ID:
            $result = $this->conn->prepare("SELECT * FROM users WHERE ID != :userid");
            // Bind the query variables with method variable: 
            $result->bindParam('userid', $userID);
            // Execute the Query: 
            $result->execute();

            MyLogger2::info("Exit AdminDataService.findAll()");
            
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function findByID()
    {
        MyLogger2::info("Enter AdminDataService.findByID()");
        try
        {
            // Find all the users except for the current userID.
            $userID = Session::get('userID');
            // Build the Query to find the User's info by their ID:
            $result = $this->conn->prepare("SELECT u.*,
        		p.PID, p.P_ABOUT_USER, p.P_SKILLS, p.P_MESSAGE,
                j.JOB_NAME, j.JOB_DESCRIPTION, j.JOB_YEARS, j.portfolio_ID,
                e.ED_NAME, e.ED_DESCRIPTION, e.ED_YEARS, e.ED_START_YEAR, e.ED_END_YEAR, e.portfolio_ID
                FROM
                users as u
                LEFT JOIN portfolio as p
                ON u.ID = p.users_ID
        		LEFT JOIN jobs as j
                on p.PID = j.portfolio_ID
                LEFT JOIN education as e
                on p.PID = e.portfolio_ID
                WHERE ID = :userid");
            // Bind the query variables with method variable:
            $result->bindParam('userid', $userID);
            // Execute the Query: 
            $result->execute();
            
            MyLogger2::info("Exit AdminDataService.findByID()");
            
            // Return the result with all the User's info: 
            return $result->fetchAll();
        }
        catch(PDOException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * This is used to suspend a user from the AdminDataService
     * @param User $user
     * @throws DatabaseException
     * @return boolean
     */
    public function update(User $user)
    {
        MyLogger2::info("Enter AdminDataService.update()");
        try
        {
            // Store the User's info from the object param into variables: 
            $id = $user->getId();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $userName = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $phone = $user->getPhone();
            $role = $user->getRole();

            // Build the Query to update the User's info:
            $result = $this->conn->prepare("UPDATE users SET FIRST_NAME=:firstname, LAST_NAME=:lastname, USERNAME=:username, PASSWORD=:password, EMAIL=:email, PHONE=:phone, ROLE=:role WHERE ID=:id");
            // Bind the query variables with method variable:
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':firstname', $firstName);
            $result->bindParam(':lastname', $lastName);
            $result->bindParam(':username', $userName);
            $result->bindParam(':password', $password);
            $result->bindParam(':email', $email);
            $result->bindParam(':phone', $phone);
            $result->bindParam(':role', $role);
            // Execute the Query: 
            $result->execute();

            // Check if there is result: 
            if($result)
            {
                MyLogger2::info("Exit AdminDataService.update() with true");
                return true;
            }
            else
            {
                MyLogger2::info("Exit AdminDataService.update() with false");
                return false;
            }
        }
        catch(PDOException $pdoExc)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $pdoExc->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $pdoExc->getMessage(), 0, $pdoExc);
        }
        catch(DatabaseException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            return false;
        }
    }

    /**
     * Delete the User from the Database
     * @param User $user
     * @throws DatabaseException
     * @return boolean
     */
    public function delete(User $user)
    {
        MyLogger2::info("Enter AdminDataService.delete()");
        try
        {
            $id = $user->getId();
            $result = $this->conn->prepare("DELETE FROM users WHERE ID =:id");
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();

            if($result)
            {
                MyLogger2::info("Exit AdminDataService.delete() with id & true");
                return $id;
            }
            
            MyLogger2::info("Exit AdminDataService.delete() with false");
            return false;
        }
        catch(PDOException $e)
        {
            MyLogger2::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}