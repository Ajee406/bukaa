<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsSubscriptionTemplateSendMailRequest;
use App\Http\Requests\Admin\SubscriptionEmailTemplateRequest;
use App\Http\Services\SubscriptionEmailTemplateServices;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SubscriptionEmailTemplateController extends Controller
{
    use ResponseTrait;
    public $subscriptionEmailTemplate;

    public function __construct()
    {
        $this->subscriptionEmailTemplate = new SubscriptionEmailTemplateServices();
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            return $this->subscriptionEmailTemplate->list(1);
        }
        $data['showNewsSubscriptionLetter'] = 'show';
        $data['title'] =  __('Email Subscription Template');
        $data['activeEmailTemplateSubscription'] = 'active';
        return view('admin.subscription_email_template.index', $data);
    }

    public function edit($id){

        $data['getSubscriptionEmailTemplateInfo'] = $this->subscriptionEmailTemplate->getData($id);

        return view('admin.subscription_email_template.edit',$data);
    }

    public function view($id){

        $data['getSubscriptionEmailTemplateInfo'] = $this->subscriptionEmailTemplate->getData($id);

        return view('admin.subscription_email_template.view',$data);
    }

    public function store(SubscriptionEmailTemplateRequest $request)
    {
        return $this->subscriptionEmailTemplate->store($request);
    }

    public function update($id, SubscriptionEmailTemplateRequest $request)
    {
        return $this->subscriptionEmailTemplate->update($id, $request);
    }

    public function delete($id)
    {
        return $this->subscriptionEmailTemplate->deleteById($id);
    }

    public function preViewTestMail($id,Request $request){

       return $this->subscriptionEmailTemplate->sendPreviewEmail($id,$request);
    }

    public function sendMailList(){

        $data['showNewsSubscriptionLetter'] = 'show';
        $data['title'] =  __('Subscription Email Send');
        $data['activeEmailTemplateSubscriptionSendMail'] = 'active';
        $data['mailTemplateType'] = $this->subscriptionEmailTemplate->getTemplateType();

        return view('admin.subscription_email_template.send-mail', $data);
    }

    public function sendMail(NewsSubscriptionTemplateSendMailRequest $request){

        return $this->subscriptionEmailTemplate->sendMail($request, getTenantId());
    }

    public function individualSubscriptionSearch(Request $request){

        return $this->subscriptionEmailTemplate->subscriptionSearch($request,1);
    }

    public function individualAlumniSearch(Request $request){

        return $this->subscriptionEmailTemplate->alumniSerch($request,1);
    }
}
