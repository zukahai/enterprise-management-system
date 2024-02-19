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
        $hidden = ['created_at', 'updated_at', 'deleted_at'];

        foreach ($oldData->toArray() as $key => $value) {
            if (!in_array($key, $ignore) 
                && isset($oldData->{$key}) && isset($newData->{$key})) {
                if (substr($key, -3) == "_id")
                    continue;
                if (!isset($oldData->{$key}->id) && !isset($newData->{$key}?->id)) {
                    // Kiểm tra xem cả hai đều không phải là đối tượng
                    if ($oldData->{$key} != $newData->{$key}) {
                        $changes[$key] = [
                            'old' => $oldData->{$key},
                            'new' => $newData->{$key}
                        ];
                    }
                } else if (isset($oldData->{$key}->id) && isset($newData->{$key}?->id)){
                    $oldData->{$key}->makeHidden($hidden);
                    $newData->{$key}->makeHidden($hidden);
                    if ($oldData->{$key}->id != $newData->{$key}->id) {
                        $changes[$key] = [
                            'old' => $oldData->{$key},
                            'new' => $newData->{$key}
                        ];
                    }
                }
            }
        }
        return $changes;
    }

    public static function activityUpdate($oldData, $newData)
    {
        $changes = self::getChanges($oldData, $newData);
        activity()
            ->performedOn($oldData)
            ->withProperties(['changes' => $changes, 'data' => $newData])
            // ->withEvent('updated')
            ->log('Updated record with ID ' . $oldData->id)
            ->causedBy(Auth::user());

        Activity::orderBy('created_at', 'desc')->first()
            ->update([
                'event' => 'updated',
            ]);
    }

    public static function activityCreate($data)
    {
        $data->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        activity()
            ->performedOn($data)
            ->withProperties(['data' => $data])
            ->log('Created record with ID ' . $data->id)
            ->causedBy(Auth::user());

        Activity::orderBy('created_at', 'desc')->where('event', null)
            ->update([
                'event' => 'created',
            ]);
    }

    public static function activityDelete($data)
    {
        $data->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        activity()
            ->performedOn($data)
            ->withProperties(['data' => $data])
            ->log('Deleted record with ID ' . $data->id)
            ->causedBy(Auth::user());

        Activity::orderBy('created_at', 'desc')->where('event', null)->first()
            ->update([
                'event' => 'deleted',
            ]);
    }

    public static function getActivitesOfUser($user_id)
    {

        $map = [
            'created' => [
                'text' => 'Thêm mới một',
                'color' => 'success'
            ],
            'updated' => [
                'text' => 'Chỉnh sửa thông tin một',
                'color' => 'warning'
            ],
            'deleted' => [
                'text' => 'Xoá một',
                'color' => 'danger'
            ],
            'model' => [
                'App\Models\Bank' => [
                    'text' => 'Ngân hàng',
                    'url' => Route('bank.index') . '/?s=',
                    'route' => Route('bank.index')
                ],
                'App\Models\ExportOrder' => [
                    'text' => 'Đơn hàng xuất',
                    'url' => Route('export-order.index') . '/?s=',
                    'route' => Route('export-order.index')
                ],
                'App\Models\Supplier' => [
                    'text' => 'Nhà cung cấp',
                    'url' => Route('supplier.index') . '/?s=',
                    'route' => Route('supplier.index')
                ],
                'App\Models\Customer' => [
                    'text' => 'Khách hàng',
                    'url' => Route('customer.index') . '/?s=',
                    'route' => Route('customer.index')
                ],
                'App\Models\Ingredient' => [
                    'text' => 'Nguyên liệu',
                    'url' => Route('ingredient.index') . '/?s=',
                    'route' => Route('ingredient.index')
                ],
                'App\Models\FinishedProduct' => [
                    'text' => 'Thành phẩm',
                    'url' => Route('finished-product.index') . '/?s=',
                    'route' => Route('finished-product.index')
                ]
            ],
        ];

        $activities = Activity::where('causer_id', $user_id)->orderBy('created_at', 'desc')->get();
        for ($index = 0; $index < count($activities); $index++) {
            $item = $activities[$index];
            $item->activity = $map[$item->event]['text'];
            $item->url = $map['model'][$item->subject_type]['url'] . $item->subject_id;
            $item->color = $map[$item->event]['color'];
            $item->name_model = strtolower($map['model'][$item->subject_type]['text']);
            $item->route = $map['model'][$item->subject_type]['route'];
            //convert string to json
            $properties = json_decode($item->properties);
            $item->data = $properties->data ?? null;
            $item->data_changes = $properties->changes ?? null;
        }
        return $activities;
    }

}