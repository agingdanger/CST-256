<?php

namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MyLogger2 implements ILogger
{
    private static $logger = null;
    
    private static function getLogger()
    {
        if(self::$logger == null)
        {
            self::$logger = new Logger('MyApp');
            $stream = new StreamHandler('storage/logs/myapp.log', Logger::DEBUG);
            $stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% %context%\n", "g:iA n/j/Y"));
            self::$logger->pushHandler($stream);
            
            Log::info("Just finished executing the code with new Logger and new StreamHandler. Also, used pushHandler(stream).");
        }
        return self::$logger;
    }

    public static function info($message, $data=array())
    {
        Log::info("Inside the info static function of MyLogger2");
        self::getLogger()->info($message, $data);
    }

    public static function warning($message, $data=array())
    {
        Log::info("Inside the warning static function of MyLogger2");
        self::getLogger()->warning($message, $data=array());
    }

    public static function error($message, $data=array())
    {
        Log::info("Inside the error static function of MyLogger2");
        self::getLogger()->error($message, $data);
    }

    public static function debug($message, $data=array())
    {
        Log::info("Inside the debug static function of MyLogger2");
        self::getLogger()->debug($message, $data);
    }

}