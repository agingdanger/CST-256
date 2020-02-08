<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PDO;
use PDOException;
use App\Model\User;
use App\Services\Utility\db_connector;
use App\Model\userAttempt;
use App\Services\Utility\DatabaseException;

class AdminDataService
{
    private $db;
    private $conn;

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
        try
        {
            // Find all the users except for the current userID.
            $userID = Session::get('userID');
            $result = $this->conn->prepare("SELECT * FROM `users` WHERE ID != :userid");
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
        $result->bindParam(':id', $id, PDO::PARAM_INT);
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

    public function delete(User $user)
    {
        try
        {
            $id = $user->getId();
            $result = $this->conn->prepare("DELETE FROM users WHERE ID =:id");
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();

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
    }
}