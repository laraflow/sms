<?php

namespace Fintech\Bell\Models;

use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trigger extends BaseModel
{
    use AuditableTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $appends = ['links'];

    protected $casts = ['trigger_data' => 'array', 'restored_at' => 'datetime', 'enabled' => 'bool'];

    protected $hidden = ['creator_id', 'editor_id', 'destroyer_id', 'restorer_id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function triggerActions(): HasMany
    {
        return $this->hasMany(config('fintech.bell.trigger_action_model', TriggerAction::class));
    }

    public function triggerRecipients(): HasMany
    {
        return $this->hasMany(config('fintech.bell.trigger_recipient_model', TriggerRecipient::class));
    }

    public function triggerVariables(): HasMany
    {
        return $this->hasMany(config('fintech.bell.trigger_variable_model', TriggerVariable::class));
    }

    public function notificationTemplates(): HasMany
    {
        return $this->hasMany(config('fintech.bell.notification_template_model', NotificationTemplate::class));
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * @return array
     */
    public function getLinksAttribute()
    {
        $primaryKey = $this->getKey();

        $links = [
            'show' => action_link(route('bell.triggers.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'update' => action_link(route('bell.triggers.update', $primaryKey), __('core::messages.action.update'), 'put'),
            'destroy' => action_link(route('bell.triggers.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
            'restore' => action_link(route('bell.triggers.restore', $primaryKey), __('core::messages.action.restore'), 'post'),
        ];

        if ($this->getAttribute('deleted_at') == null) {
            unset($links['restore']);
        } else {
            unset($links['destroy']);
        }

        return $links;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
