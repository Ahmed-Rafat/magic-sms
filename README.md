# Magic Sms
Magic SMS allows you to send SMS from your Laravel application with any sms gateway.

## Requirements
- Laravel `>=5.6`

## Installation

You can install the package via composer:

```bash
composer require ahmedrafat/magic-sms
```

## Publishing files
Run the following Command to create config ( config/magic-sms.php ) file. You can set your sms details in the config file.

```bash
php artisan vendor:publish --provider="AR\\MagicSms\\Providers\\MagicSmsServiceProvider"
```
## Usage

``` php
//using MagicSMS
use AR\MagicSms\MagicSms;

$sms = (new MagicSms)->send($destination, $message);
// You can check if send success via $sms->successful()
// Or can check if send failed via $sms->failed()
// or get the server response via $sms->getResponse()
```

### Using Helper function
``` php
$sendSms = magicSendSms($destination, $message); //returns true/false
```

[ Headers, Request, Response] will be logged in storage/logs/magic-sms\
note: you can enable/disable log from config file