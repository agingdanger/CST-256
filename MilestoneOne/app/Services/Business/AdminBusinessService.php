<?php
namespace App\Services\Business;

use Illuminate\Http\Request;
use App\Services\Data\AdminDataService;
use App\Model\User;
use App\Services\Utility\db_connector;

class AdminBusinessService
{
    
    public function populate()
    {
        
        $db = new db_connector();
        $conn = $db->getConnection();
        $adminData = new AdminDataService($conn);
        
        $isRegistered = $adminData->findAll();
        
        if($isRegistered)
        {
            return true;
        }
            return false;
    }
    
    public function modify(User $user)
    {
        
    }
    
    public function suspend(User $user)
    {
        
    }
    
    public function remove(User $user)
    {
        
    }
}