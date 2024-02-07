<?php

namespace App\Http\Controllers\main;

use App\Http\Services\BankService;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;


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
        return "Hello";
    }
}
