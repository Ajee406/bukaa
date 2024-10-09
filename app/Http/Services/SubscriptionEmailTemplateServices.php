<?php

namespace App\Http\Services;

use App\Models\NewsSubscriptionLetter;
use App\Models\SubscriptionEmailTemplate;
use App\Models\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class SubscriptionEmailTemplateServices
{
    use ResponseTrait;

    public function getData($id)
    {

        return SubscriptionEmailTemplate::where('tenant_id', getTenantId())->where('id', $id)->first();
    }

    public function getTemplateType()
    {

        return SubscriptionEmailTemplate::where('tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->get();
    }

    public function sendMail($request, $tenant_id=NULL)
    {
        $id = $request->email_template;
        $emails = [];

        if ($request->type === 'all') {
            $emails = NewsSubscriptionLetter::where('news_subscription_letters.tenant_id', $tenant_id)
                ->select('email')
                ->union(User::where('role', USER_ROLE_ALUMNI)->where('users.tenant_id', $tenant_id)->select('email'))
                ->pluck('email')
                ->toArray();
        } else if ($request->type === 'all-subscription') {
            $emails = NewsSubscriptionLetter::where('news_subscription_letters.tenant_id', $tenant_id)->select('email')->pluck('email')->toArray();
        } else if ($request->type === 'all-alumni') {
            $emails = User::where('role', 2)->where('users.tenant_id', $tenant_id)->select('email')->pluck('email')->toArray();
        } else if ($request->type === 'individual-subscription') {
            $emails = $request->individual_subscription;
        } else if ($request->type === 'individual-alumni') {
            $emails = $request->individual_alumni;
        }

        try {
            $response = genericEmailNotifyTemplate($id, $emails);
            if($response['success']){
                $message = getMessage(SENT_SUCCESSFULLY);
                return $this->success([], $message);
            }else{
                $message = $response['message'];
                return $this->error([], $message);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }

    }

    public function list($tenant_id = null)
    {
        $subscriptionEmailTemplate = SubscriptionEmailTemplate::where('tenant_id', getTenantId())->orderBy('id', 'DESC');

        return datatables($subscriptionEmailTemplate)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                if ($data->status == STATUS_ACTIVE) {
                    return '<span class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">' . __('Active') . '</span>';
                } else {
                    return '<span class="zBadge-free">' . __('Deactivated') . '</span>';
                }
            })
            ->addColumn('action', function ($data) use ($tenant_id) {
                if ($tenant_id != null) {
                    return
                        '<ul class="d-flex align-items-center cg-5 justify-content-center">
                            <li class="d-flex gap-2">
                                <button onclick="getEditModal(\'' . route('admin.subscription-email-template.view', $data->id) . '\'' . ', \'#subscription-email-template-view-modal\')"  class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="' . __('View') . '">
                                    <img src="' . asset('assets/images/icon/eye.svg') . '" alt="view" />
                                </button>
                                <button onclick="getEditModal(\'' . route('admin.subscription-email-template.edit', $data->id) . '\'' . ', \'#subscription-email-template-edit-modal\')"  class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="' . __('Edit') . '">
                                    <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                                </button>
                                <button onclick="deleteItem(\'' . route('admin.subscription-email-template.delete', $data->id) . '\', \'subscriptionEmailTemplateDatatable\')"  class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="' . __('Delete') . '">
                                    <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                                </button>
                            </li>
                        </ul>';
                } else {
                    return
                        '<ul class="d-flex align-items-center cg-5 justify-content-center">
                            <li class="d-flex gap-2">
                                <button onclick="getEditModal(\'' . route('saas.super_admin.subscription-email-template.view', $data->id) . '\'' . ', \'#subscription-email-template-view-modal\')"  class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="' . __('View') . '">
                                    <img src="' . asset('assets/images/icon/eye.svg') . '" alt="view" />
                                </button>
                                <button onclick="getEditModal(\'' . route('saas.super_admin.subscription-email-template.edit', $data->id) . '\'' . ', \'#subscription-email-template-edit-modal\')"  class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" data-bs-toggle="modal" data-bs-target="#alumniPhoneNo" title="' . __('Edit') . '">
                                    <img src="' . asset('assets/images/icon/edit.svg') . '" alt="edit" />
                                </button>
                                <button onclick="deleteItem(\'' . route('saas.super_admin.subscription-email-template.delete', $data->id) . '\', \'subscriptionEmailTemplateDatatable\')"  class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white" title="' . __('Delete') . '">
                                    <img src="' . asset('assets/images/icon/delete-1.svg') . '" alt="delete">
                                </button>
                            </li>
                        </ul>';
                }

            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $subscriptionEmailTemplate = new SubscriptionEmailTemplate();

            $subscriptionEmailTemplate->tenant_id = getTenantId();
            $subscriptionEmailTemplate->category = $request->category;
            $subscriptionEmailTemplate->slug = getSlug($request->category);
            $subscriptionEmailTemplate->subject = $request->subject;
            $subscriptionEmailTemplate->body = $request->body;
            $subscriptionEmailTemplate->status = $request->status;

            $subscriptionEmailTemplate->save();

            DB::commit();
            return $this->success([], getMessage(CREATED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }

    public function update($id, $request)
    {
        try {
            DB::beginTransaction();

            $subscriptionEmailTemplate = SubscriptionEmailTemplate::where('id', $id)->where('tenant_id', getTenantId())->firstOrFail();
            $subscriptionEmailTemplate->category = $request->category;
            $subscriptionEmailTemplate->slug = getSlug($request->category);
            $subscriptionEmailTemplate->subject = $request->subject;
            $subscriptionEmailTemplate->body = $request->body;
            $subscriptionEmailTemplate->status = $request->status;

            $subscriptionEmailTemplate->save();

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
            DB::beginTransaction();
            $subscriptionEmailTemplate = SubscriptionEmailTemplate::where('id', $id)->firstOrFail();
            $subscriptionEmailTemplate->delete();
            DB::commit();
            $message = getMessage(DELETED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function sendPreviewEmail($id, $request)
    {
        try {
            DB::beginTransaction();
            $email = $request->email;
            $response = genericEmailNotifyTemplate($id, $email);
            DB::commit();
            $message = getMessage(SENT_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function subscriptionSearch($request, $tenantId = null)
    {
        $emails = [];
        if ($tenantId != null) {
            if ($search = $request->individual_subscription) {
                $emails = NewsSubscriptionLetter::where('email', 'LIKE', '%' . $search . '%')->get();
            }
        } else {
            if ($search = $request->individual_subscription) {
                $emails = NewsSubscriptionLetter::where('email', 'LIKE', '%' . $search . '%')->where('tenant_id', getTenantId())->get();
            }
        }

        return response()->json($emails);
    }

    public function alumniSerch($request, $tenandId = null)
    {

        $emails = [];

        if ($tenandId != null) {
            if ($search = $request->individual_alumni) {
                $emails = User::where('role', USER_ROLE_ALUMNI)->where('email', 'LIKE', '%' . $search . '%')->get();
            }
        } else {

            if ($search = $request->individual_alumni) {
                $emails = User::where('role', USER_ROLE_SUPER_ADMIN)->where('email', 'LIKE', '%' . $search . '%')->where('tenant_id', getTenantId())->get();
            }
        }
        return response()->json($emails);
    }


}
