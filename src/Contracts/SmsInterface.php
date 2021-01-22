<?php
namespace AR\MagicSms\Contracts;

/**
 * Interface SmsInterface
 * @package AR\MagicSms\Contracts
 */
interface SmsInterface
{
    public function send($destination, $message);
}