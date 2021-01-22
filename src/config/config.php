<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Gateway Url
    |--------------------------------------------------------------------------
    |
    | This value is the Api Url of your Gateway.
    | This value is used when send message .
    |
    */
    'gatewayUrl' => 'https://www.domain.net',

    /*
    |--------------------------------------------------------------------------
    | request type
    |--------------------------------------------------------------------------
    |
    | This value is a request type .. request will be send with this type .
    |
    */
    'requestType' => 'GET',

    /*
    |--------------------------------------------------------------------------
    | Destination field
    |--------------------------------------------------------------------------
    |
    | This is the name of the parameter that represents the destination numbers .
    | ex: mobiles or numbers
    |
    */
    'destination' => 'numbers',

    /*
    |--------------------------------------------------------------------------
    | Message field
    |--------------------------------------------------------------------------
    |
    | This is the name of the parameter that represents the message .
    | ex: message or msg
    |
    */
    'message' => 'message',

    /*
    |--------------------------------------------------------------------------
    | parameters fields
    |--------------------------------------------------------------------------
    |
    | This is the Additional fields will be send with request .
    | ex: ['fieldKey' => 'fieldName']
    |
    */
    'parameters' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | headers fields
    |--------------------------------------------------------------------------
    |
    | This is the headers will be send with request .
    | ex: ['fieldKey' => 'fieldName']
    |
    */
    'headers' => [
        
    ],

    /*
    |--------------------------------------------------------------------------
    | SmsResponseInterface type
    |--------------------------------------------------------------------------
    |
    | This is response type of response will be returned from Api .
    | ex: string|json
    |
    */
    'responseType' => 'json',

    /*
    |--------------------------------------------------------------------------
    | success response
    |--------------------------------------------------------------------------
    |
    | This is success value from response will be used to return success send.
    | ex: 
    | if responseType is string: 'success'
    | 
    | if responseType is json: 'key:value' => key: this is the key inside the json
    | with doted notaition .. value: this is value meaning success
    |
    */
    'successResponse' => 'data.result.success:1',

    /*
    |--------------------------------------------------------------------------
    | Log
    |--------------------------------------------------------------------------
    |
    | This is enabled/disable log request and response  .
    | logPath: 'storage/logs/magic-sms'
    |
    */
    'log' => true,

];