<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Services\Business\JobBusinessService;
use Illuminate\Validation\ValidationException;
use App\Model\Job;

class JobController extends Controller
{

    public function onSearchJobs(Request $request)
    {
        $this->validateJobSearch($request);
        /* try
        { */
            
            
            // Put search info into variable
            $search = $request->input('search');
            
            $id = Session::get('userID');
            
            // Call the User Business Service to access the profile:
            $jobBusiness = new JobBusinessService();
            $searchData = $jobBusiness->searchJobs($search);
            
            // retrieve the auto matched data to the user's profile skills
            $matchData = $jobBusiness->matchJobs($id);
            
            if ($searchData || $matchData)
            {
                return view('job.jobSearchResult')->with('searchData', $searchData)->with('matchData', $matchData);
            }
            else
            {
                return view('error.commonError');
            }
        /* }
        catch (ValidationException $valExc)
        {
            throw new $valExc->getMessage();
        }
        catch (Exception $e)
        {
            throw new $e->getMessage();
        } */
    }

    public function onViewJobInfo(Request $request)
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
        
        return view('job.jobInfo')->with('job', $job);
    }

    private function validateJobSearch(Request $request)
    {
        // Best Practice: centralize your rules so you have a consistent architecture and even reuse your rules

        // Setup Data Validation Rules for Search Form.
        $rules = [
            'search' => 'Required | Between: 4, 10 | Alpha'
        ];

        // Run Validation Rules:
        $this->validate($request, $rules);
    }
}
