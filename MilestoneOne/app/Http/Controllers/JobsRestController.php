<?php
namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\AdminBusinessService;
use App\Services\Business\JobBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use Exception;

class JobsRestController extends Controller
{
    // Declare logger variable
    protected $logger;

    // Non-default Constructor
    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->logger->info("Entering JobsRestController's index()");

        try
        {
            // Call Service to get all jobs
            $service = new AdminBusinessService();
            $jobs = $service->populateJobs();

            // Create a DTO
            $dto = new DTO(0, "OK", $jobs);

            // Serialize the DTO to JSON
            $json = json_encode($dto);

            $this->logger->info("Exiting JobsRestController's index()");

            // Return JSON back to caller
            return $json;
        }
        catch (Exception $e1)
        {
            $this->logger->error("Exception ", array(
                "message" => $e1->getMessage()
            ));

            $dto = new DTO(- 2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     *
     */
    public function show($search)
    {
        $this->logger->info("Entering JobsRestController's show()");

        try
        {
            $service = new JobBusinessService();
            $jobs = $service->searchJobs($search);

            if ($jobs == null)
                $dto = new DTO(- 1, "Jobs weren't found", "");
            else
                $dto = new DTO(0, "OK", $jobs);

            // Serialize DTO to JSON
            $json = json_encode($dto);

            $this->logger->info("Exiting JobsRestController's show()");

            // return JSON back to caller
            return $json;
        }
        catch (Exception $e1)
        {
            $this->logger->error("Exception: ", array(
                "message" => $e1->getMessage()
            ));

            $dto = new DTO(- 2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
}
