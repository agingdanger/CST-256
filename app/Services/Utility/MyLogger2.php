<?php

namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;

class MyLogger2 implements ILogger
{
    private static $logger = null;
    
    public static function getLogger()
    {
        if (self::$logger == null)
        {
            self::$logger = new Logger('playlaravel'); 
            self::$logger->pushHandler(new LogglyHandler('932853ca-d111-48b1-a9ff-3bd82a217a14/tag/cst323_logfile_heroku_milestone_php', Logger::DEBUG));
        }
        return self::$logger;
    }
    
    public static function debug($message, $data=array())
    {
        self::getLogger()->addDebug($message, $data);
    }
    
    public static function info($message, $data=array())
    {
        self::getLogger()->addInfo($message, $data);
    }
    
    public static function warning($message, $data=array())
    {
        self::getLogger()->addWarning($message, $data);
    }
    
    public static function error($message, $data=array())
    {
        self::getLogger()->addError($message, $data);
    }
}