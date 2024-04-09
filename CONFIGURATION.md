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

### Global SMS API Providers

| Driver            | Credentials                                                             | Region |     Configured     | Tested |
|-------------------|-------------------------------------------------------------------------|:------:|:------------------:|:------:|
| `africastalking`  | `SMS_AFRICA_TALKING_API_KEY=null`<br>`SMS_AFRICA_TALKING_USERNAME=null` | GLOBAL | :white_check_mark: |  :x:   |
| `clickatell`      | `SMS_CLICKATELL_API_KEY=null`                                           | GLOBAL | :white_check_mark: |  :x:   |
| `clicksend`       | `SMS_CLICKSEND_USERNAME=null`<br>`SMS_CLICKSEND_PASSWORD=null`          | GLOBAL | :white_check_mark: |  :x:   |
| `infobip`         | `SMS_INFOBIP_API_TOKEN=null`                                            | GLOBAL | :white_check_mark: |  :x:   |
| `messagebird`     | `SMS_MESSAGE_BIRD_ACCESS_KEY=null`                                      | GLOBAL | :white_check_mark: |  :x:   |
| `smsbroadcast`    | `SMS_SMSBROADCAST_USERNAME=null`<br>`SMS_SMSBROADCAST_PASSWORD=null`    | GLOBAL | :white_check_mark: |  :x:   |
| `telnyx`          | `SMS_TELNYX_API_TOKEN=null`                                             | GLOBAL | :white_check_mark: |  :x:   |
| `twilio`          | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`                | GLOBAL | :white_check_mark: |  :x:   |
| `smsapi`          | `SMS_SMSAPI_API_TOKEN=null`                                             | GLOBAL | :white_check_mark: |  :x:   |


### Bangladesh only SMS API Providers

| Driver            | Credentials                                                     | Region |     Configured     | Tested |
|-------------------|-----------------------------------------------------------------|:------:|:------------------:|:------:|
| `adn`             | `SMS_ADN_API_KEY=null`<br>`SMS_ADN_API_SECRET=null`             |  BAN   | :white_check_mark: |  :x:   |
| `ajuratech`       | `SMS_AJURATECH_API_KEY=null`<br>`SMS_AJURATECH_SECRET_KEY=null` |  BAN   | :white_check_mark: |  :x:   |
| `alpha`           | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `banglalink`      | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `bdbulksms`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `boomcast`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `brilliant`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `bulksmsbd`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `customgateway`   | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `dianahost`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `dianasms`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `dnsbd`           | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `elitbuzz`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `esms`            | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `grameenphone`    | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `greenweb`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `lpeek`           | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `mdl`             | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `metronet`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `mimsms`          | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `mobireach`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `mobishasra`      | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `muthofun`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `novocombd`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `onnorokom`       | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `quicksms`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `redmoitsms`      | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `smartlabsms`     | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `sms4bd`          | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `smsnet24`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `smsnoc`          | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `smsinbd`         | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `smsnetbd`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `smsq`            | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `ssl`             | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `tense`           | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `trubosms`        | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `twentyfoursmsbd` | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `viatech`         | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |
| `twenty4bulksms`  | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`        |  BAN   |        :x:         |  :x:   |


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
