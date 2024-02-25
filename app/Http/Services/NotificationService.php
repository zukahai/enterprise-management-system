<?php

namespace App\Http\Services;

use App\Models\Notification;

class NotificationService extends BaseService
{
    protected $model;
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }
}