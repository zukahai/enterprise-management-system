<?php

namespace App\Http\Controllers\main;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public $data = [];

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function index() {
        return view('admin.pages.staff.index', $this->data);
    }

    public function test() {
        return response()->json(['data' => 'abc']);
    }

    public function profile() {
        return auth()->user();
    }

    public function create(StoreUserRequest $request) {
        if ($request->password != $request->password2)
            return redirect()->route('staff.index')->with('warning','Mật khẩu nhập lại không trùng khớp');
        $object = $request->only('username', 'password', 'name', 'email', 'date', 'cccd', 'address', 'phone_number', 'business_day', 'allowance');
        $user = $this->service->create($object);
        if ($user)
            return redirect()->route('staff.index')->with('success','Thêm nhân viên thành công');
        return redirect()->route('staff.index')->with('error','Không thêm được nhân viên');
    }

    public function loginPage() {
        return View ('admin.pages.other.login');
    }

    public function login(Request $request) {
        $user = $this->service->loginByAccount($request);
        if ($user) {
            auth()->login($user);
            $token = auth()->user()->createToken('auth-token')->plainTextToken;
            return redirect(route('home'))->with('authToken', $token);
        } else {
            return redirect()->back()->with('error', "Tài khoản hoặc mật khẩu chưa chính xác!");
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/login')->with('success', 'Bạn đã đăng xuất tài khoản');
    }

}
