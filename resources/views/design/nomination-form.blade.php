@extends('layouts.app')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <h4 class="pb-16 fs-24 fw-500 lh-34 text-1b1c17">Apply Form</h4>
        <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
            <div class="max-w-840">
                <div class="pb-35 mb-35 bd-b-one bd-c-ededed">
                    <h4 class="pb-9 fs-24 fw-500 lh-34 text-1b1c17">Committee member candidate nomination form</h4>
                    <p class="fs-14 fw-400 lh-24 text-707070">This form must be used for committee member candidate nominations for the annual executive committee role. Nomination must be
                        received by the alumni secretary <span class="fw-600 text-1b1c17">no later than 3 days prior</span> to the executive committee.</p>
                </div>
                <!--  -->
                <div class="pb-50">
                    <div class="row rg-25">
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormElection" class="form-label">{{__('Election')}}</label>
                                    <select class="primary-form-control sf-select-without-search" name="employee_status" id="nominationFormElection">
                                            <option value="1">President</option>
                                            <option value="2">Vice President</option>
                                            <option value="3">General Secretary</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormForThePosition" class="form-label">{{__('For The Position')}}</label>
                                    <select class="primary-form-control sf-select-without-search" name="employee_status" id="nominationFormForThePosition">
                                            <option value="1">President</option>
                                            <option value="2">Vice President</option>
                                            <option value="3">General Secretary</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormNIDCardFile" class="form-label">{{__('NID Card File')}}</label>
                                    <input type="file" class="primary-form-control" id="nominationFormNIDCardFile" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormFlugFile" class="form-label">{{__('Flug File')}}</label>
                                    <input type="file" class="primary-form-control" id="nominationFormFlugFile" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormSignature" class="form-label">{{__('Signature')}}</label>
                                    <input type="file" class="primary-form-control" id="nominationFormSignature" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-35 mb-35 bd-b-one bd-c-ededed">
                    <h4 class="pb-9 fs-24 fw-500 lh-34 text-1b1c17">Declaration of Candidate</h4>
                    <div class="d-flex align-items-start cg-9">
                        <input class="form-check-input nominationFormCheckbox" type="checkbox" value="" id="nominationFormDeclaratinCandidate">
                        <label class="fs-14 fw-400 lh-24 text-707070" for="nominationFormDeclaratinCandidate">I hereby acknowledge the person i have nominated has consented to serve in this position for the 2023 - 2024 executive committee. </label>
                    </div>
                </div>
                <div class="pb-40">
                    <h4 class="pb-22 fs-24 fw-500 lh-34 text-1b1c17">Gateway</h4>
                    <div class="max-w-375">
                        <div class="d-flex justify-content-between align-items-center g-10 flex-wrap">
                            <button class="donationPaymentItem border-0 p-0 bg-transparent">
                                <div class="d-flex align-items-center cg-10">
                                    <input class="mt-0 shadow-none paymentItem-input form-check-input"
                                           type="radio" id="donationPayMethodPaypal"
                                           name="donationPaymentMethodItems">
                                    <label for="donationPayMethodPaypal"><img
                                            src="{{asset('frontend/images/paypal.png')}}" alt=""></label>
                                </div>
                            </button>
                            <button class="donationPaymentItem border-0 p-0 bg-transparent">
                                <div class="d-flex align-items-center cg-10">
                                    <input class="mt-0 shadow-none paymentItem-input form-check-input"
                                           type="radio" id="donationPayMethodStripe"
                                           name="donationPaymentMethodItems">
                                    <label for="donationPayMethodStripe"><img
                                            src="{{asset('frontend/images/stripe.png')}}" alt=""></label>
                                </div>
                            </button>
                            <button class="donationPaymentItem border-0 p-0 bg-transparent">
                                <div class="d-flex align-items-center cg-10">
                                    <input class="mt-0 shadow-none paymentItem-input form-check-input"
                                           type="radio" id="donationPayMethodBank"
                                           name="donationPaymentMethodItems">
                                    <label for="donationPayMethodBank"
                                           class="d-flex align-items-center cg-5">
                                        <span>Bank</span>
                                        <img src="{{asset('frontend/images/bank.png')}}" alt="">
                                    </label>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="pb-25">
                    <div class="row rg-25">
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormTotalFees" class="form-label">Total Fees (USD)</label>
                                    <input type="number" class="primary-form-control" id="nominationFormTotalFees" value="" name="mobile" placeholder="Enter Total Fees"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="nominationFormCurrency" class="form-label">Currency</label>
                                    <select class="primary-form-control sf-select-without-search" id="nominationFormCurrency">
                                        <option value="1">USD(50)</option>
                                        <option value="2">USD(50)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"  class="py-13 px-50 border-0 bd-ra-12 bg-cdef84 fs-15 fw-500 lh-25 text-1b1c17 w-100 text-center">{{__('Apply Now')}}</button>
            </div>
        </div>
    </div>
    <!-- Page content area end -->

@endsection

