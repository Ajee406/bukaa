<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ModeratorRequest;
use App\Models\Alumni;
use App\Models\FileManager;
use App\Models\Owner;
use App\Models\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ModeratorController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $moderator = User::query()
                ->where('users.role', USER_ROLE_ADMIN)
                ->whereNotNull('users.created_by')
                ->with('roles')
                ->select('users.id', 'users.name', 'users.status', 'users.email', 'users.mobile');

            return datatables($moderator)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return implode(',', $user->roles()->pluck('display_name')->toArray());
                })
                ->addColumn('status', function ($user) {
                    if ($user->status == USER_STATUS_ACTIVE) {
                        return '<div class="status-btn status-btn-green font-13 radius-4">Active</div>';
                    } else if ($user->status == USER_STATUS_INACTIVE) {
                        return '<div class="status-btn status-btn-orange font-13 radius-4">Inactive</div>';
                    }
                })
                ->addColumn('action', function ($user) {
                    return '<ul class="d-flex align-items-center cg-5 justify-content-center">
                        <li class="d-flex gap-2">
                            <button onclick="getEditModal(\'' . route('admin.moderators.edit', $user->id) . '\', \'#edit-modal\', \'editReponse\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="' . __('Edit') . '">
                                <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                            </button>
                            <button onclick="deleteItem(\'' . route('admin.moderators.delete', $user->id) . '\', \'moderatorDataTable\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="' . __('Delete') . '">
                                <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                            </button>
                        </li>
                    </ul><div class="tbl-action-btns d-inline-flex"></div>';
                })

            ->rawColumns(['roles', 'status', 'action'])
                ->make(true);
        }

        $data['title'] = __('Moderator');
        $data['showManageModerator'] = 'show';
        $data['activeModerator'] = 'active';
        $data['roles'] = Role::where('tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->get();
        return view('admin.moderators.index', $data);
    }

    public function store(ModeratorRequest $request)
    {
        DB::beginTransaction();
        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->status = $request->status;
            $user->password = bcrypt($request->password);
            $user->role = USER_ROLE_ADMIN;
            $user->tenant_id = getTenantId();
            $user->created_by = auth()->id();
            $user->status = $request->status;
            $user->is_alumni = STATUS_PENDING;
            $user->verify_token = str_replace('-', '', Str::uuid()->toString());
            $user->email_verification_status = 1;
            $user->save();

            //roles
            $user->syncRoles($request->roles);
            /*End*/
            DB::commit();

            $message = __(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function update(ModeratorRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $user = User::where('id', $id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->status = $request->status;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->status = $request->status;
            $user->save();

            //roles
            $user->syncRoles($request->roles);

            /*End*/
            DB::commit();

            $message = __(UPDATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::where('tenant_id', getTenantId())->get();
        return view('admin.moderators.edit-form')->with($data);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('tenant_id', getTenantId())->findOrFail($id);
            $user->delete();
            Alumni::where('user_id', $id)->delete();
            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }
}
