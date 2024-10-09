@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{ $title }}</h4>
                <button type="submit" id="add-news"
                        class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one"
                        data-bs-toggle="modal" data-bs-target="#add-modal"><i class="fa fa-plus"></i>
                    {{ __('Add New') }}</button>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="subscriptionEmailTemplateDatatable">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div>{{ __('#ID') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Template Name') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Subject') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Status') }}</div>
                            </th>
                            <th class="w-110 text-center" scope="col">
                                <div>{{ __('Action') }}</div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Page content area end -->
    <!-- Add Modal section start -->
    <div class="modal fade zModalTwo" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">
                <form class="ajax reset" action="{{route('admin.subscription-email-template.store')}}" method="post"
                      data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body zModalTwo-body model-lg">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center pb-30">
                            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{__('Add Subscription Email Template')}}</h4>
                            <div class="mClose">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                        src="{{asset('assets/images/icon/delete.svg')}}" alt="" /></button>
                            </div>
                        </div>
                        <div class="row rg-25">
                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Template Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" name="category"
                                               placeholder="{{ __('Subscription email template name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Subject') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" name="subject"
                                               placeholder="{{ __('Subscription email template subject') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Body') }} <span
                                                class="text-danger">*</span></label>
                                        <textarea class="summernoteOne" name="body" id="body" placeholder="{{ __('Body') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="BatchName" class="form-label">{{ __('Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="primary-form-control sf-select-without-search" id="BatchName" name="status">
                                            <option value="{{STATUS_ACTIVE}}">{{ __('Active') }}</option>
                                            <option value="{{STATUS_PENDING}}">{{ __('Deactivated') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->
    <!-- Edit Modal section start -->
    <div class="modal fade zModalTwo" id="subscription-email-template-edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
    <!-- Template Modal view section start -->
    <div class="modal fade zModalTwo" id="subscription-email-template-view-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Template Modal view section end -->
    <input type="hidden" id="subscriptions-email-template-route" value="{{route('admin.subscription-email-template.list')}}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/subscription-email-template.js') }}"></script>
@endpush
