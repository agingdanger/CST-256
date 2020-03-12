<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\Business\InterestGroupBusinessService;
use App\Model\InterestGroup;
use App\Model\Job;
use App\Services\Business\PortfolioBusinessService;

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
        /* try
        { */
            // Call the private function to store request variables into an object: 
            $interestGroup = $this->storePostVariablesIntoObject($request);

            // Send the object to Business Service to Add a new InterestGroup:
            $service = new InterestGroupBusinessService();
            $result = $service->addition($interestGroup);

            if ($result)
            {
                // Call the Business Service and return the List of all InterestGroups
                $interestGroupList = $service->gatherGroupList();
                
                // Return the View with the result data
                return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
            }
            else
            {
                // return the view with a message:
                $message = "Please try again.";
                return view('error.commonError')->with($message);
            }
        /* }
        catch (ValidationException $el)
        {
            throw $el;
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        } */
    }

    // Create onInterestGroupEdit
    public function onEditInterestGroup(Request $request)
    {
        // Call the Validation Rules:
        // $this->validateJobForm($request);
        /* try
        { */
            // Call the private method to store request data into an object:
            $interestGroup = $this->storePostVariablesIntoObject($request);

            // Send it to Business Service to Edit the Job:
            $service = new InterestGroupBusinessService();
            $result = $service->modify($interestGroup);

            // Check if result's true
            if ($result)
            {
                // Call the Business Service and return the List of all InterestGroups
                $interestGroupList = $service->gatherGroupList();
                
                // Return the View with the result data
                return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
            }
            else
            {
                // If result's false,
                $message = "Please try again.";
                return view('error.commonError')->with($message);
            }
        /* }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        } */
    }

    // Create onInterestGroupDeletion
    public function onDelete(Request $request) 
    {
        try
        {
            // Store the information from hidden values into a Interest Group object:
            $id = $request->input('id');
            
            // Send it to Business Service to Delete the Interest Group:
            $service = new InterestGroupBusinessService();
            $result = $service->remove($id);
                        
            // Check if result holds any value
            if ($result)
            {
                // Call the Business Service and return the List of all InterestGroups
                $interestGroupList = $service->gatherGroupList();
                
                // Return the View with the result data
                return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
            }
            else
            {
                // If result's false,
                $message = "Please try again.";
                return view('error.commonError')->with($message);
            }
        }
        catch (Exception $e)
        {
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }
    
    // Create a validation rules-
    private function storePostVariablesIntoObject(Request $request)
    {
        // Store all the Requested info into Variables:
        $id = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $users_id = $request->input('users_id');

        // Create an InterestGroup object:
        $interestGroup = new InterestGroup($id, $name, $description, $tags, $users_id);

        // Return the interest group object.
        return $interestGroup;
    }
    
}
