<?php

namespace App\Http\Middleware;

use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Session;
use Closure;

class MySecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Step 1: You can use the following to get the route URI $request->path()
        // or you can also use the $request->is()
        $path = $request->path();
        MyLogger2::info("Entering My Security Middlware in handle() at path: " . $path);
        
        // Step 2: Run the business rules that check for all URI's that you do not need to secure
        $secureCheck = true;
        if($request->is('/') || 
            $request->is('welcome') || 
            $request->is('login') || 
            $request->is('registration') ||
            $request->is('register') || 
            $request->is('registerstatus') || 
            Session::get('principal') == true)
        {
            $secureCheck = false;
        }
        MyLogger2::info($secureCheck ? "Security Middleware in handle() ..... Needs Security" : "Security Middleware in handle() .... No Security Required");
        
        // Step 3: If entering a secure URI with not security token then do a redirect to the root URI or Login page
        // (note: $enable variable is to easily disable security)
        // NOTE: if you get here with secureCheck true then you are requesting a page that needs to be secured.
        // NOTE: You will need to add additional logic to actually determine if the user if authenticated or authorized
        // to access the requested page.
        // NOTE: You would no typically need an enable flag. I have this so this middleware does not interfere with my previous activities.
        // NOTE: To test this, try to go to the /askme route or one of your other loginX routes.
        // You will be redirected by to a login route.
        
        //         $enable = true;
        if($secureCheck)
        {
            MyLogger2::info("Leaving My Security Middlware in handle() doing a redirect back to login");
            return redirect('/welcome');
        }
        
        // Proceed as noremal to next Middleware in the chain
        return $next($request);
    }
}
