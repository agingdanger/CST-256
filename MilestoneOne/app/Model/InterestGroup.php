<?php

namespace App\Model;

class InterestGroup
{
    private $id;
    private $name;
    private $description;
    private $tags;
    
    public function __construct($id, $name, $description, $tags) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->tags = $tags;
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

    
}