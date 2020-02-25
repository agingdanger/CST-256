<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PDO;
use PDOException;
use App\Model\User;
use App\Services\Utility\db_connector;
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
            $result = $this->conn->prepare("SELECT * FROM users WHERE ID != :userid");
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
    
    public function findByID()
    {
        try
        {
            // Find all the users except for the current userID.
            $userID = Session::get('userID');
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

    /**
     * This is used to suspend a user from the AdminDataService
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
     * Delete the User from the Database
     * @param User $user
     * @throws DatabaseException
     * @return unknown|mixed|boolean
     */
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