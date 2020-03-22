<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\JobBusinessService;

class JobController extends Controller
{
    
    public function onSearchJobs(Request $request)
    {
        //Put search info into variable
        $search = $request->input('search');
        
        $id = Session::get('userID');
        
        // Call the User Business Service to access the profile:
        $jobBusiness = new JobBusinessService();
        $searchData = $jobBusiness->searchJobs($search);
        
        //retrieve the auto matched data to the user's profile skills
        $matchData = $jobBusiness->matchJobs($id);
        
        if($searchData || $matchData)
        {
            return view('job.jobSearchResult')->with($searchData)->with($matchData);
        }
        else
        {
            return view('error.commonError');
        }
        
    }
    
}
