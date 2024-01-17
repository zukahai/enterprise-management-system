<?php

namespace App\Http\Controllers\main;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public $data = [];

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function index() {
        $users = [
            "data" => [
                [
                    "id" => 1,
                    "avatar" => "10.png",
                    "full_name" => "Korrie O'Crevy",
                    "post" => "Nuclear Power Engineer",
                    "email" => "kocrevy0@thetimes.co.uk",
                    "city" => "Krasnosilka",
                    "start_date" => "09/23/2021",
                    "salary" => "$23896.35",
                    "age" => "61",
                    "experience" => "1 Year",
                    "status" => 2
                ],
                [
                    "id" => 2,
                    "avatar" => "1.png",
                    "full_name" => "Bailie Coulman",
                    "post" => "VP Quality Control",
                    "email" => "bcoulman1@yolasite.com",
                    "city" => "Hinigaran",
                    "start_date" => "05/20/2021",
                    "salary" => "$13633.69",
                    "age" => "63",
                    "experience" => "3 Years",
                    "status" => 2
                ]
            ]
        ];

        $this->data['users'] = $users['data'];
        
     
        return view('admin.pages.staff.index', $this->data);
    }

    public function test()
    {
        return response()->json(['data' => 'abc']);
    }

}
