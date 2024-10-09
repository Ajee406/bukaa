@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __($title) }}</h4>
            <div class="bd-c-ebedf0 bd-half bd-ra-25 bg-white h-100 p-30">
                <div class="row">
                    <input type="hidden" id="batch-route" value="{{ route('admin.setting.batches.index') }}">
                    <div class="col-lg-12">
                        <div class="customers__area bg-style mb-30">
                            <div class="d-flex flex-wrap item-title justify-content-end">
                                <div class="mb-3">
                                    <button
                                        class="border-0 fs-15 fw-500 lh-25 text-black py-10 px-26 bg-cdef84 bd-ra-12 hover-bg-one"
                                        type="button" data-bs-toggle="modal" data-bs-target="#add-modal">
                                        <i class="fa fa-plus"></i> {{ __('Add New') }}
                                    </button>
                                </div>
                            </div>
                            <div class="customers__table">
                                <div class="table-responsive zTable-responsive">
                                    <table class="table zTable" id="batchDataTable">
                                        <thead>
                                        <tr>
                                            <th scope="col">
                                                <div>{{ __('SL#') }}</div>
                                            </th>
                                            <th scope="col">
                                                <div>{{ __('Name') }}</div>
                                            </th>
                                            <th scope="col" class="text-end">
                                                <div>{{ __('Action') }}</div>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal section start -->
    <div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Batch') }}</h5>
                    <button type="button" class="border-0 btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form class="ajax reset" action="{{ route('admin.setting.batches.store') }}" method="post"
                      data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="primary-form-group mt-2">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" name="name" required
                                               placeholder="{{ __('Name') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="fs-15 fw-500 lh-25 text-black py-10 border-0 px-26 bg-cdef84 bd-ra-12 hover-bg-one">{{
                        __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->
    <!-- Edit Modal section start -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection
@push('script')
    <script src="{{asset('admin/js/batches.js')}}"></script>
@endpush

