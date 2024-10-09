<?php

namespace App\Http\Controllers\Frontend;

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

    public function store(NewsSubscriptionLetterRequest $request)
    {
        return $this->newsSebscriptionletterServices->store($request);
    }
}
