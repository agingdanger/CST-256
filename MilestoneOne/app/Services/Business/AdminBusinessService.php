<?php
namespace App\Services\Business;

use Illuminate\Http\Request;
use App\Services\Data\AdminDataService;
use App\Model\User;

class AdminBusinessService
{
    
    public function populate()
    {
        $adminData = new AdminDataService();
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