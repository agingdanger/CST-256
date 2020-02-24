<?php

class JobHistory
{
    private $id; 
    private $name; 
    private $position;
    private $description; 
    private $awards; 
    private $start_date; 
    private $end_date; 
    
    /**
     * Default Constructor
     * @param $id
     * @param $name
     * @param $position
     * @param $description
     * @param $awards
     * @param $start_date
     * @param $end_date
     */
    public function __construct($id, $name, $position, $description, $awards, $start_date, $end_date)
    {
        $this->id = $id; 
        $this->name = $name;
        $this->position = $position; 
        $this->description = $description;
        $this->awards = $awards;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
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
    public function getPosition()
    {
        return $this->position;
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
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * @return mixed
     */
    public function getStart_date()
    {
        return $this->start_date;
    }

    /**
     * @return mixed
     */
    public function getEnd_date()
    {
        return $this->end_date;
    }
}