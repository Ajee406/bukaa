<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsSubscriptionLetterRequest;
use App\Http\Services\NewsSubscriptionLetterServices;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class NewsSubscriptionLetterController extends Controller
{
    use ResponseTrait;
    public $newsSebscriptionletterServices;

    public function __construct()
    {
        $this->newsSebscriptionletterServices = new NewsSubscriptionLetterServices();
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            return $this->newsSebscriptionletterServices->list();
        }

        $data['showNewsSubscriptionLetter'] = 'show';
        $data['title'] =  __('Subscriber Email');
        $data['activeSubscriptionLetterEmail'] = 'active';
        return view('admin.news_subscription_letter.index', $data);
    }

    public function edit($id){

        $data['getNewsSubscriptionLetterInfo'] = $this->newsSebscriptionletterServices->getData($id);

        return view('admin.news_subscription_letter.edit',$data);
    }

    public function store(NewsSubscriptionLetterRequest $request)
    {
        return $this->newsSebscriptionletterServices->store($request);
    }

    public function update($id, NewsSubscriptionLetterRequest $request)
    {
        return $this->newsSebscriptionletterServices->update($id, $request);
    }

    public function delete($id)
    {
        return $this->newsSebscriptionletterServices->deleteById($id);
    }
}
