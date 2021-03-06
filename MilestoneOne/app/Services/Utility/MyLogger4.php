<?php

namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class MyLogger4 implements ILogger
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
        }
        return self::$logger;
    }
    
    /* static function getLogger()
    {
        if (self::$logger == null)
        {
            self::$logger = new Logger('playlaravel');
            self::$logger->pushHandler(new LogglyHandler('932853ca-d111-48b1-a9ff-3bd82a217a14/tag/cst323_logfile_heroku_upload_php', Logger::DEBUG));
        }
        return self::$logger;
    } */
    
    // 932853ca-d111-48b1-a9ff-3bd82a217a14
    
    public function debug($message, $data=array())
    {
        self::getLogger()->debug($message, $data);
    }
    
    public function info($message, $data=array())
    {
        self::getLogger()->info($message, $data);
    }
    
    public function warning($message, $data=array())
    {
        self::getLogger()->warning($message, $data);
    }
    
    public function error($message, $data=array())
    {
        self::getLogger()->error($message, $data);
    }
}