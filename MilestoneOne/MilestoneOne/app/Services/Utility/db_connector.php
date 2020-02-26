<?php
namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;
use App\Services\Utility\DatabaseException;

class db_connector
{
    
    private $db;
    /**
     * getConnection method connecting to the database.
     *
     * @return $connection after executing the mysqli_connect.
     */
    public function getConnection()
    {
        try {
            $servername = config("database.connections.mysql.host");
            $port = config("database.connections.mysql.port");
            $username = config("database.connections.mysql.username");
            $password = config("database.connections.mysql.password");
            $dbname = config("database.connections.mysql.database");

            $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (PDOException $e) {
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception:" . $e->getMessage(), 0, $e);
        }

    }
    
//     public function getDb() {
//         if ($this->db instanceof PDO) {
//             return $this->db;
//         }
//     }
}