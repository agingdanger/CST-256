<?php
namespace App\Http\Controllers;

use App\Model\DTO;
use App\Services\Business\UserBusinessService;
use App\Services\Utility\MyLogger2;
use Exception;

class UsersRestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        MyLogger2::info("Enter UsersRestController.index()");
        // ---------------------- NOTE: This method has code copied and pasted. Needs update!

        // 
        try
        {
            // Call Service to get all users
            $service = new UserBusinessService();
            $users = $service->getAllUsers();

            // Create a DTO
            $dto = new DTO(0, "OK", $users);

            // Serialize the DTO to JSON
            $json = json_encode($dto);

            MyLogger2::info("Exit UsersRestController.index()");
            
            // Return JSON back to caller
            return $json;
        }
        catch (Exception $e1)
        {
            // Log exception
            MyLogger2::error("Exception: ", array(
                "message" => $e1->getMessage()
            ));

            // Return an error back to the user in the DTO
            $dto = new DTO(- 2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        MyLogger2::info("Enter UsersRestController.show()");
        // ---------------------- NOTE: This method has code copied and pasted. Needs update!
        
        //
        try
        {
            // Call Service to get a user
            $service = new UserBusinessService();
            $user = $service->getUserByID($id);

            // Create a DTO
            if ($user == null)
                $dto = new DTO(- 1, "User Not Found", "");
            else
                $dto = new DTO(0, "OK", $user);

            // Serialize DTO to JSON
            $json = json_encode($dto);

            MyLogger2::info("Exit UsersRestController.show()");
            
            // Return JSON back to caller
            return $json;
        }
        catch (Exception $e1)
        {
            // Log exception
            MyLogger2::error("Exception: ", array(
                "message" => $e1->getMessage()
            ));

            // Return an error back to the user in the DTO
            $dto = new DTO(- 2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
}
