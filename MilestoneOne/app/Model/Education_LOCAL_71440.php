<?php

class Education
{
    private $id;
    private $name; 
    private $years;
    private $major; 
    private $minor; 
    private $start_year;
    private $end_year;
    
    public function __construct($id, $name, $years, $major, $minor, $start_year, $end_year)
    {
        $this->id = $id; 
        $this->name = $name; 
        $this->years = $years; 
        $this->major = $major; 
        $this->minor = $minor; 
        $this->start_year = $start_year; 
        $this->end_year = $end_year;
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
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @return mixed
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * @return mixed
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * @return mixed
     */
    public function getStart_year()
    {
        return $this->start_year;
    }

    /**
     * @return mixed
     */
    public function getEnd_year()
    {
        return $this->end_year;
    }

    
    
}