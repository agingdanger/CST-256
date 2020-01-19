<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use App\Services\Utility\db_connector;

class UserDataService
{

    public function findbyId(Request $request)
    {
        $conn = new db_connector();
        $connection = $conn->getConnection();
        
        $username = $request->input('username');
        $password = $request->input('password');
        
        
        
        if($connection)
        {
            $sql = "SELECT * FROM `USERS` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' LIMIT 1";
            
            $result = mysqli_query($connection, $sql);
        }
        else 
        {
            echo "error" . mysqli_error($connection);
        }
        
        return $result; 
    }

    public function create(Request $request)
    {
        $conn = new db_connector();
        $connection = $conn->getConnection();

        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = $request->input('role');
        
        if($firstName == "")
        {
            return false;
        }
        $sql = "INSERT INTO `USERS` (`ID`, `FIRST_NAME`, `LAST_NAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `PHONE`, `ROLE`) VALUES('', '$firstName', '$lastName', '$username', '$password', '$email', '$phone', '$role')";

        if (mysqli_query($connection, $sql))
        {
            return true; 
        }
        else
        {
            echo "User not added";
            echo " Error: " . $sql . "<br>" . mysqli_error($connection);
        }
        
        return false; 
    }
}