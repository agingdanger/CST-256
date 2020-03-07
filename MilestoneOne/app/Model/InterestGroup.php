<?php

namespace App\Model;

class InterestGroup
{
    private $id;
    private $name;
    private $description;
    private $tag;
    
    public function __construct($id, $name, $description, $tag) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->tag = $tag;
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
    public function getTag()
    {
        return $this->tag;
    }

    
}