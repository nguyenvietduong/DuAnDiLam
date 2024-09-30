<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\RoleServiceInterface;
use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Traits\HandleExceptionTrait;
use App\DataTables\Backend\RolesDataTable;

// Requests
use App\Http\Requests\BackEnd\Roles\ListRequest   as RoleListRequest;
use App\Http\Requests\BackEnd\Roles\UpdateRequest as RoleUpdateRequest;

class RoleController extends Controller
{
    use HandleExceptionTrait;

    protected $roleService;
    protected $roleRepository;

    // Base path for views
    const PATH_VIEW = 'backend.role.';

    public function __construct(
        RoleServiceInterface     $roleService,
        RoleRepositoryInterface  $roleRepository,
    ) {
        $this->roleService       = $roleService;
        $this->roleRepository    = $roleRepository;
    }

    /**
     * Display a listing of role, supporting search and pagination.
     *
     * @param RoleListRequest $request
     * @return \Illuminate\View\View
     */

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render(self::PATH_VIEW . __FUNCTION__, [
            'table_name'   => 'role',
            'totalRecords' => $this->roleRepository->count(),
        ]);
    }

    /**
     * Show the form for editing an role.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the role
        $role = $this->roleService->getRoleDetail($id);
        if ($role) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'role' => $role,
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an role.
     *
     * @param int $id
     * @param RoleUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, RoleUpdateRequest $request)
    {
        // Validate the data from the request using RoleUpdateRequest
        $data = $request->validated();

        try {
            // Update the role
            $this->roleService->updateRole($id, $data);
            return redirect()->route('admin.role.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an role.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the role
            $this->roleService->deleteRole($id);
            // Trả về JSON response nếu thành công
            return response()->json([
                'success' => true,
                'message' => 'User delete successfully!',
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
