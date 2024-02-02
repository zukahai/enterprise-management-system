<?php

namespace App\Http\Controllers\api;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
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

    public function getAllExportOrder(Request $request, $id)
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

        $object = $this->service->getAllExportOrder($id);
        return response()->json(['data' => $object], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
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
