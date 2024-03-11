<?php

namespace App\Http\Controllers\main;

use App\Http\Services\OtherSevice;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public $data = [];

    public function __construct(
        AuthService $authService,
        OtherSevice $otherSevice
    )
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

    public function profileUser($username = '') {
        $user = $this->service->findByUsername($username);
        if (!$user)
            return redirect()->route('home')->with('warning','Hồ sơ không tồn tại');
        if ($user->id != auth()->user()->id && auth()->user()->role->role_name != 'admin') {
            $user->makeHidden('password', 'remember_token', 'cccd', 'business_day', 'allowance');
            $user->password = null;
            $user->cccd = null;
            $user->business_day = null;
            $user->allowance = null;
        }
        $this->data['user'] = $user;
        $condition = ['causer_id' => $user->id];
        $this->data['activities'] = OtherSevice::getActivitesOfUser($condition);
        return View('admin.pages.staff.profile', $this->data);
    }

    public function create(StoreUserRequest $request) {
        if ($request->password != $request->password2)
            return redirect()->route('staff.index')->with('warning','Mật khẩu nhập lại không trùng khớp');

        $object = $request->only('username', 'password', 'name', 'email', 'date', 'cccd', 'address', 'phone_number', 'business_day', 'allowance', 'birthday');

        // Xử lí ảnh
        if ($request->hasFile('avata')) {
            $file = $request->avata;
            $path = $file->store('images/avatars/post');
            $file->move(public_path('images/avatars/post'), $path);
            $object['avata'] = $path;
        } 
        
        $user = $this->service->create($object);
        if ($user)
            return redirect()->route('staff.index')->with('success','Thêm nhân viên thành công');
        return redirect()->route('staff.index')->with('error','Không thêm được nhân viên');
    }

    public function update(Request $request, $id) {
        // dd($request->all());
        if (auth()->user()->id != $id && auth()->user()->role->role_name != 'admin')
            return redirect()->route('staff.index')->with('warning','Bạn không thể cập nhật tài khoản người khác khi không phải là amdin');
        $object = $request->only('username','name', 'email', 'date', 'cccd', 'address', 'phone_number', 'business_day', 'allowance', 'birthday');
        if ($request->hasFile('avata')) {
            $file = $request->avata;
            $path = $file->store('images/avatars/post');
            $file->move(public_path('images/avatars/post'), $path);
            $object['avata'] = $path;
        } 
        $user = $this->service->update($id, $object);
        if ($user)
            return redirect()->route('staff.index')->with('success','Cập nhật thành công');
        return redirect()->route('staff.index')->with('error','Cập nhật thất bại');
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
