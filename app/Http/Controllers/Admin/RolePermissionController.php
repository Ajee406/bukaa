<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data['title'] = __('Roles');
        $data['showManageModerator'] = 'show';
        $data['activeRole'] = 'active';
        $data['roles'] = Role::where('tenant_id', getTenantId())->orderBy('id', 'DESC')->get();
        $data['permissions'] = Permission::all();
        return view('admin.moderators.roles.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $role = new Role();
            $role->display_name = $request->name;
            $role->name = getSlug($request->name).'-'.date('Ymdhis');
            $role->tenant_id = getTenantId();
            $role->guard_name = 'web';
            $role->status = $request->status;
            $role->save();

            $role->syncPermissions($request->permissions);

            DB::commit();
            $message = __(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['role'] = Role::findOrFail($id);
        $data['permissions'] = Permission::all();
        $data['oldPermissions'] = $data['role']->permissions->pluck('name')->toArray();
        return view('admin.moderators.roles.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $role = Role::where('id', $id)->first();
            if($role->display_name !== $request->name){
                $role->display_name = $request->name;
                $role->name = getSlug($request->name).'-'.date('Ymdhis');
            }
            $role->status = $request->status;
            $role->save();

            $role->syncPermissions($request->permissions);

            DB::commit();
            $message = __(UPDATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Role::where('id', $id)->delete();

            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            return redirect()->back()->with('success',$message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return redirect()->back()->with('error',$message);
        }
    }
}
