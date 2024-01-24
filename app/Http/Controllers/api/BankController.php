<?php

namespace App\Http\Controllers\api;

use App\Http\Services\BankService;
use App\Models\Bank;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function __construct(BankService $service)
    {
        $this->service = $service;
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
        $customers =  $this->service->getAll();
        return response()->json(['data' => $customers], 200);
    }
    public function show(Request $request, $id)
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

        $object = $this->service->getById($id);
        return response()->json(['data' => $object], 200);
    }



    public function update(UpdateCustomerRequest $request, $id)
    {
        //
    }


    public function destroy(Request $request, $id)
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

        $id = $this->service->delete($id);
        return response()->json(['data' => $id], 200);
    }
}
