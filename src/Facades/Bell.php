<?php

namespace Fintech\Bell\Facades;

use Fintech\Bell\Drivers\SmsDriver;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SmsDriver sms()
 * @method static \Fintech\Bell\Services\TriggerService trigger()
 * @method static \Fintech\Bell\Services\TriggerRecipientService triggerRecipient()
 * @method static \Fintech\Bell\Services\TriggerVariableService triggerVariable()
 * @method static \Fintech\Bell\Services\NotificationTemplateService notificationTemplate()
 * @method static \Fintech\Bell\Services\TriggerActionService triggerAction()
 * // Crud Service Method Point Do not Remove //
 *
 * @see \Fintech\Bell\Bell
 */
class Bell extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Bell\Bell::class;
    }
}
