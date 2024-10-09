@extends('layouts.app')

@push('title')
    {{$title}}
@endpush

@section('content')

    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <input type="hidden" id="moderator-list-route" value="{{ route('admin.moderators.index') }}">
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{$title}}</h4>
                <button type="submit"
                        class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one"
                        data-bs-toggle="modal" data-bs-target="#add-modal"><i class="fa fa-plus"></i> {{ __('Add New')
                }}</button>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="moderatorDataTable">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div>{{ __('Name') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Email') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Status') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Roles') }}</div>
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
    <!-- Page content area End -->


    <!-- Add Modal section start -->
    <div class="modal fade fade zModalTwo" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">

                <form class="ajax reset" action="{{ route('admin.moderators.store') }}" method="post"
                      data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body zModalTwo-body model-lg">
                        <div class="d-flex justify-content-between align-items-center pb-30">
                            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{__('Add New')}}</h4>
                            <div class="mClose">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                        src="{{asset('assets/images/icon/delete.svg')}}" alt=""/></button>
                            </div>
                        </div>
                        <div class="row rg-25">
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="name" class="form-label">{{ __('Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" id="name" name="name"
                                               placeholder="{{ __('Name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="email" class="form-label">{{ __('Email') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="primary-form-control" id="email" name="email"
                                               placeholder="{{ __('Email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="mobile" class="form-label">{{ __('Mobile') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" id="mobile" name="mobile"
                                               placeholder="{{ __('Mobile') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="password" class="form-label">{{ __('Password') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="primary-form-control" id="password"
                                               name="password"
                                               placeholder="{{ __('password') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="Status" class="form-label">{{ __('Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="primary-form-control sf-select-without-search" id="Status"
                                                name="status">
                                            <option value="1">{{ __('Active') }}</option>
                                            <option value="0">{{ __('Deactivate') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="currency_code" class="form-label">{{ __('Assign Role') }}
                                            <span class="text-danger">*</span></label>
                                        <select id="roles" class="primary-form-control roles" name="roles[]" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{
                        __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->

    <!-- Edit Modal section start -->
    <div class="modal fade fade fade zModalTwo " id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection

@push('script')
    <script src="{{ asset('admin/js/moderators.js') }}"></script>
@endpush
