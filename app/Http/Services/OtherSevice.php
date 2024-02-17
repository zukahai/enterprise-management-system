<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class OtherSevice
{

    public static function getChanges($oldData, $newData)
    {
        $changes = [];
        $ignore = ['id', 'created_at', 'updated_at', 'deleted_at'];

        foreach ($oldData->toArray() as $key => $value) {
            if ($value !== $newData->{$key} && !in_array($key, $ignore)) {
                $changes[$key] = [
                    'old' => $value,
                    'new' => $newData->{$key},
                ];
            }
        }
        return $changes;
    }

    public static function activityUpdate($oldData, $newData) {
        $changes = self::getChanges($oldData, $newData);
        activity()
                ->performedOn($oldData)
                ->withProperties(['changes' => $changes])
                // ->withEvent('updated')
                ->log('Updated record with ID ' . $oldData->id)
                ->causedBy(Auth::user());
        
        Activity::orderBy('created_at', 'desc')->first()
        ->update([
            'event' => 'updated',
        ]);
    }
}