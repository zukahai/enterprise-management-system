<?php

namespace App\Http\Services;

use App\Models\Notification;

class NotificationService extends BaseService
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }
}