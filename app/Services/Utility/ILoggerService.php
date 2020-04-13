<?php
namespace App\Services\Utility;

/**
 *
 * @author mrabi
 *        
 */
interface ILoggerService
{ 
    public function debug($message, $data=array());    
    public function info($message, $data=array());    
    public function warning($message, $data=array());
    public function error($message, $data=array());
}

