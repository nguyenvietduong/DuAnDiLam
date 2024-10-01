<?php

namespace App\Http\Controllers\Backend\Account;

use App\DataTables\Backend\Account\UserDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Traits\HandleExceptionTrait;


// Requests
use App\Http\Requests\BackEnd\Accounts\StoreRequest  as AccountStoreRequest;
use App\Http\Requests\BackEnd\Accounts\UpdateRequest as AccountUpdateRequest;

class UserController extends Controller
{
    use HandleExceptionTrait;

    protected $accountService;
    protected $accountRepository;

    // Base path for views
    const PATH_VIEW = 'backend.account.user.';

    public function __construct(
        AccountServiceInterface     $accountService,
        AccountRepositoryInterface  $accountRepository,
    ) {
        $this->accountService       = $accountService;
        $this->accountRepository    = $accountRepository;
    }

    public function index(UserDataTable $dataTable)
    {
        forgetSessionImageTemp('image_temp');
        return $dataTable->render(self::PATH_VIEW . __FUNCTION__, [
            'tableName'     => 'user',
            'linkCreate'    => 'admin.user.create',
            'totalRecords'  => $this->accountRepository->countWithAccount('user'),
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'    => 'user',
        ]);
    }

    /**
     * Handle the storage of a new user.
     *
     * @param AccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountStoreRequest $request)
    {
        // Validate the data from the request using AccountStoreRequest
        $data   = $request->validated();
        try {
            // Create a new user
            $this->accountService->createAccount($data);
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the user
        $user = $this->accountService->getAccountDetail($id);
        if ($user) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'user'      => $user,
                'object'    => 'user',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an user.
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
            // Update the user
            $this->accountService->updateAccount($id, $data);
            return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an user.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the user
            $this->accountService->deleteAccount($id);
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
