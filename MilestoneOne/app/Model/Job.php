<?php
namespace App\Model;

class Job
{
    private $name;
    private $description;
    private $company;
    private $requirements;
    
    public function __construct($name, $description, $company, $requirements)
    {
        $this->name = $name;
        $this->description = $description;
        $this->company = $company; 
        $this->requirements = $requirements;
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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }    
}