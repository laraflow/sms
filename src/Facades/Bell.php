<?php

namespace Fintech\Bell\Facades;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Services\NotificationTemplateService;
use Fintech\Bell\Services\TriggerActionService;
use Fintech\Bell\Services\TriggerRecipientService;
use Fintech\Bell\Services\TriggerService;
use Fintech\Bell\Services\TriggerVariableService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SmsDriver sms()
 * @method static TriggerService trigger()
 * @method static TriggerRecipientService triggerRecipient()
 * @method static TriggerVariableService triggerVariable()
 * @method static NotificationTemplateService notificationTemplate()
 * @method static TriggerActionService triggerAction()
 *                                                     // Crud Service Method Point Do not Remove //
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
