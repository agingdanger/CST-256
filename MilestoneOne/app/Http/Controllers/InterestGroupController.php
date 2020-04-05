<?php
namespace App\Http\Controllers;

use App\Model\InterestGroup;
use App\Services\Business\InterestGroupBusinessService;
use App\Services\Utility\ILoggerService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class InterestGroupController extends Controller
{
    // Declare logger variable
    protected $logger;
    
    // Non-default Constructor
    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }
    
    /**
     * Return the view InterestGroupList with the result data
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewInterestGroups()
    {
        $this->logger->info("Entered InterestGroupController's onViewInterestGroups()");
        
        try
        {
            // Call the Business Service and return the List of all InterestGroups
            $service = new InterestGroupBusinessService();
            $interestGroupList = $service->gatherGroupList();

            $this->logger->info("Exiting InterestGroupController's onViewInterestGroups()");
            
            // Return the View with the result data
            return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in InterestGroupController's onViewInterestGroups()");
            
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Return the view InterestGroup with data
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onViewInterestGroup(Request $request)
    {
        $this->logger->info("Entering InterestGroupController's onViewInterestGroup()");
        
        try
        {
            $igid = $request->input('id');
            // Call the Business Service and return the List of all InterestGroups
            $service = new InterestGroupBusinessService();
            $interestGroup = $service->gatherGroup($igid);
            $users = $service->gatherUsers($igid);

            $this->logger->info("Exiting InterestGroupController's onViewInterestGroup()");
            
            // Return the View with the result data
            return view('interestGroup.viewInterestGroup')->with('intGroup', $interestGroup)->with('users', $users);
        }
        catch (Exception $e)
        {
            $this->logger->error("Errors in InterestGroupController's onViewInterestGroup()");
            
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
        $this->logger->info("Entering InterestGroupController's onViewEditGroupForm()");
        
        try
        {
            // Store all the hidden data using request into method variables:
            $id = $request->input('id');
            $name = $request->input('name');
            $description = $request->input('description');
            $tags = $request->input('tags');
            $userID = $request->input('users_ID');

            // Create an InterestGroup Object:
            $interestGroup = new InterestGroup($id, $name, $description, $tags, $userID);

            $this->logger->info("Exiting InterestGroupController's onViewEditGroupForm()");
            
            // Return the view by passing the interestGroup object.
            return view('interestGroup.editInterestGroupForm')->with('intGroup', $interestGroup);
        }
        catch (Exception $e)
        {
            $this->logger->error("Error in InterestGroupController's onViewEditGroupForm()");
            
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
        $this->logger->info("Entering InterestGroupController's onInterestGroupAddition()");
        
        // Call the Validation Rules:
        try
        {
            // Call the private function to store request variables into an object:
            $interestGroup = $this->storePostVariablesIntoObject($request);

            // Send the object to Business Service to Add a new InterestGroup:
            $service = new InterestGroupBusinessService();
            $result = $service->addition($interestGroup);

            if ($result)
            {
                // Call the Business Service and return the List of all InterestGroups
                $interestGroupList = $service->gatherGroupList();

                $this->logger->info("Exiting InterestGroupController's onInterestGroupAddition() successfully");
                
                // Return the View with the result data
                return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
            }
            else
            {
                $this->logger->info("Exiting InterestGroupController's onInterestGroupAddition() failed");
                
                // return the view with a message:
                $message = "Please try again.";
                return view('error.commonError')->with($message);
            }
        }
        catch (ValidationException $el)
        {
            $this->logger->error("Validation Error in InterestGroupController's onInterestGroupAddition()");
            
            throw $el;
        }
        catch (Exception $e)
        {
            $this->logger->error("Error in InterestGroupController's onInterestGroupAddition()");
            
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Post the changes made to the Interest Group by the Owner.
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onEditInterestGroup(Request $request)
    {
        $this->logger->info("Entering InterestGroupController's onEditInterestGroup()");
        
        // Call the Validation Rules:
        // $this->validateJobForm($request);
        try
        {
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

                $this->logger->info("Exiting InterestGroupController's onEditInterestGroup() successfully.");
                
                // Return the View with the result data
                return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
            }
            else
            {
                $this->logger->info("Exiting InterestGroupController's onEditInterestGroup() failed.");
                
                // If result's false,
                $message = "Please try again.";
                return view('error.commonError')->with($message);
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Error in InterestGroupController's onEditInterestGroup()");
            
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Delete the Interest Group along with the rows from the Bridging Table
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onDelete(Request $request)
    {
        $this->logger->info("Entering InterestGroupController's onDelete()");
        
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

                $this->logger->info("Exiting InterestGroupController's onDelete() successfully.");
                
                // Return the View with the result data
                return view('interestGroup.interestGroupList')->with('intGroups', $interestGroupList);
            }
            else
            {
                $this->logger->info("Exiting InterestGroupController's onDelete() failed.");
                
                // If result's false,
                $message = "Please try again.";
                return view('error.commonError')->with($message);
            }
        }
        catch (Exception $e)
        {
            $this->logger->error("Error in InterestGroupController's onDelete()");
            
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Return the view InterestGroup with data
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onJoinInterestGroup(Request $request)
    {
        $this->logger->info("Entering InterestGroupController's onJoinInterestGroup()");
        
        try
        {
            // Get the 'id' from the request data into a method variable
            $igid = $request->input('id');
            
            // Call the Business Service and return the List of all InterestGroups
            $service = new InterestGroupBusinessService();
            $interestGroup = $service->joinGroup($igid);

            // Call the Business Service to gather Groups and Users to pull latest Group changes. 
            $interestGroup = $service->gatherGroup($igid);
            $users = $service->gatherUsers($igid);

            $this->logger->info("Exiting InterestGroupController's onJoinInterestGroup() successfully");
            
            // Return the View with the result data
            return view('interestGroup.viewInterestGroup')->with('intGroup', $interestGroup)->with('users', $users);
        }
        catch (Exception $e)
        {
            $this->logger->error("Error in InterestGroupController's onJoinInterestGroup()");
            
            // Throwing Exception with message:
            throw $e->getMessage();
        }
    }

    /**
     * Return an object by storing in the $request's data 
     * 
     * @param Request $request
     * @return \App\Model\InterestGroup
     */
    private function storePostVariablesIntoObject(Request $request)
    {
        $this->logger->info("Entering InterestGroupController's storePostVariablesIntoObject()");
        
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
        
        $this->logger->info("Exiting InterestGroupController's storePostVariablesIntoObject()");
    }
}
