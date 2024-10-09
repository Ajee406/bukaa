@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __($title) }}</h4>
            <div class="row">
                <div class="col-12">
                    <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                        <div
                            class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                            <form class="ajax" action="{{ route('admin.setting.registration-form-setting-store') }}"
                                  method="POST" enctype="multipart/form-data" data-handler="settingCommonHandler">
                                @csrf
                                <div class="bd-c-ebedf0 bd-half bd-ra-25 bg-white mb-20 p-30 rg-15 row">
                                    <div class="col-xxl-12">
                                        <div class="bd-b-one bd-c-black-5 d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Select Batch')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('Those options will come from the
                                                    batch settings.')}})</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" {{$regForm->enable_batch ? 'checked' : ''}} value="1" name="enable_batch"
                                                       type="checkbox" role="switch" id="enable_batch">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="bd-b-one bd-c-black-5 d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Select Department')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('Those options will come from the
                                                    department settings.')}})</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" value="1" name="enable_department"
                                                       type="checkbox" role="switch" {{$regForm->enable_department ? 'checked' : ''}} id="enable_department">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="bd-b-one bd-c-black-5 d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Select Passing Year')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('Those options will come from the
                                                    passing year settings.')}})</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" value="1" name="enable_passing_year"
                                                       type="checkbox" role="switch" {{$regForm->enable_passing_year ? 'checked' : ''}} id="enable_passing_year">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="bd-b-one bd-c-black-5 d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Input Role Number')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('A input field to take the alumni
                                                    role number')}} )</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" value="1" name="enable_role_number"
                                                       type="checkbox" role="switch" {{$regForm->enable_role_number ? 'checked' : ''}} id="enable_role_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="bd-b-one bd-c-black-5 d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Attachment')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('A attachment filed to take any required attachment.')}} )</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" value="1" name="enable_attachment"
                                                       type="checkbox" role="switch" {{$regForm->enable_attachment ? 'checked' : ''}} id="enable_attachment">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="bd-b-one bd-c-black-5 d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Date Of Birth')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('A date field to take date of birth input.')}} )</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" value="1" name="enable_date_of_birth"
                                                       type="checkbox" role="switch" {{$regForm->enable_date_of_birth ? 'checked' : ''}} id="enable_date_of_birth">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="d-flex justify-content-between pb-10">
                                            <div>
                                                <h6>{{__('Gender')}}</h6>
                                                <small class="fst-italic fw-normal">({{__('Those options will show the gender list')}})</small>
                                            </div>
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0" value="1" name="enable_gender"
                                                       type="checkbox" role="switch" {{$regForm->enable_gender ? 'checked' : ''}} id="enable_gender">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rg-15 row bg-white bd-half bd-c-ebedf0 bd-ra-25 p-3">
                                    <div class="col-lg-12">
                                        <h5 class="fs-24 fw-500 lh-34 text-1b1c17">{{__('Extra Fields')}}</h5>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div id="form-builder-form" class="sf-sortable-form"></div>
                                        <input type="hidden" name="custom_fields">
                                    </div>
                                </div>
                                <div class="mt-30 row">
                                    <div class="col-12">
                                        <div class="input__group general-settings-btn text-end">
                                            <button id="reg-form-save-btn" type="submit"
                                                    class="bd-ra-12 bg-cdef84 border-0 fw-500 hover-bg-one lh-25 px-26 py-10">{{ __('Update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var editFields = {!! $regForm->custom_fields ?? "{}" !!};
    </script>
    <script src="{{ asset('admin/js/registration-form-settings.js') }}"></script>
@endpush
