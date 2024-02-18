<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Route;
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

    public static function activityCreate($data) {
        activity()
                ->performedOn($data)
                ->withProperties(['data' => $data])
                ->log('Created record with ID ' . $data->id)
                ->causedBy(Auth::user());
        
        Activity::orderBy('created_at', 'desc')->first()
        ->update([
            'event' => 'created',
        ]);
    }

    public static function activityDelete($data) {
        activity()
                ->performedOn($data)
                ->withProperties(['data' => $data])
                ->log('Deleted record with ID ' . $data->id)
                ->causedBy(Auth::user());
        
        Activity::orderBy('created_at', 'desc')->first()
        ->update([
            'event' => 'deleted',
        ]);
    }

    public static function getActivitesOfUser($user_id) {

        $map = [
            'created' => [
                'text' => 'Thêm mới một',
                'color'=> 'success'
            ],
            'updated' => [
                'text' => 'Chỉnh sửa thông tin một',
                'color'=> 'warning'
            ],
            'deleted' => [
                'text' => 'Xoá một',
                'color'=> 'danger'
            ],
            'model' => [
                'App\Models\Bank' => [
                    'text' => 'Ngân hàng',
                    'url' => Route('bank.index').'/?s='
                ]
            ],
        ];

        $activities = Activity::where('causer_id', $user_id)->orderBy('created_at', 'desc')->get();
        for ($index = 0; $index < count($activities); $index++) {
            $item = $activities[$index];
            $item->title = $map[$item->event]['text'].' '.$map['model'][$item->subject_type]['text'];
            $item->url = $map['model'][$item->subject_type]['url'].$item->subject_id;
            $item->color = $map[$item->event]['color'];
            //convert string to json
            $properties = json_decode($item->properties);
            $item->data = $properties->data ?? null;
            $item->data_changes = $properties->changes ?? null;
        }
        return $activities;
    }

}