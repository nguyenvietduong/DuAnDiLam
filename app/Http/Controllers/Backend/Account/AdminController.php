<?php

namespace App\Http\Controllers\Backend\Account;

use App\DataTables\Backend\Account\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Accounts\StoreRequest  as AccountStoreRequest;
use App\Http\Requests\BackEnd\Accounts\UpdateRequest as AccountUpdateRequest;

class AdminController extends Controller
{
    use HandleExceptionTrait;

    protected $accountService;
    protected $accountRepository;

    // Base path for views
    const PATH_VIEW = 'backend.account.admin.';

    public function __construct(
        AccountServiceInterface     $accountService,
        AccountRepositoryInterface  $accountRepository,
    ) {
        $this->accountService       = $accountService;
        $this->accountRepository    = $accountRepository;
    }

    /**
     * Display a listing of admin, supporting search and pagination.
     *
     * @param AccountListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(AdminDataTable $dataTable)
    {
        forgetSessionImageTemp('image_temp');
        return $dataTable->render(self::PATH_VIEW . __FUNCTION__, [
            'tableName'     => 'admin',
            'linkCreate'    => 'admin.admin.create',
            'totalRecords'  => $this->accountRepository->countWithAccount('sysadmin'),
        ]);
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'    => 'admin',
        ]);
    }

    /**
     * Handle the storage of a new admin.
     *
     * @param AccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountStoreRequest $request)
    {
        // Validate the data from the request using AccountStoreRequest
        $data   = $request->validated();
        try {
            // Create a new admin
            $this->accountService->createAccount($data);
            return redirect()->back()->with('success', 'Admin created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an admin.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the admin
        $admin = $this->accountService->getAccountDetail($id);
        if ($admin) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'admin'      => $admin,
                'object'    => 'admin',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an admin.
     *
     * @param int $id
     * @param AccountUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, AccountUpdateRequest $request)
    {
        // Validate the data from the request using AccountUpdateRequest
        $data = $request->validated();

        try {
            // Update the admin
            $this->accountService->updateAccount($id, $data);
            return redirect()->route('admin.admin.index')->with('success', 'Admin updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an admin.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the admin
            $this->accountService->deleteAccount($id);
            // Trả về JSON response nếu thành công
            return response()->json([
                'success' => true,
                'message' => 'Admin delete successfully!',
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
