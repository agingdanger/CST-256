<?php

class Skill
{
    private $id;
    private $name;
    
    /**
     * Default Constructor 
     * @param $id
     * @param $name
     */
    public function __construct($id, $name) 
    {
        $this->id = $id;
        $this->name = $name;
    }
    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }
}