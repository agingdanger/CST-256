<?php
namespace App\Services\Data;

use Exception;
use PDOException;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;

class InterestGroupDataService
{

    // Declare a connection variable
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function findAllGroups()
    {
        try
        {
            // Run the Query to find all the Groups available from the Database
            $result = $this->conn->prepare("SELECT * FROM interest_group");
            // Execute the Query
            $result->execute();
            
            // return the result
            return $result->fetchAll();            
        }
        catch(PDOException $el)
        {
            Log::error("Exception in IntGroupDataService's findAllGroups(): ", array(
                "message" => $el->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $el->getMessage(), 0, $el);
        }
        catch (Exception $e)
        {
        }
    }
}