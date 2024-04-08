# Configuration

Please follow this steps and you are live with in a mere seconds.

## General Configuration

1. On notification classes add SMS channel on the like this.
    ```php
    public function via(object $notifiable): array
    {
        return ['sms', '...other channel'];
    }
    ```
2. On the `.env` file please add this configuration.
    ```shell
    SMS_LOG=false
    SMS_DRIVER="twilio"
    SMS_ACCOUNT_MODE="sandbox"
    SMS_FROM_NAME="${APP_NAME}"
    ```

## Driver Configuration

Depending on driver option you choose, add these API credentials
after existing general configuration variables.

| Driver           | Credentials                                                             |     Configured     | Tested |
|------------------|-------------------------------------------------------------------------|:------------------:|:------:|
| `africastalking` | `SMS_AFRICA_TALKING_API_KEY=null`<br>`SMS_AFRICA_TALKING_USERNAME=null` | :white_check_mark: |  :x:   |
| `clickatell`     | `SMS_CLICKATELL_API_KEY=null`                                           | :white_check_mark: |  :x:   |
| `clicksend`      | `SMS_CLICKSEND_USERNAME=null`<br>`SMS_CLICKSEND_PASSWORD=null`          | :white_check_mark: |  :x:   |
| `infobip`        | `SMS_INFOBIP_API_TOKEN=null`                                            | :white_check_mark: |  :x:   |
| `messagebird`    | `SMS_MESSAGE_BIRD_ACCESS_KEY=null`                                      | :white_check_mark: |  :x:   |
| `smsbroadcast`   | `SMS_SMSBROADCAST_USERNAME=null`<br>`SMS_SMSBROADCAST_PASSWORD=null`    | :white_check_mark: |  :x:   |
| `telnyx`         | `SMS_TELNYX_API_TOKEN=null`                                             | :white_check_mark: |  :x:   |
| `twilio`         | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`                | :white_check_mark: |  :x:   |

## Notification Class

On the notification class the `via()` method will look like this
after adding the sms channel

```php
public function via(object $notifiable): array
{
    return ['sms', '...other'];
}
```

OR

```php
use Laraflow\Sms\SmsChannel;

public function via(object $notifiable): array
{
    return [SmsChannel::class, '...other'];
}
```

And the message prepare method should be named `toSms` and
return type is `SmsMessage` class instance.
Such example is given below.

```php
use Laraflow\Sms\SmsMessage;

public function toSms(object $notifiable): SmsMessage
{
    return (new SmsMessage)
        ->to('88012345678910')
        ->message('Hello from Laraflow SMS')
        ->vendor('telnyx') //Optional, will overwrite config file
        ->from('Laraflow'); //Optional, will overwrite config file
}
```
