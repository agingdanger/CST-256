<?php
namespace App\Services\Business;
use Illuminate\Http\Request;
use App\Services\Data\UserDataService;

class SecurityService
{
    public function authenticate(Request $request)
    {        
        $userData = new UserDataService();
        $result = $userData->findbyId($request);
        
        if (mysqli_num_rows($result))
        {
//             $row = mysqli_fetch_assoc($result);
            
            /* $_SESSION['firstName'] = $row['FIRSTNAME'];
            $_SESSION['lastName'] = $row['LASTNAME'];
            $_SESSION['username'] = $row['USERNAME'];
            $_SESSION['password'] = $row['PASSWORD'];
            $_SESSION['email'] = $row['EMAIL'];
            $_SESSION['phone'] = $row['PHONE'];
            $_SESSION['role'] = $row['ROLE']; */
            
            echo "Login Successful";
        }
        else
        {
            echo "Login unsuccessful";
        }
    }
}