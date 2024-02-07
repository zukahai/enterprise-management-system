<?php

namespace App\Console\Commands;

use App\Http\Services\AuthService;
use App\Http\Services\BankService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Role;

class SeederTable extends Command
{
    protected $bankService;
    public function __construct(
        BankService $bankService,
        AuthService $authService
    )
    {
        parent::__construct();
        $this->bankService = $bankService;
        $this->authService = $authService;
    }
    
    protected $signature = 'haizuka';

    protected $description = 'Seeder table';

    public function createRoles() {
        $roles = [
            [
                'role_name'=> 'admin',
                'description' => 'Quản trị viên'
            ],
            [
                'role_name'=> 'staff',
                'description' => 'Nhân viên'
            ]
            ];
        $count = Role::count();
        if ($count == 0) {
            foreach ($roles as $key => $value) {
                Role::create($value);
            }
            return true;
        }
        return false;
    }


    public function createBanks()
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
                }
                return true;
            } else {
                $statusCode = $response->status();
            }
        } else
            return false;
    }

    public function createAccountAdmin() {
        $count = $this->authService->countObject();
        if ($count == 0) {
            $account = [
                'username' => "hoangphat",
                'password' => "admin123",
                'name' => "Hoàng Phát",
            ];

            $this->authService->register($account);

            return true;
        }
        return false;
    }
  
    public function handle()
    {
        $createBanks = $this->createBanks();
        if ($createBanks)
            $this->info('Tạo dữ liệu "Ngân Hàng" thành công');
        else
            $this->warn('Bảng "Ngân hàng" đã có sẵn dữ liệu');

        $createRoles = $this->createRoles();
        if ($createRoles)
            $this->info('Tạo dữ liệu "roles" thành công');
        else
            $this->warn('Bảng "roles" đã có sẵn dữ liệu');
        
        $createAccountAdmin = $this->createAccountAdmin();
        if ($createAccountAdmin)
            $this->info('Tạo dữ liệu "admin" hoàn thành');
        else
            $this->warn('Bảng "admin" không có sẵn dữ liệu');
        $this->info('Hoàn thành');
    }
}
