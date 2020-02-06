<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\Business\AdminBusinessService;

class AdminController extends Controller
{
    public function onUsersPull(Request $request)
    {
        if($SESSION['role'] == "admin")
        {
            $adminBusiness = new AdminBusinessService();
            $userPull = $adminBusiness->populate();
        }
    }
    
    public function onEdit(Request $request)
    {
        $adminBusiness = new AdminBusinessService();
        $userPull = $adminBusiness->modify($user);
    }
    
    public function onRemoval(Request $request)
    {
        $adminBusiness = new AdminBusinessService();
        $userRemove = $adminBusiness->remove($user);
    }
    
    public function onSuspension(Request $request)
    {
        $adminBusiness = new AdminBusinessService();
        $userSuspend = $adminBusiness->suspend($user);
    }
}
