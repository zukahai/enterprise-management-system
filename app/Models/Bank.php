<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Bank extends Model
{
    protected $guarded = [];
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

}
