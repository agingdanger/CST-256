<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Model\DTO;
use App\Services\Business\AdminBusinessService;
use App\Services\Business\JobBusinessService;
use App\Services\Utility\MyLogger2;

class JobsRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try
        {
            //Call Service to get all jobs
            $service = new AdminBusinessService();
            $jobs = $service->populateJobs();
            
            //Create a DTO
            $dto = new DTO(0, "OK", $jobs);
            
            //Serialize the DTO to JSON
            $json = json_encode($dto);
            
            //Return JSON back to caller
            return $json;
        }
        catch(Exception $e1)
        {
            MyLogger2::error("Exception ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function show($search)
    {
        try
        {
            $service = new JobBusinessService();
            $jobs = $service->searchJobs($search);
            
            if($jobs == null)
                $dto = new DTO(-1, "Jobs weren't found", "");
                else
                    $dto = new DTO(0, "OK", $jobs);
                    
                    //Serialize DTO to JSON
                    $json = json_encode($dto);
                    
                    //return JSON back to caller
                    return $json;
        }
        catch(Exception $e1)
        {
            MyLogger2::error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

}
