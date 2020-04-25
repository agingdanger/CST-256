<?php
namespace App\Model;


class Job implements \JsonSerializable
{
    private $id;
    private $name;
    private $description;
    private $company;
    private $requirements;
    private $skills;
    
    public function __construct($id, $name, $description, $company, $requirements, $skills)
    {
        $this->id = $id; 
        $this->name = $name;
        $this->description = $description;
        $this->company = $company; 
        $this->requirements = $requirements;
        $this->skills = $skills;
    }
    
    /**
     * Serializes JSON
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return $JobName
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
    /**
     * @return $skills
     */
    public function getSkills()
    {
        return $this->skills;
    }
    
}