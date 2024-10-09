@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="p-30">
        <div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{ $title }}</h4>
            </div>
            <div class="p-30 bg-white bd-half bd-c-ebedf0 bd-ra-25">
                <div class="row rg-25">
                    <div class="col-md-8">
                        <form class="ajax reset" action="{{route('admin.subscription-email-template.send-mail')}}"
                              method="post"
                              data-handler="commonResponseForModal">
                            @csrf
                            <div class="row rg-25">
                                <div class="col-md-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="currentPassword" class="form-label">{{ __('Select Template') }}
                                                <span
                                                    class="text-danger">*</span></label>
                                            <select class="primary-form-control sf-select-without-search"
                                                    name="email_template">
                                                @foreach($mailTemplateType as $data)
                                                    <option value="{{$data->id}}">{{$data->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="" class="form-label">{{ __('Select Type') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="primary-form-control sf-select-without-search"
                                                    id="subscriptionType" name="type">
                                                <option value="all">{{ __('All') }}</option>
                                                <option value="all-subscription">{{ __('All Subscriber') }}</option>
                                                <option value="all-alumni">{{ __('All Alumni') }}</option>
                                                <option
                                                    value="individual-subscription">{{ __('Individual Subscriber') }}</option>
                                                <option value="individual-alumni">{{ __('Individual Alumni') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="primary-form-group individual_subscription_label d-none">
                                        <div class="primary-form-group-wrap">
                                            <label for="" class="form-label">{{ __('Select Subscriber') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="individual_subscription[]"
                                                    class="primary-form-control sf-select-edit-modal"
                                                    id="individual_subscription"
                                                    data-search-route="{{ route('admin.subscription-email-template.individual-subscription-search') }}"
                                                    multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="primary-form-group individual_alumni_label d-none">
                                        <div class="primary-form-group-wrap">
                                            <label for="" class="form-label">{{ __('Select Alumni') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="primary-form-control sf-select-edit-modal"
                                                    name="individual_alumni[]"
                                                    id="individual_alumni" multiple="multiple"
                                                    data-search-route="{{ route('admin.subscription-email-template.individual-alumni-search') }}">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit"
                                            class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Send')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/subscription-email-template.js') }}"></script>
@endpush
