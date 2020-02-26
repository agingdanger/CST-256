<?php
namespace App\Model;

use Illuminate\Queue\Jobs\JobName;

class Job
{
    private $id;
    private $name;
    private $description;
    private $company;
    private $requirements;
    
    public function __construct($id, $name, $description, $company, $requirements)
    {
        $this->id = $id; 
        $this->name = $name;
        $this->description = $description;
        $this->company = $company; 
        $this->requirements = $requirements;
    }
    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return JobName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return $requirements
     */
    public function getRequirements()
    {
        return $this->requirements;
    }    
}