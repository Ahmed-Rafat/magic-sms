<?php

use AR\MagicSms\MagicSms;

if( !function_exists('doted')) {
    /**
     * Return the value of a given key from array
     *
     * @param array $array
     * @param int|string|null $key
     * @param mixed $default
     * @return mixed
     */
    function doted($array, $key = null, $default = null)
    {
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }

            $array = &$array[$segment];
        }

        return $array;
    }
}

if( !function_exists('magicSendSms')) {
    /**
     * Helper function using to send sms message
     *
     * @param string $destination
     * @param string $message
     * @return SmsResponse
     */
    function magicSendSms($destination, $message)
    {
        $sms = (new MagicSms)->send($destination, $message);

        return $sms->successful();
    }
}