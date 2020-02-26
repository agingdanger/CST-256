<?php
namespace App\Model;
class userCredentials
{

    private $username;
    private $password;

    // Creating a parameterized constructor to handle registrations:
    public function __construct($username, $password)
    {

        $this->username = $username;
        $this->password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

}