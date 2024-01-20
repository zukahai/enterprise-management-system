<?php

namespace App\Http\Controllers\main;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return View('admin.pages.message.index');
    }
}
