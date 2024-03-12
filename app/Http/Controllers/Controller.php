<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Services\OtherSevice;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $data = [];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function activity($subject_type, $subject_id)
    {
        $condition = ['subject_type' => $subject_type, 'subject_id' => $subject_id];
        $this->data['activities'] = OtherSevice::getActivitesOfUser($condition);
    }

    protected function getData() {
        return $this->data;
    }
    
}
