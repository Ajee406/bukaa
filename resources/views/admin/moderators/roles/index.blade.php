@extends('layouts.app')
@push('title')
    {{$title}}
@endpush
@section('content')

    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{$title}}</h4>
                <button type="submit"
                        class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one"
                        data-bs-toggle="modal"
                        data-bs-target="#add-modal"><i class="fa fa-plus"></i> {{ __('Add New') }}</button>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="rolesDataTable">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div>{{ __('#SL') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Name') }}</div>
                            </th>
                            <th scope="col">
                                <div>{{ __('Status') }}</div>
                            </th>
                            <th class="w-110 text-center" scope="col">
                                <div>{{ __('Action') }}</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>
                                    @if ($role->status == 1)
                                        <span
                                            class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">{{__('Active')}}</span>
                                    @else
                                        <span class="zBadge-free">{{__('Deactivate')}}</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="d-flex align-items-center cg-5 justify-content-center">
                                        <li class="d-flex gap-2">
                                            <button onclick="getEditModal('{{route('admin.roles.edit', $role->id)}}', '#edit-modal')"
                                                    class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white"
                                                    data-bs-toggle="modal" data-bs-target="#alumniPhoneNo"
                                                    title="'.__('Edit').'">
                                                <img src="{{asset('assets/images/icon/edit.svg')}}" alt="edit"/>
                                            </button>
                                            <button onclick="deleteItem('{{ route('admin.roles.destroy', [$role->id]) }}')"
                                                    class="d-flex justify-content-center align-items-center w-30 h-30 rounded-circle bd-one bd-c-ededed bg-white"
                                                    title="'.__('Delete').'">
                                                <img src="{{asset('assets/images/icon/delete-1.svg')}}" alt="delete">
                                            </button>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <!-- Add Modal section start -->
    <div class="modal zModalTwo" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">
                <form class="ajax reset" action="{{ route('admin.roles.store') }}" method="post"
                      data-handler="commonResponseWithPageLoad">
                    @csrf
                    <div class="modal-body zModalTwo-body">
                        <div class="d-flex justify-content-between align-items-center pb-30">
                            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{__('Add New')}}</h4>
                            <div class="mClose">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                        src="{{asset('assets/images/icon/delete.svg')}}" alt=""/></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="primary-form-group mt-2">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group my-2 pt-3">
                                    <div class="primary-form-group-wrap">
                                        <label for="BatchName" class="form-label">{{ __('Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="primary-form-control sf-select-without-search" id="BatchName"
                                                name="status">
                                            <option value="1">{{ __('Active') }}</option>
                                            <option value="0">{{ __('Deactivate') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                <div class="row">
                                    <dic class="col-ms-12 mb-10">
                                        <h5 class="border-bottom pb-1">Permissions</h5>
                                    </dic>
                                    <div class="align-items-center col-md-12 d-flex flex-wrap gap-2">
                                        @foreach($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$permission->name}}" name="permissions[]" id="permission-{{$permission->id}}">
                                                <label class="form-check-label" for="permission-{{$permission->id}}">
                                                    {{$permission->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->

    <!-- Edit Modal section start -->
    <div class="modal zModalTwo" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection

@push('script')
    <script src="{{ asset('admin/js/roles.js') }}"></script>
@endpush
