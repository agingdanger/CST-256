<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;
use App\Model\User;
use App\Model\userCredentials;
use App\Services\Utility\DatabaseException;

class UserDataService
{
    private $db;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * findByID data service method to find the data in the database.
     *
     * @param userCredentials $userAttempt
     * @return $result from the executed SQL Statement.
     */
    public function findbyId(User $user)
    {
        try
        {
            // Get UserId:
            $userId = $user->getId();

            $result = $this->conn->prepare('SELECT ID, FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL, PHONE, ROLE FROM `users` WHERE ID = :userId');
            $result->bindParam(':userId', $userId);
            $result->execute();

            // Check if Result has any result:
            if($result->rowCount() == 1)
            {
                Log::info("Exit UserDataService.findById() with true");
                return $result->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                Log::info("Exit UserDataService.findById() with false");
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
     * findByID data service method to find the data in the database.
     *
     * @param userCredentials $userAttempt
     * @return $result from the executed SQL Statement.
     */
    public function findbyUser(userCredentials $userAttempt)
    {
        try
        {
            $username = $userAttempt->getUsername();
            $password = $userAttempt->getPassword();

            $result = $this->conn->prepare('SELECT ID, FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL, PHONE, ROLE FROM `users` WHERE USERNAME = :username AND PASSWORD = :password');
            $result->bindParam(':username', $username);
            $result->bindParam(':password', $password);
            $result->execute();

            if($result->rowCount() == 1)
            {
                Log::info("Exit UserDataService.findByUser() with true");
                return $result->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                Log::info("Exit UserDataService.findByUser() with false");
                return false;
            }
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
     * create data service method: Creating a new user in the database.
     *
     * @param Request $request
     * @return boolean
     */
    public function create(User $user)
    {
        try
        {
            $id = $user->getId();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $phone = $user->getPhone();
            $role = $user->getRole();

            // change this to :variable for bindparam
            $result = $this->conn->prepare("INSERT INTO `users` (`ID`, `FIRST_NAME`, `LAST_NAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `PHONE`, `ROLE`) VALUES(:id, :firstname, :lastname, :username, :password, :email, :phone, :role)");
            $result->bindParam(':id', $id);
            $result->bindParam(':firstname', $firstName);
            $result->bindParam(':lastname', $lastName);
            $result->bindParam(':username', $username);
            $result->bindParam(':password', $password);
            $result->bindParam(':email', $email);
            $result->bindParam(':phone', $phone);
            $result->bindParam(':role', $role);
            $result->execute();

            if($result->rowCount() == 1)
            {
                Log::info("Exit UserDataService.findByUser() with true");
                return true;
            }
            else
            {
                Log::info("Exit UserDataService.findByUser() with false");
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

    /**
     * Update User's Fields
     * 
     * @param User $user
     * @throws DatabaseException
     * @return boolean
     */
    public function update(User $user)
    {
        try
        {
            $id = $user->getId();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $userName = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $phone = $user->getPhone();
            $role = $user->getRole();

            $result = $this->conn->prepare("UPDATE users SET FIRST_NAME=:firstname, LAST_NAME=:lastname, USERNAME=:username, PASSWORD=:password, EMAIL=:email, PHONE=:phone, ROLE=:role WHERE ID=:id");
            $result->bindParam(':id', $id);
            $result->bindParam(':firstname', $firstName);
            $result->bindParam(':lastname', $lastName);
            $result->bindParam(':username', $userName);
            $result->bindParam(':password', $password);
            $result->bindParam(':email', $email);
            $result->bindParam(':phone', $phone);
            $result->bindParam(':role', $role);
            $result->execute();

            if($result)
            {
                return $result;
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
        /*
         * MUST GET BACK HERE TO SHOW WHAT THE ERROR IS TO THE USER ON UPDATING/MAKING CHANGES
         * TO A USERNAME OR EMAIL THAT ARE UNIQUE.
         */
        finally
        {
            return false;
        }
    }
    
    /* ----------------------------- REST Data Service Methods -------------------------------- */
    
    /**
     * Find all Users and return an array of User objects.
     * 
     * @throws DatabaseException
     * @return array|\App\Model\User[]
     */
    public function findAllUsers()
    {
        try
        {
            // Build the Query to find the User with the right ID:
            $result = $this->conn->prepare("SELECT * FROM users");
            // Execute the Query:
            $result->execute();
            
            if($result->rowCount() == 0)
            {
                return array();
            }
            else
            {
                // Create an array and store User objects in the array.
                $index = 0;
                $users = array();
                while($row = $result->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a User object for each iteration to be added into the Users Array
                    $user = new User($row['ID'], $row['FIRST_NAME'], $row['LAST_NAME'], $row['USERNAME'], $row['PASSWORD'], $row['EMAIL'], $row['PHONE'], $row['ROLE']);
                    $users[$index++] = $user;
                }
                // Return the array of Users
                return $users;
            }
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
     * Find a User by the ID and return a User object
     * 
     * @param $id
     * @throws DatabaseException
     * @return $user|\App\Model\User
     */
    public function findByUserID($id)
    {
        try
        {
            // Build the Query
            $stmt = $this->conn->prepare("SELECT ID, FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL, PHONE, ROLE FROM users WHERE ID =:id");
            // Bind all the param with the variables
            $stmt->bindParam(':id', $id);
            // Execute the Query:
            $stmt->execute();
            
            // Checks if any Users exist by the inputted ID
            if ($stmt->rowCount() == 0)
            {
                return null;
            }
            else
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new User($row['ID'], $row['FIRST_NAME'], $row['LAST_NAME'], $row['USERNAME'], $row['PASSWORD'], $row['EMAIL'], $row['PHONE'], $row['ROLE']);
                return $user;
            }
        }
        catch (PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
}