<?php

namespace Fintech\Bell;

use Fintech\Bell\Exceptions\BellException;
use Fintech\Bell\Services\NotificationTemplateService;
use Fintech\Bell\Services\TriggerActionService;
use Fintech\Bell\Services\TriggerRecipientService;
use Fintech\Bell\Services\TriggerService;
use Fintech\Bell\Services\TriggerVariableService;

class Bell
{
    /**
     * @throws BellException
     */
    public function sms()
    {
        $active = config('fintech.bell.sms.default');

        if ($active == null) {
            throw new BellException('No SMS driver configured as default');
        }

        $driver = config("fintech.bell.sms.{$active}.driver");

        return app($driver);
    }

    /**
     * @throws BellException
     */
    public function push()
    {
        $active = config('fintech.bell.push.default');

        if ($active == null) {
            throw new BellException('No Push Notification driver configured as default');
        }

        $driver = config("fintech.bell.push.{$active}.driver");

        return app($driver);
    }

    /**
     * @return TriggerService
     */
    public function trigger()
    {
        return app(TriggerService::class);
    }

    /**
     * @return TriggerRecipientService
     */
    public function triggerRecipient()
    {
        return app(TriggerRecipientService::class);
    }

    /**
     * @return TriggerVariableService
     */
    public function triggerVariable()
    {
        return app(TriggerVariableService::class);
    }

    /**
     * @return NotificationTemplateService
     */
    public function notificationTemplate()
    {
        return app(NotificationTemplateService::class);
    }

    /**
     * @return TriggerActionService
     */
    public function triggerAction()
    {
        return app(TriggerActionService::class);
    }

    //** Crud Service Method Point Do not Remove **//

}
