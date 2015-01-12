<?php namespace Stevebauman\Maintenance\Models;

use Stevebauman\Maintenance\Traits\HasUserTrait;
use Stevebauman\Maintenance\Models\BaseModel;

class Notification extends BaseModel
{

    protected $table = 'notifications';

    protected $fillable = array(
        'user_id',
        'notifiable_id',
        'notifiable_type',
        'message',
        'link',
        'read'
    );

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function getIconAttribute()
    {
        $class = $this->attributes['notifiable_type'];

        if ($icon = config("maintenance::notifications.icons.$class")) {
            return $icon;
        } else {
            return 'test';
        }
    }
}