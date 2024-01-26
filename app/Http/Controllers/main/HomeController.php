<?php

namespace App\Http\Controllers\main;

use App\Http\Services\BankService;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function __construct(AuthService $authService, BankService $bankService)
    {
        $this->service = $authService;
        $this->bankService = $bankService;
    }

    public function index()
    {
        return view('admin.pages.index');
    }

    public function haizuka()
    {
        $count = $this->bankService->countObject();
        if ($count == 0) {
            $response = Http::get('https://api.vietqr.io/v2/banks');
            if ($response->successful()) {
                $data = $response->json();
                foreach ($data['data'] as $key => $value) {
                    $addData = [];
                    $addData['name'] = $value['shortName'];
                    $addData['code'] = $value['code'];
                    $addData['note'] = $value['name'];
                    $this->bankService->create($addData);
                    return "success";
                }
            } else {
                $statusCode = $response->status();
                dd("Error: $statusCode");
            }
        } else
            return $count;
    }



}
