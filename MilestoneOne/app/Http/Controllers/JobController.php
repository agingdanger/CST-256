<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Services\Business\JobBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use Illuminate\Validation\ValidationException;
use App\Model\Job;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{
    
    /**
     * Search the job by taking in the user's input text
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|view('jobSearchResult')
     */
    public function onSearchJobs(Request $request)
    {
        MyLogger2::info("Entering JobController's onSearchJobs()");
        
        try
        {
            // Call the validation rule: 
            $this->validateJobSearch($request);
            
            // Put search info into variable
            $search = $request->input('search');
            
            // Call the Session ID
            $id = Session::get('userID');
            
            // Call the User Business Service to search jobs:
            $jobBusiness = new JobBusinessService();
            $searchData = $jobBusiness->searchJobs($search);
            
            // retrieve the auto matched data to the user's profile skills
            $matchData = $jobBusiness->matchJobs($id);
            
            if ($searchData || $matchData)
            {
                MyLogger2::info("Exiting JobController's onSearchJobs() successfully.");
                
                return view('job.jobSearchResult')->with('searchData', $searchData)->with('matchData', $matchData);
            }
            else
            {
                MyLogger2::info("Exiting JobController's onSearchJobs() failed.");
                
                return view('error.commonError');
            }
        }
        catch (ValidationException $valExc)
        {
            MyLogger2::error("Validation Error in JobController's onSearchJobs()");
            
//             throw new $valExc->getMessage();
            return Redirect::to('viewJobs');
        }
        catch (Exception $e)
        {
            MyLogger2::error("Error in JobController's onSearchJobs()");
            
            throw new $e->getMessage();
        }
    }

    /**
     * Return the Job Info Page by passing in the Job's info through the button.
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewJobInfo(Request $request)
    {
        MyLogger2::info("Entering in JobController's onViewJobInfo()");
        
        try 
        {
            // Take the request info and put them in variables:
            $id = $request->input('id');
            $name = $request->input('job');
            $description = $request->input('description');
            $company = $request->input('company');
            $requirements = $request->input('requirements');
            $skills = $request->input('skills');
            
            // Create a job object:
            $job = new Job($id, $name, $description, $company, $requirements, $skills);
            
            MyLogger2::info("Exiting in JobController's onViewJobInfo()");
            
            return view('job.jobInfo')->with('job', $job);
        } 
        catch (Exception $e)
        {
            MyLogger2::error("Error in JobController's onViewJobInfo()");
            
            throw new $e->getMessage();
        }
    }

    /**
     * Create validation rules for job search.
     * 
     * @param Request $request
     */
    private function validateJobSearch(Request $request)
    {
        MyLogger2::info("Entering in JobController's validateJobSearch()");
        
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules

        // Setup Data Validation Rules for Search Form.
        $rules = [
            'search' => 'Required'
        ];

        // Run Validation Rules:
        $this->validate($request, $rules);
        
        MyLogger2::info("Exiting in JobController's validateJobSearch()");
    }
}
