<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;
use App\Model\User;
use App\Services\Utility\db_connector;
use App\Model\userAttempt;
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
     * @param userAttempt $userAttempt
     * @return $result from the executed SQL Statement.
     */
    public function findbyId(User $user)
    {
        try
        {
            // Get UserId:
            $userId = $user->getId();
            
            $result = $this->conn->prepare('SELECT * FROM `users` WHERE ID = :userId');
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
        catch (PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        return $result;
    }

    /**
     * findByID data service method to find the data in the database.  
     * @param userAttempt $userAttempt
     * @return $result from the executed SQL Statement. 
     */
    public function findbyUser(userAttempt $userAttempt)
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
        catch (PDOException $e) 
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        return $result; 
    }

    /**
     * create data service method: Creating a new user in the database. 
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
            
            //change this to :variable for bindparam
            $result = $this->conn->prepare("INSERT INTO `USERS` (`ID`, `FIRST_NAME`, `LAST_NAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `PHONE`, `ROLE`) VALUES(:id, :firstname, :lastname, :username, :password, :email, :phone, :role)");
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
        catch (PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function update(User $user)
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
            return true;
        }
        else
        {
            return false;
        }
    }
    
}