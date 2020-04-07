<?php

namespace App\Model;

class DTO implements \JsonSerializable
{
    private $errCode;
    private $errMessage;
    private $data;
    
    public function __construct($errCode, $errMessage, $data) 
    {
        $this->errCode = $errCode;
        $this->errMessage = $errMessage;
        $this->data = $data;
    }
    
    public function jsonSerialize() 
    {
        return get_object_vars($this);
    }
}