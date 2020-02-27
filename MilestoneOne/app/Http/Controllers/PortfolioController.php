<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Model\JobHistory;
use App\Model\Education;
use App\Model\Skill;
use App\Services\Business\PortfolioBusinessService;
use Dotenv\Exception\ValidationException;

class PortfolioController extends Controller
{
    public function onAddWorkExperience(Request $request)
    {
        // Call the Validation Rules: 
        $this->validateJobHistoryForm($request);
        
        try
        {
            $id = "";
            $jobName = $request->input('jobname');
            $jobPosition = $request->input('jobposition');
            $jobDescription = $request->input('jobdescription');
            $jobAward = $request->input('jobaward');
            $jobStartDate = $request->input('jobstartdate');
            $jobEndDate = $request->input('jobenddate');
            $userID = $request->input('userid');
            
            // Create a Job History Object and populate the data
            $job = new JobHistory($id, $jobName, $jobPosition, $jobDescription, $jobAward, $jobStartDate, $jobEndDate, $userID);
            
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->postJobExperience($job);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
        }
        catch (ValidationException $valExc)
        {
            throw $valExc;
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onAddSkill(Request $request)
    {
        // Call the Validation Rule: 
        $this->validateSkillForm($request);
        
        try
        {
            $id = "";
            $skillName = $request->input('skillname');
            $userID = $request->input('userid');
            
            //Create a skill object to be added
            $skill = new Skill($id, $skillName, $userID);
            
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->postSkillExperience($skill);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            if($portfolioStatus)
            {
                return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
            }
            else{
                return view('error.error');
            }
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onAddEducation(Request $request)
    {
        // Call the Validation Form: 
        $this->validateEducationForm($request);
        
        try
        {
            $id = "";
            $edName = $request->input('edname');
            $edYears = $request->input('edyears');
            $edMajor = $request->input('edmajor');
            $edMinor = $request->input('edminor');
            $edStartYear = $request->input('edstartyear');
            $edEndYear = $request->input('edendyear');
            $userID = $request->input('userid');
            
            //Create an education object to be added
            $ed = new Education($id, $edName, $edYears, $edMajor, $edMinor, $edStartYear, $edEndYear, $userID);
            
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->postEducationExperience($ed);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            if($portfolioStatus)
            {
                return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
            }
            else{
                return view('error.error');
            }
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onJobRemoval(Request $request)
    {
//         try
//         {
            $userID = Session::get("userID");
            $id = $request->input('jobid');
            
            $portfolioBusiness = new PortfolioBusinessService();
            
            $portfolioStatus = $portfolioBusiness->removeUserJob($id);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
            
//         }
//         catch(Exception $e)
//         {
//             return view('error.commonError');
//         }
    }
    
    public function onEducationRemoval(Request $request)
    {
        //         try
        //         {
        
        
        $userID = Session::get("userID");
        $id = $request->input('edid');
        
        $portfolioBusiness = new PortfolioBusinessService();
        
        $portfolioStatus = $portfolioBusiness->removeUserEducation($id);
        
        $jobs = $portfolioBusiness->retrieveUserJobs($userID);
        
        $skills = $portfolioBusiness->retrieveUserSkills($userID);
        
        $education = $portfolioBusiness->retrieveUserEducation($userID);
        
        return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
        
        //         }
        //         catch(Exception $e)
        //         {
        //             return view('error.commonError');
        //         }
        }
        
        public function onSkillRemoval(Request $request)
        {
            //         try
            //         {
            
            
                $userID = Session::get("userID");
                $id = $request->input('skillid');
                
                $portfolioBusiness = new PortfolioBusinessService();
                
                $portfolioStatus = $portfolioBusiness->removeUserSkill($id);
                
                $jobs = $portfolioBusiness->retrieveUserJobs($userID);
                
                $skills = $portfolioBusiness->retrieveUserSkills($userID);
                
                $education = $portfolioBusiness->retrieveUserEducation($userID);
                
                return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
                
//                 }
//                 catch(Exception $e)
//                 {
//                     return view('error.commonError');
//                 }
            }
            
    
    
    public function onPersonalPortfolioRetrieval(Request $request)
    {
        try
        {
            $userID = Session::get('userID');
            
            $portfolioBusiness = new PortfolioBusinessService();
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);

        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onRouteJobEdit(Request $request)
    {        
        try
        {
            $id = $request->input('jobid');
            $name = $request->input('jobname');
            $position = $request->input('jobposition');
            $description = $request->input('jobdescription');
            $awards = $request->input('jobawards');
            $startDate = $request->input('jobstartdate');
            $endDate = $request->input('jobenddate');
            $userID = Session::get('userID');
            
            $job = new JobHistory($id, $name, $position, $description, $awards, $startDate, $endDate, $userID);
           
            
            return view('portfolio.editJobHistory')->with('job', $job);
            
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onRouteEducationEdit(Request $request)
    {
//         try
//         {
            $id = $request->input('edid');
            $name = $request->input('edname');
            $years = $request->input('edyears');
            $major = $request->input('edmajor');
            $minor = $request->input('edminor');
            $startYear = $request->input('edstartyear');
            $endYear = $request->input('edendyear');
            $userID = Session::get('userID');
            
            $ed = new Education($id, $name, $years, $major, $minor, $startYear, $endYear,  $userID);
            
            return view('portfolio.editEducation')->with('ed', $ed);
            
//         }
//         catch(Exception $e)
//         {
//             return view('error.commonError');
//         }
    }
    
    public function onRouteSkillEdit(Request $request)
    {
        try
        {
            $id = $request->input('skillid');
            $skillName = $request->input('skillname');
            $userID = $request->input('userid');
            
            //Create a skill object to be added
            $skill = new Skill($id, $skillName, $userID);
            
            return view('portfolio.editSkill')->with('skill', $skill);
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onJobEdit(Request $request)
    {
        // Call the Validation Rules:
        $this->validateJobHistoryForm($request);
        
        try
        {
            $id = $request->input('jobid');
            $name = $request->input('jobname');
            $position = $request->input('jobposition');
            $description = $request->input('jobdescription');
            $awards = $request->input('jobawards');
            $startDate = $request->input('jobstartdate');
            $endDate = $request->input('jobenddate');
            $userID = Session::get('userID');
            
            $job = new JobHistory($id, $name, $position, $description, $awards, $startDate, $endDate, $userID);
            
            $portfolioBusiness = new PortfolioBusinessService();
            
            $portfolioStatus = $portfolioBusiness->modifyJobHistory($job);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            if($portfolioStatus)
            return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
            
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onEducationEdit(Request $request)
    {
        // Call the Validation Rule: 
        $this->validateEducationForm($request);
        
        try
        {
            $id = $request->input('edid');
            $name = $request->input('edname');
            $years = $request->input('edyears');
            $major = $request->input('edmajor');
            $minor = $request->input('edminor');
            $startYear = $request->input('edstartyear');
            $endYear = $request->input('edendyear');
            $userID = Session::get('userID');
            
            $ed = new Education($id, $name, $years, $major, $minor, $startYear, $endYear,  $userID);
            
            $portfolioBusiness = new PortfolioBusinessService();
            
            $portfolioStatus = $portfolioBusiness->modifyEducationHistory($ed);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            if($portfolioStatus)
                return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
                
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    public function onSkillEdit(Request $request)
    {
        // Call the Validation Rule: 
        $this->validateSkillForm($request);
        
        try
        {
            $id = $request->input('skillid');
            $name = $request->input('skillname');
            $userID = Session::get('userID');
            
            $skill = new Skill($id, $name, $userID);
            
            $portfolioBusiness = new PortfolioBusinessService();
            
            $portfolioStatus = $portfolioBusiness->modifySkillHistory($skill);
            
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            
            $education = $portfolioBusiness->retrieveUserEducation($userID);
            
            if($portfolioStatus)
                return view('portfolio.portfolio')->with('jobs', $jobs)->with('skills', $skills)->with('education', $education);
                
        }
        catch(Exception $e)
        {
            return view('error.commonError');
        }
    }
    
    /**
     * Validation Rules for JobHistory Forms: 
     * @param Request $request
     */
    private function validateJobHistoryForm(Request $request)
    {
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'jobname' => 'Required | Max: 40 | Alpha',
            'jobposition' => 'Required | Between: 4, 50',
            'jobdescription' => 'Required | Max: 1000',
            'jobaward' => 'Required | Between: 4, 50',
            'jobstartdate' => 'Required | Date',
            'jobenddate' => 'Required | Date'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
    }
    
    
    private function validateEducationForm(Request $request)
    {
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'edname' => 'Required | Between: 4, 50 | Alpha',
            'edyears' => 'Required | Numeric | Between: 1, 80',
            'edmajor' => 'Required | Between: 4, 50',
            'edminor' => 'Required | Between: 4, 50',
            'edstartyear' => 'Required | Digits: 4',
            'edendyear' => 'Required | Digits: 4'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
    }
    
    private function validateSkillForm(Request $request)
    {
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules
        
        // Setup Data Validation Rules for Login Form.
        $rules = [
            'skillname' => 'Required | Alpha | Between: 4, 150'
        ];
        
        // Run Validation Rules:
        $this->validate($request, $rules);
    }
}

