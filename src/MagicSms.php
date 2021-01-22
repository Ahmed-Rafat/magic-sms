<?php

namespace AR\MagicSms;

use AR\MagicSms\Concrete\Client;
use AR\MagicSms\Concrete\SmsResponse;
use AR\MagicSms\Contracts\SmsInterface;

/**
 * Class MagicSms
 * @package AR\MagicSms
 */
class MagicSms implements SmsInterface
{
    /**
     * @var
     */
    private $http;

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->http = new Client();
    }

    /**
     * Send Request to Sms Gateway with all data from config
     *
     * @param array|string $destination
     * @param string $message
     * @return SmsResponse
     */
    public function send($destination, $message)
    {
        $destinationKey = config('magic-sms.destination');

        $messageKey = config('magic-sms.message');

        // Main Parameter will be send with request ( numbers and message )
        $mainParameters = [
            $destinationKey => $destination,
            $messageKey => $message
        ];

        // Merge Main Parameters with additional Parameters
        $parameters = array_merge($mainParameters, config('magic-sms.parameters'));

        $response = $this->http
            ->setEndpoint(config('magic-sms.gatewayUrl'))
            ->setRequestType(config('magic-sms.requestType'))
            ->setParameters($parameters)
            ->setHeaders(config('magic-sms.headers'))
            ->send();

       return new SmsResponse($response);
    }
}
