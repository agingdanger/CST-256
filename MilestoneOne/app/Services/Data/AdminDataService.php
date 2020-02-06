<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use App\Model\User;
use App\Services\Utility\db_connector;
use App\Model\userAttempt;

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
        $users = array();
        
        $result = $this->conn->prepare("SELECT * FROM `USERS`");
        $result->execute();
            
        if($connection)
        {
            $sql = "SELECT * FROM `USERS`";
            
            $result = mysqli_query($connection, $sql);
            
            while($row = mysqli_fetch_assoc($result))
            {
                $users[] = array($row['ID'], $row['FIRST_NAME'], $row['LAST_NAME'], $row['USERNAME'], $row['PASSWORD'], $row['EMAIL'], $row['PHONE'], $row['ROLE']);
            }
        }
        else
        {
            echo "error" . mysqli_error($connection);
        }
        
        return $result;
    }
    
    public function update(User $user)
    {
        
    }
    
    public function delete(User $user)
    {
        
    }
    
}