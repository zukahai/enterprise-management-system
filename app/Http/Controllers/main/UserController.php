<?php

namespace App\Http\Controllers\main;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
   
    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function index() {
        return view('admin.pages.index');
    }

    public function test()
    {
        return response()->json(['data' => 'abc']);
    }

}
