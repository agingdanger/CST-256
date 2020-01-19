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
    
    // Create connection
    function getConnection()
    {
        $connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, 3308);
        
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