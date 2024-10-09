<form class="ajax reset" action="{{ route('admin.moderators.update', $user->id) }}" method="post"
    data-handler="commonResponseForModal">
    @csrf
    <div class="modal-body zModalTwo-body model-lg">
        <div class="d-flex justify-content-between align-items-center pb-30">
            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{__('Update New')}}</h4>
            <div class="mClose">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{asset('assets/images/icon/delete.svg')}}" alt="" /></button>
            </div>
        </div>
        <div class="row rg-25">
            <div class="col-md-6">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="name" class="form-label">{{ __('Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" value="{{$user->name}}" class="primary-form-control" id="name" name="name"
                               placeholder="{{ __('Name') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="email" class="form-label">{{ __('Email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" value="{{$user->email}}" class="primary-form-control" id="email" name="email"
                               placeholder="{{ __('Email') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="mobile" class="form-label">{{ __('Mobile') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" value="{{$user->mobile}}" class="primary-form-control" id="mobile" name="mobile"
                               placeholder="{{ __('Mobile') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
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
                            <option {{ $user->status == STATUS_ACTIVE ? 'selected' : '' }} value="1">{{ __('Active') }}</option>
                            <option {{ $user->status == STATUS_PENDING ? 'selected' : '' }} value="0">{{ __('Deactivate') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="roles_edit" class="form-label">{{ __('Assign Role') }}
                            <span class="text-danger">*</span></label>
                        <select id="roles_edit" class="primary-form-control roles" name="roles[]" multiple>
                            @foreach ($roles as $role)
                                <option {{ in_array($role->name, $user->roles()->pluck('name')->toArray()) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit"
            class="border-0 d-none d-sm-inline-block fs-15 fw-500 lh-25 text-black py-10 px-26 bg-cdef84 bd-ra-12 hover-bg-one">{{
            __('Update') }}</button>
    </div>
</form>
