<?php

namespace App\Http\Controllers\Ajax\Backend\Role;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\RoleServiceInterface;
use App\Traits\HandleExceptionTrait;


// Requests
use App\Http\Requests\BackEnd\Roles\StoreRequest  as RoleStoreRequest;

class CreateRoleAjax extends Controller
{
    use HandleExceptionTrait;

    protected $roleService;
    protected $roleRepository;

    public function __construct(
        RoleServiceInterface     $roleService,
    ) {
        $this->roleService       = $roleService;
    }

    public function store(RoleStoreRequest $request)
    {
        // Validate the data from the request using RoleStoreRequest
        $data  = $request->validated();

        try {
            // Create a new role using the role service
            $data = $this->roleService->createRole($data);

            // Trả về JSON response nếu thành công
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully!',
            ]);
        } catch (\Exception $e) {
            // Trả về JSON response nếu có lỗi
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
