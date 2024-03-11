<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
    }

    public function activity($id) {
        $condition = ['subject_type' => "App\Models\Customer"];
        $this->data['activities'] = OtherSevice::getActivitesOfUser($condition);
    }
}
