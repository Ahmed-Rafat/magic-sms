<?php
namespace AR\MagicSms\Concrete;

use AR\MagicSms\Contracts\SmsResponseInterface;
use AR\MagicSms\Concrete\SmsLog;

class SmsResponse implements SmsResponseInterface {
    /**
     * Response Class 
     * @var
    */
    protected $response;

    /**
     * Log Content 
     * @var mixed
    */
    protected $logContent;
    /**
     * Class Constructor
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Chceck if Message Send SuccessFul With diffrent response Type
     * 
     * @return bool
    */
    public function successful(): bool
    {
        $responseType = $this->responseConfigType();

        switch ($responseType) {
            case 'json':
                return $this->isSuccessResponseJson();
                break;
            case 'string':
                return $this->isSuccessResponseString();
                break;
            default:
                $this->logContent .= 'unKnown Request Type .. response type not supported please contact with the developer' . PHP_EOL;
                return false;
                break;
        }
    }

    /**
     * Chceck if Message Send failed 
     * 
     * @return bool
    */
    public function failed(): bool
    {
        return !$this->successful();
    }

    /**
     * Check response success value when type is Json
     * 
     * @return bool
    */
    private function isSuccessResponseJson(): bool {
        $successResponse = $this->responseSuccessConfigValue();

        $responseBody = $this->response->getBody();

        if($this->response->isJson()) {
            list($successKey, $successValue) = explode(':', $successResponse);

            $responseBody = json_decode($responseBody, true);

            $responseValue = doted($responseBody, $successKey);
            
            return $responseValue == $successValue;
        }

        $this->logContent .= 'Response is not as a json .. check your response or configration data' . PHP_EOL;

        return false;
    }

    /**
     * Check response success value when type is String
     * 
     * @return bool
    */
    private function isSuccessResponseString(): bool {
        $successResponse = $this->responseSuccessConfigValue();

        $responseBody = $this->response->getBody();

        if($this->response->isString()) {            
            return strpos($responseBody, $successResponse) !== false;
        }

        $this->logContent .= 'Response is not as a string .. check your response or configration data' . PHP_EOL;

        return false;
    }

    /**
     * return server Response
     *
     * @return mixed
     */
    public function getResponse() {
        return $this->response->getBody();
    }

    /**
     * Return response Type from Config
     * 
     * @return string
    */
    private function responseConfigType() {
        return config('magic-sms.responseType');
    }

    /**
     * Return success response Value from Config
     * 
     * @return string
    */
    private function responseSuccessConfigValue() {
        return config('magic-sms.successResponse');
    }

    /**
     * Class Destuctor
    */
    public function __destruct() {
        if(config('magic-sms.log')) {
            $this->logContent .= 'Headers Parameters: ' . PHP_EOL;

            $this->logContent .= json_encode($this->response->getHeaders()) . PHP_EOL;

            $this->logContent .= 'Request Parameters: ' . PHP_EOL;

            $this->logContent .= json_encode($this->response->getParameters()) . PHP_EOL;

            $this->logContent .= 'Response Content: ' . PHP_EOL;

            $this->logContent .= $this->response->getBody() . PHP_EOL;

            SmsLog::log($this->logContent);
        }
    }
}