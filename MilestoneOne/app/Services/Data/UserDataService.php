<?php
namespace App\Services\Data;

use Illuminate\Http\Request;
use App\Model\User;
use App\Services\Utility\db_connector;
use App\Model\userAttempt;

class UserDataService
{
    /**
     * findByID data service method to find the data in the database.  
     * @param userAttempt $userAttempt
     * @return $result from the executed SQL Statement. 
     */
    public function findbyId(userAttempt $userAttempt)
    {
        $conn = new db_connector();
        $connection = $conn->getConnection();
        
        $username = $userAttempt->getUsername();
        $password = $userAttempt->getPassword();
        
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

    /**
     * create data service method: Creating a new user in the database. 
     * @param Request $request
     * @return boolean
     */
    public function create(User $user)
    {
        $conn = new db_connector();
        $connection = $conn->getConnection();
        
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $phone = $user->getPhone();
        $role = $user->getRole();
        
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