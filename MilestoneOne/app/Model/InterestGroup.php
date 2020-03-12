<?php

namespace App\Model;

class InterestGroup
{
    private $id;
    private $name;
    private $description;
    private $tags;
    private $users_id;
    
    public function __construct($id, $name, $description, $tags, $users_id) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->tags = $tags;
        $this->users_id = $users_id;
    }
    
    // get JSON format if needed; 
    public function jsonSerialize()
    {
        return get_object_vars($this);
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * @return mixed
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }
    
}