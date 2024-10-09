<?php

namespace App\Http\Services;

use App\Models\NewsSubscriptionLetter;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class NewsSubscriptionLetterServices
{
    use ResponseTrait;

    public function getData($id){

        return NewsSubscriptionLetter::where('tenant_id',getTenantId())->where('id',$id)->first();
    }

    public function list($tenant_id = null)
    {
        $newsSubscriptionLetter = NewsSubscriptionLetter::where('tenant_id', getTenantId())->orderBy('id', 'DESC');

        return datatables($newsSubscriptionLetter)
            ->addIndexColumn()
            ->editColumn('date', function ($data) {
                return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('jS F, h:i:s A');
            })
            ->editColumn('status', function ($data) {
                if ($data->status == STATUS_ACTIVE) {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">' . __('Active') . '</span>';
                } else {
                    return '<span class="zBadge-free">' . __('Deactivated') . '</span>';
                }
            })
            ->addColumn('action', function ($data) use ($tenant_id) {
                if ($tenant_id != null) {
                    return '<ul class="d-flex align-items-center cg-5 justify-content-center">
                <li class="d-flex gap-2">
                    <button onclick="getEditModal(\'' . route('saas.super_admin.news-subscription-letter-email.edit', $data->id) . '\', \'#news-subscription-letter-edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="' . __('Edit') . '">
                        <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                    </button>
                    <button onclick="deleteItem(\'' . route('saas.super_admin.news-subscription-letter-email.delete', $data->id) . '\', \'newsSubscriptionLetterDataTable\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="' . __('Delete') . '">
                        <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                    </button>
                </li>
            </ul>';
                } else {
                    return '<ul class="d-flex align-items-center cg-5 justify-content-center">
                <li class="d-flex gap-2">
                    <button onclick="getEditModal(\'' . route('admin.news-subscription-letter-email.edit', $data->id) . '\', \'#news-subscription-letter-edit-modal\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="' . __('Edit') . '">
                        <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                    </button>
                    <button onclick="deleteItem(\'' . route('admin.news-subscription-letter-email.delete', $data->id) . '\', \'newsSubscriptionLetterDataTable\')" class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="' . __('Delete') . '">
                        <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                    </button>
                </li>
            </ul>';
                }
            })

            ->rawColumns(['status', 'action','date'])
            ->make(true);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $newsSubscriptionLetter = NewsSubscriptionLetter::updateOrCreate(
                [
                    'email' => $request->email,
                    'tenant_id' => getTenantId()
                ],
                [
                    'email' => $request->email,
                    'status' => $request->STATUS_ACTIVE ?? STATUS_ACTIVE,
                    'tenant_id' => getTenantId()
                ]
            );

            $newsSubscriptionLetter->save();

            DB::commit();
            return $this->success([], getMessage(SENT_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

    public function update($id, $request)
    {
        try {
            DB::beginTransaction();

            $newsSubscriptionLetter = NewsSubscriptionLetter::where('id', $id)->where('tenant_id', getTenantId())->firstOrFail();
            $newsSubscriptionLetter->email = $request->email;
            $newsSubscriptionLetter->status = $request->status;

            $newsSubscriptionLetter->save();

            DB::commit();
            return $this->success([], getMessage(UPDATED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

    public function deleteById($id)
    {
        try {
            $newsSubscriptionLetter = NewsSubscriptionLetter::where('id', $id)->firstOrFail();
            $newsSubscriptionLetter->delete();
            DB::beginTransaction();
            DB::commit();
            $message = getMessage(DELETED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

}
