<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Model\JobHistory;
use App\Model\Education;
use App\Model\Skill;
use App\Services\Business\PortfolioBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use Dotenv\Exception\ValidationException;

class PortfolioController extends Controller
{

    /**
     * Add Job History to a User's portfolio:
     *
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onAddWorkExperience(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onAddWorkExperience()");

        // Call the Validation Rules:
        $this->validateJobHistoryForm($request);

        try
        {
            // Store the Request info into variables:
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

            // Call the Business Service to add Job History:
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->postJobExperience($job);

            // Store into jobs all the Job History of a User
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);

            // Store into skills all the skill history of the user
            $skills = $portfolioBusiness->retrieveUserSkills($userID);

            // Store into education all the education history of the user.
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onAddWorkExperience()");

            // Return portfolio view with all the updated number of job history, education history, and skill history.
            return view('portfolio.portfolio')->with('jobs', $jobs)
                ->with('skills', $skills)
                ->with('education', $education);
        }
        catch (ValidationException $valExc)
        {
            MyLogger2::error("Validation Error in PortfolioController's onAddWorkExperience()", $valExc->getMessage());

            // throw Valexc
            throw $valExc;
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onAddWorkExperience()", $e->getMessage());

            // throw
            return view('error.commonError');
        }
    }

    /**
     * Add Skills to the Portfolio
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onAddSkill(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onAddSkill()");

        // Call the Validation Rule:
        $this->validateSkillForm($request);

        try
        {
            // Store Request info into variables:
            $id = "";
            $skillName = $request->input('skillname');
            $userID = $request->input('userid');

            // Create a skill object to be added
            $skill = new Skill($id, $skillName, $userID);

            // Call the Business Service to Post Skills Experience, retrieve UserJobHistory, UserSkills, UserEducation.
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->postSkillExperience($skill);
            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            // Check the portfolio status.
            if ($portfolioStatus)
            {
                MyLogger2::info("Exiting PortfolioController's onAddSkill()");

                return view('portfolio.portfolio')->with('jobs', $jobs)
                    ->with('skills', $skills)
                    ->with('education', $education);
            }
            else
            {
                MyLogger2::info("Exiting PortfolioController's onAddSkill() failed.");

                return view('error.error');
            }
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onAddSkill()", $e->getMessage());

            return view('error.commonError');
        }
    }

    /**
     * Add Education History to the Portfolio
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onAddEducation(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onAddEducation()");

        // Call the Validation Form:
        $this->validateEducationForm($request);

        try
        {
            // Store Request info into variables:
            $id = "";
            $edName = $request->input('edname');
            $edYears = $request->input('edyears');
            $edMajor = $request->input('edmajor');
            $edMinor = $request->input('edminor');
            $edStartYear = $request->input('edstartyear');
            $edEndYear = $request->input('edendyear');
            $userID = $request->input('userid');

            // Create an education object to be added
            $ed = new Education($id, $edName, $edYears, $edMajor, $edMinor, $edStartYear, $edEndYear, $userID);

            // Call the Business Service to post Education History of User:
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->postEducationExperience($ed);

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            if ($portfolioStatus)
            {
                MyLogger2::info("Exiting PortfolioController's onAddEducation() successfully");

                return view('portfolio.portfolio')->with('jobs', $jobs)
                    ->with('skills', $skills)
                    ->with('education', $education);
            }
            else
            {
                MyLogger2::info("Exiting PortfolioController's onAddEducation() failed.");

                return view('error.error');
            }
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exiting PortfolioController's onAddEducation()", $e->getMessage());

            return view('error.commonError');
        }
    }

    /**
     * Delete a Job History from the Portfolio
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onJobRemoval(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onJobRemoval()");

        try
        {
            $userID = Session::get("userID");
            // Store Request info into variables:
            $id = $request->input('jobid');

            $portfolioBusiness = new PortfolioBusinessService();

            $portfolioStatus = $portfolioBusiness->removeUserJob($id);

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onJobRemoval()");

            // Return the Portfolio View page:
            return view('portfolio.portfolio')->with('jobs', $jobs)
                ->with('skills', $skills)
                ->with('education', $education);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onJobRemoval()", $e->getMessage());

            return view('error.commonError');
        }
    }

    /**
     * Delete Education History on the Portfolio
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onEducationRemoval(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onEducationRemoval()");

        try
        {
            $userID = Session::get("userID");
            // Store Request info into variables:
            $id = $request->input('edid');

            $portfolioBusiness = new PortfolioBusinessService();

            $portfolioStatus = $portfolioBusiness->removeUserEducation($id);

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onEducationRemoval()");

            // Return the Portfolio view page:
            return view('portfolio.portfolio')->with('jobs', $jobs)
                ->with('skills', $skills)
                ->with('education', $education);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onEducationRemoval()", $e->getMessage());

            return view('error.commonError');
        }
    }

    /**
     * Delete skill on History on the Portfolio
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onSkillRemoval(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onSkillRemoval()");

        try
        {
            $userID = Session::get("userID");
            // Store Request info into variables:
            $id = $request->input('skillid');

            // Call the Business Service to Remove User's Skill
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->removeUserSkill($id);

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting in PortfolioController's onSkillRemoval()");

            // Return the Portfolio View Page:
            return view('portfolio.portfolio')->with('jobs', $jobs)
                ->with('skills', $skills)
                ->with('education', $education);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onSkillRemoval()", $e->getMessage());

            return view('error.commonError');
        }
    }

    /**
     * Display the Portfolio page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onPersonalPortfolioRetrieval(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onPersonalPortfolioRetrieval()");

//         try
//         {
            $userID = Session::get('userID');

            $portfolioBusiness = new PortfolioBusinessService();

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onPersonalPortfolioRetrieval()");

            // Return Portfolio view:
            return view('portfolio.portfolio')->with('jobs', $jobs)
                ->with('skills', $skills)
                ->with('education', $education);
        //}
        //catch (Exception $e)
        //{
            //MyLogger2::error("Error in PortfolioController's onPersonalPortfolioRetrieval()", $e->getMessage());

        //   return view('error.commonError');
        //}
    }

    /**
     * Display the EditJobHistory Form by passing the Job's info to the Form.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onRouteJobEdit(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onRouteJobEdit()");

        try
        {
            // Store Request info into variables:
            $id = $request->input('jobid');
            $name = $request->input('jobname');
            $position = $request->input('jobposition');
            $description = $request->input('jobdescription');
            $awards = $request->input('jobawards');
            $startDate = $request->input('jobstartdate');
            $endDate = $request->input('jobenddate');
            $userID = Session::get('userID');

            // Create a JobHistory Object
            $job = new JobHistory($id, $name, $position, $description, $awards, $startDate, $endDate, $userID);

            MyLogger2::info("Exiting PortfolioController's onRouteJobEdit()");

            // Return the EditJobHistory View
            return view('portfolio.editJobHistory')->with('job', $job);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exiting PortfolioController's onRouteJobEdit()", $e->getMessage());

            return view('error.commonError');
        }
    }

    /**
     * Display the EditEducationForm by passing in user's Education's info into the form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onRouteEducationEdit(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onRouteEducationEdit()");

        try
        {
            // Store Request info into variables:
            $id = $request->input('edid');
            $name = $request->input('edname');
            $years = $request->input('edyears');
            $major = $request->input('edmajor');
            $minor = $request->input('edminor');
            $startYear = $request->input('edstartyear');
            $endYear = $request->input('edendyear');
            $userID = Session::get('userID');

            // Create an Education Object:
            $ed = new Education($id, $name, $years, $major, $minor, $startYear, $endYear, $userID);

            MyLogger2::info("Exiting PortfolioController's onRouteEducationEdit()");

            // Return EditEducationForm view
            return view('portfolio.editEducation')->with('ed', $ed);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onRouteEducationEdit()", $e->getMessage());
            
            return view('error.commonError');
        }
    }

    /**
     * Display the EditSkillForm by passing in the user's Skill info into the form.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onRouteSkillEdit(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onRouteSkillEdit()");
        
        try
        {
            // Store Request info into variables:
            $id = $request->input('skillid');
            $skillName = $request->input('skillname');
            $userID = $request->input('userid');

            // Create a skill object to be added
            $skill = new Skill($id, $skillName, $userID);

            MyLogger2::info("Exiting PortfolioController's onRouteSkillEdit()");
            
            // Returns the EditSkillForm view
            return view('portfolio.editSkill')->with('skill', $skill);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Entered PortfolioController's onRouteSkillEdit()", $e->getMessage());
            
            return view('error.commonError');
        }
    }

    /**
     * Edit the JobHistory info after clicking in "Edit" button in the EditJobHistory form.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onJobEdit(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onJobEdit()");
        // Call the Validation Rules:
        // $this->validateJobHistoryForm($request);
        try
        {
            // Store Request info into variables:
            $id = $request->input('jobid');
            $name = $request->input('jobname');
            $position = $request->input('jobposition');
            $description = $request->input('jobdescription');
            $awards = $request->input('jobawards');
            $startDate = $request->input('jobstartdate');
            $endDate = $request->input('jobenddate');
            $userID = Session::get('userID');

            // Create a JobHistory Object:
            $job = new JobHistory($id, $name, $position, $description, $awards, $startDate, $endDate, $userID);

            // Call the Business Service to Modify JobHistory of a User:
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->modifyJobHistory($job);

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onJobEdit()");
            
            // Check if the PortfolioStatus is available:
            if ($portfolioStatus)
                return view('portfolio.portfolio')->with('jobs', $jobs)
                    ->with('skills', $skills)
                    ->with('education', $education);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Entered PortfolioController's onJobEdit()", array("message" => $e->getMessage()));
            
            return view('error.commonError');
        }
    }

    /**
     * Edit the EducationHistory after clicking on the "Edit" in the Edit form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onEducationEdit(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onEducationEdit()");
        
        // Call the Validation Rule:
        // $this->validateEducationForm($request);
        try
        {
            // Store Request info into variables:
            $id = $request->input('edid');
            $name = $request->input('edname');
            $years = $request->input('edyears');
            $major = $request->input('edmajor');
            $minor = $request->input('edminor');
            $startYear = $request->input('edstartyear');
            $endYear = $request->input('edendyear');
            $userID = Session::get('userID');

            // Create an Education Object:
            $ed = new Education($id, $name, $years, $major, $minor, $startYear, $endYear, $userID);

            // Call the PortfolioBusinessService to update EducationHistory:
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->modifyEducationHistory($ed);

            // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onEducationEdit()");
            
            // Check if PortfolioStatus
            if ($portfolioStatus)
                return view('portfolio.portfolio')->with('jobs', $jobs)
                    ->with('skills', $skills)
                    ->with('education', $education);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in PortfolioController's onEducationEdit()", array("message" => $e->getMessage()));
            
            return view('error.commonError');
        }
    }

    /**
     * Edit the SkillHistory after clicking on the "Edit" in the Edit form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onSkillEdit(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's onSkillEdit()");
        
        // Call the Validation Rule:
        // $this->validateSkillForm($request);
        try
        {
            // Store Request info into variables:
            $id = $request->input('skillid');
            $name = $request->input('skillname');
            $userID = Session::get('userID');

            // Create a skill object:
            $skill = new Skill($id, $name, $userID);

            // Call the BusinessService to update SkillHistory of the User:
            $portfolioBusiness = new PortfolioBusinessService();
            $portfolioStatus = $portfolioBusiness->modifySkillHistory($skill);

            // // Retrieve the User's Portfolio items:
            $jobs = $portfolioBusiness->retrieveUserJobs($userID);
            $skills = $portfolioBusiness->retrieveUserSkills($userID);
            $education = $portfolioBusiness->retrieveUserEducation($userID);

            MyLogger2::info("Exiting PortfolioController's onSkillEdit()");
            
            // Check PortfolioStatus:
            if ($portfolioStatus)
                return view('portfolio.portfolio')->with('jobs', $jobs)
                    ->with('skills', $skills)
                    ->with('education', $education);
        }
        catch (Exception $e)
        {
            MyLogger2::error("Exiting PortfolioController's onSkillEdit()", array("message" => $e->getMessage()));
            
            return view('error.commonError');
        }
    }

    /**
     * Validation Rules for JobHistory Forms:
     *
     * @param Request $request
     */
    private function validateJobHistoryForm(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's validateJobHistoryForm()");
        
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
        
        MyLogger2::info("Exiting PortfolioController's validateJobHistoryForm()");
    }

    /**
     * Validate function for EducationForms
     *
     * @param Request $request
     */
    private function validateEducationForm(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's validateEducationForm()");
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules

        // Setup Data Validation Rules for Login Form.
        $rules = [
            'edname' => 'Required | Between: 3, 50 | Alpha',
            'edyears' => 'Required | Numeric | Between: 1, 80',
            'edmajor' => 'Required | Between: 3, 50',
            'edminor' => 'Required | Between: 3, 50',
            'edstartyear' => 'Required | Digits: 4',
            'edendyear' => 'Required | Digits: 4'
        ];

        // Run Validation Rules:
        $this->validate($request, $rules);
        
        MyLogger2::info("Exiting PortfolioController's validateEducationForm()");
    }

    /**
     * Validate functions for Skill forms.
     *
     * @param Request $request
     */
    private function validateSkillForm(Request $request)
    {
        MyLogger2::info("Entered PortfolioController's validateSkillForm()");
        
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules

        // Setup Data Validation Rules for Login Form.
        $rules = [
            'skillname' => 'Required | Between: 4, 150'
        ];

        // Run Validation Rules:
        $this->validate($request, $rules);
        
        MyLogger2::info("Exiting PortfolioController's validateSkillForm()");
    }
}

