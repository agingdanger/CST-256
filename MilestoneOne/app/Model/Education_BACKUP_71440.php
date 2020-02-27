<?php

<<<<<<< HEAD
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
=======
namespace App\Model;

class Education
{
    private $id;
    private $name;
    private $years;
    private $major;
    private $minor;
    private $startyear;
    private $endyear;
    private $userID;
    
    public function __construct($id, $name, $years, $major, $minor, $startyear, $endyear, $userID)
    {
        $this->id = $id;
        $this->name = $name;
        $this->years = $years;
        $this->major = $major;
        $this->minor = $minor;
        $this->startyear = $startyear;
        $this->endyear = $endyear;
        $this->userID = $userID;
    }
    
    
>>>>>>> thedump
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
<<<<<<< HEAD
    public function getStart_year()
    {
        return $this->start_year;
=======
    public function getStartyear()
    {
        return $this->startyear;
>>>>>>> thedump
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function getEnd_year()
    {
        return $this->end_year;
=======
    public function getEndyear()
    {
        return $this->endyear;
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
     * @param mixed $years
     */
    public function setYears($years)
    {
        $this->years = $years;
    }

    /**
     * @param mixed $major
     */
    public function setMajor($major)
    {
        $this->major = $major;
    }

    /**
     * @param mixed $minor
     */
    public function setMinor($minor)
    {
        $this->minor = $minor;
    }

    /**
     * @param mixed $startyear
     */
    public function setStartyear($startyear)
    {
        $this->startyear = $startyear;
    }

    /**
     * @param mixed $endyear
     */
    public function setEndyear($endyear)
    {
        $this->endyear = $endyear;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
>>>>>>> thedump
    }

    
    
}