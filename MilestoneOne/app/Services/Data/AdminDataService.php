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

class AdminDataService
{
    private $db;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function findAll()
    {
        try
        {
            $result = $this->conn->prepare("SELECT * FROM `users`");
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
        $role = $user->getRole();
        $result = $this->conn->prepare("UPDATE users SET ROLE=:role WHERE ID=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':role', $role);
        $result->execute();
        
        if($result){
            return true;
        }
        else{
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
            
            if($result){
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