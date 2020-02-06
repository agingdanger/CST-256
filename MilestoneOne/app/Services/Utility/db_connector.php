<?php
namespace App\Services\Utility;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class db_connector
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "cst-256_ms";
    
    /**
     * getConnection method connecting to the database. 
     * @return $connection after executing the mysqli_connect.
     */
    function getConnection()
    {
        $port = config("database.connections.mysql.port");
        $servername = config("database.connections.mysql.host");
        $
        
        $db = new PDO("mysql:host=$servername;port")
        
        $connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        
        if($connection->connect_error)
        {
            echo "Connection Failed " . $connection->connect_error . "<br>";
        }
        else
        {
            return $connection;
        }
    }
}