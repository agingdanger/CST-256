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
    
    
    public function onViewEditInterestGroup(Request $request)
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
