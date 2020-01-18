<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        
        //Display the form data
//         $firstName = $request->input('firstname');
//         $lastName = $request->input('lastname');
//         echo "Your name is: " . $firstName . " " . $lastName;
//         echo '<br>';
//         //Render a response view and pass the form data to it
//         $data = ['firstName' => $firstName, 'lastName' => $lastName];
//         return view('thatswhoiam') ->with($data);
    }
    public function onlogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        echo "Username = " . $username . " Password = " . $password;
        $credentials = ['username' => $username, 'password' => $password];
        return view('home') ->with($credentials);
    }
}
