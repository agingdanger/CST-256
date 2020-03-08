<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\Business\InterestGroupBusinessService;
use App\Model\InterestGroup;

class InterestGroupController extends Controller
{
    
    /**
     * Return the view InterestGroupList with the result data
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewInterestGroups()
    {
        try
        {
            // Call the Business Service and return the List of all InterestGroups
            $service = new InterestGroupBusinessService();
            $interestGroupList = $service->gatherGroupList();

            // Return the View with the result data
            return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }
    
    /**
     * Call to view the Edit Form for the InterestGroup.
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewEditGroupForm(Request $request)
    {
        try
        {
            // Store all the hidden data using request into method variables: 
            $id = $request->input('id');
            $name = $request->input('name');
            $description = $request->input('description');
            $tags = $request->input('tags');
            
            // Create an InterestGroup Object: 
            $interestGroup = new InterestGroup($id, $name, $description, $tags);
            
            // Return the view by passing the interestGroup object. 
            return view('interestGroup.editInterestGroupForm')->with('intGroup', $interestGroup);
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }
    
    /**
     * Add an Interest Group to the List. 
     * 
     * @param Request $request
     * @throws ValidationException
     */
    public function onInterestGroupAddition(Request $request) 
    {
        // Call the Validation Rules:
        
        
        try
        {
            // Store all the Requested info into Variables:
            $id = $request->input('id');
            $name = $request->input('name');
            $description = $request->input('description');
            $tags = $request->input('tags');
            
            // Create an InterestGroup object: 
            $interestGroup = new InterestGroup($id, $name, $description, $tags);
            
            // Send the object to Business Service to Add a new InterestGroup:
            $service = new InterestGroupBusinessService();
            $result = $service->interestGroupAddition($interestGroup);
            
            // Call the private function to populate the data into the List of Groups view page.
            $this->populateData($service, $result);
        }
        catch (ValidationException $el)
        {
            throw $el;
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }
    
    // Create onInterestGroupEdit
    public function onEditInterestGroup(Request $request)
    {
        // Call the Validation Rules:
        //         $this->validateJobForm($request);
        
        try
        {
            // Store the hidden values from request into member variablest:
            $jobId = $request->input('jobid');
            
            
            // Create a Job Object:
            $job = new Job($jobId, $jobName, $jobDesc, $jobComp, $jobRequire, $jobSkills);
            
            // Send it to Business Service to Edit the Job:
            $service = new AdminBusinessService();
            $result = $service->jobModify($job);
            
            $jobsData = $service->populateJobs();
            
            // Check if Result is true:
            if ($result)
            {
                return view('job.jobs')->with('jobs', $jobsData);
            }
            else
            {
                $message = "Please check the information again.";
                return view('job.jobs')->with('message', $message);
            }
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }
    
    // Create onInterestGroupDeletion
    
    // Create a validation rules-
    
    /**
     * Return the view "interestGroupList" with the data collected from Services.
     * 
     * @param $service
     * @param $result
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    private function populateData($service, $result) 
    {
        $interestGroupData = $service->gatherGroupList();
        
        // Check if the result was true
        if ($result)
        {
            // Return the View with the result data
            return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupData);
        }
        else
            return view('common.error');
    }
}
