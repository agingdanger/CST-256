<?php

namespace App\Model;

class Skill
{
   private $id;
   private $name;
   private $userID;
   
   public function __construct($id, $name, $userID)
   {
       $this->id = $id;
       $this->name = $name;
       $this->userID = $userID;
   }
   
/**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

/**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

/**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

/**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

/**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

/**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

}