<?php
namespace AR\MagicSms\Concrete;

/**
 * Class SmsLog
 * @package AR\MagicSms\Concrete
 */
class SmsLog {
    /**
     * Directory Path
    */
    const LOG_DIR = 'storage/sms';

     /**
     * Get Log directory
     * 
     * @param  
     * @return string
     */
    public static function logDir()
    {
        if (!is_dir($directory = base_path(self::LOG_DIR))) {
            mkdir($directory, 0777, true);
        }

        return $directory;
    }

    /**
     * Log  output
     * 
     * @param mixed
     * @return void
     */
    public static function log($output)
    {
        $logDirectory = static::logDir();

        file_put_contents($logDirectory . '/' . date('d-m-Y H-i-s') . '.log', $output);
    }

}