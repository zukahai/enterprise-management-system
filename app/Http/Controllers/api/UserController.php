<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePassword;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{

    public function test()
    {
        return response()->json(['message' => 'Hello'], 200);
    }
   
    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function index(Request $request)
    {
        $json_error = [
            'message' => 'Unauthenticated.',
            'data' => []
        ];
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([$json_error], 200);
        }

        // Kiểm tra và lấy thông tin người dùng
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([$json_error ], 200);
        }

        if ($user->role->role_name != 'admin') {
            return response()->json([$json_error], 200);
        }
        $users = $this->service->getAll();
        // ẩn đi cột password
        $users->makeHidden('password');
        return response()->json(['data' => $users], 200);
       
    }

    public function viewLogin(){
        return "Login page";
    }


 
    public function create() {
        //
    }

    public function store(StoreUserRequest $request)
    {
        //
    }

   
    public function show(Request $request, $id)
    {
        $json_error = [
            'message' => 'Unauthenticated.',
            'data' => []
        ];
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json($json_error, 200);
        }
        

        // Kiểm tra và lấy thông tin người dùng
        $user = Auth::user();
        
        if (!$user) {
            return response()->json($json_error, 200);
        }
        
        if ($user->role->role_name != 'admin') {
            return response()->json([$user->role], 200);
        }

        $user = $this->service->find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->makeHidden('password');
        return response()->json(['data' => $user], 200, [], JSON_UNESCAPED_UNICODE);
    }

   
    public function edit(User $user)
    {
        //
    }
   
    public function update($id, UpdateUserRequest $request)
    {
        $object = $this->service->update($id, $request->all());
        return response()->json($object, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function changePassword($id, ChangePassword $request)
    {
        $object = $this->service->changePassword($id, $request->only('password'));
        return response()->json($object, 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function destroy(Request $request, $id){
        $json_error = [
            'message' => 'Unauthenticated.',
            'data' => []
        ];
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json($json_error, 200);
        }
        

        // Kiểm tra và lấy thông tin người dùng
        $user = Auth::user();
        
        if (!$user) {
            return response()->json($json_error, 200);
        }
        

        if ($user->role->role_name != 'admin') {
            return response()->json([$user->role], 200);
        }
        $id_rp = $this->service->delete($id);
        return response()->json(['data' => $id_rp, 'username'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function login(Request $request) {
        $status_login = $this->service->login($request);

        if ($status_login) {
            // Đăng nhập thành công, tạo và trả về token
            $token = auth()->user()->createToken('auth-token')->plainTextToken;
            
            return response()->json(['token' => $token], 200);
        } else {
            // Đăng nhập thất bại
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function register(StoreUserRequest $request)
    {
        if ($this->service->countUser() > 0)
        {
            return response()->json(['message' => 'Count User > 1'], 200);
        }
        // Tạo user mới
        $user = $this->service->register($request);

        if ($user) {
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token], 201);
        } else {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function checkToken(Request $request) {
        // Lấy token từ request
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Kiểm tra và lấy thông tin người dùng
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Trả về thông tin người dùng
        return response()->json(['user' => $user], 200);
    }
}
