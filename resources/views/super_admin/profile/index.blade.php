@extends('super_admin.layouts.app')
@push('title')
    {{ __('Profile') }}
@endpush
@section('content')
    <!-- Content -->
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __('Settings') }}</h4>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Tab List -->
                <ul class="nav nav-tabs zTabHead" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="security-tab" data-bs-toggle="tab"
                                data-bs-target="#security-tab-pane" type="button" role="tab"
                                aria-controls="security-tab-pane" aria-selected="true">{{ __('Security') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="changePassword-tab" data-bs-toggle="tab"
                                data-bs-target="#changePassword-tab-pane" type="button" role="tab"
                                aria-controls="changePassword-tab-pane"
                                aria-selected="false">{{ __('Change Profile & Password') }}</button>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content zTabContent" id="myTabContent">
                    <div class="tab-pane fade show active" id="security-tab-pane" role="tabpanel"
                         aria-labelledby="security-tab" tabindex="0">
                        <div class="max-w-840">
                            <ul class="securityList">
                                <li class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <h4 class="fs-18 fw-500 lh-28 text-1b1c17">
                                            {{ __('Google Authentication (Recommended)') }}</h4>
                                        <p class="fs-14 fw-400 lh-22 text-707070">
                                            {{ __('Protect your account and transactions.') }}</p>
                                    </div>

                                    @if (auth()->user()->google_auth_status == 1)
                                        <button class="zBtn-one" data-bs-toggle="modal"
                                                data-bs-target="#googleAuthDisableModal">{{ __('Disable') }}</button>
                                    @else
                                        <button class="zBtn-one active" data-bs-toggle="modal"
                                                data-bs-target="#googleAuthEnableModal">{{ __('Enable') }}</button>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="changePassword-tab-pane" role="tabpanel"
                         aria-labelledby="changePassword-tab" tabindex="0">
                        <div class="max-w-840">
                            <form method="POST" enctype="multipart/form-data"
                                  action="{{ route('super_admin.profile.change-password.update') }}">
                                @csrf
                                <!-- Personal Info -->
                                <div class="pb-30">
                                    <h4 class="fs-18 fw-500 lh-22 text-1b1c17 pb-20">{{ __('Personal Info') }}</h4>
                                    <div class="row rg-25">
                                        <!-- Photo -->
                                        <div class="pb-40">
                                            <div class="upload-img-box profileImage-upload">
                                                <div class="icon"><img
                                                        src="{{ asset('assets/images/icon/edit-2.svg') }}"
                                                        alt=""/></div>
                                                <img src="{{ getFileUrl($user->image) }}"/>
                                                <input type="file" name="image" id="zImageUpload" accept="image/*"
                                                       onchange="previewFile(this)"/>
                                            </div>
                                        </div>
                                        <!-- Personal Info -->
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epFullName"
                                                           class="form-label">{{ __('Full Name') }}</label>
                                                    <input type="text" class="primary-form-control" id="epFullName"
                                                           value="{{ $user->name }}" name="name"
                                                           placeholder="{{ __('Your Name') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epFullName" class="form-label">{{ __('Email') }}</label>
                                                    <input type="email" class="primary-form-control" id="epFullName"
                                                           value="{{ $user->email }}" name="email"
                                                           placeholder="{{ __('Email') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contact Info -->
                                <div class="pb-30">
                                    <h4 class="fs-18 fw-500 lh-22 text-1b1c17 pb-20">{{ __('Change Password') }}</h4>
                                    <div class="row rg-25">
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epEmail" class="form-label">{{ __('Password') }}</label>
                                                    <input type="password" name="pass1"
                                                           class="primary-form-control" id="epEmail"
                                                           placeholder="{{ __('Password') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epEmail"
                                                           class="form-label">{{ __('Re Password') }}</label>
                                                    <input type="password" name="pass2"
                                                           class="primary-form-control" id="epEmail"
                                                           placeholder="{{ __('Re Enter Password') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="py-13 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{ __('Save Changes') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enable Authentication Modal -->
    <div class="modal fade zModalOne" id="googleAuthEnableModal" tabindex="-1"
         aria-labelledby="googleAuthEnableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalOne-content">
                <div class="modal-body zModalOne-body">
                    <!-- Left -->
                    <div class="left">
                        <div class="max-w-408">
                            <h4 class="fs-24 fw-500 lh-38 text-black pb-9">{{__('Enable 2FA Authentication')}}</h4>
                            <p class="fs-14 fw-400 lh-22 text-707070 pb-6"><span class="text-1b1c17 fw-700">{{__('Step 1')}}
                                    :</span> {{__('Install this app from')}}<a
                                    href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"
                                    target="__blank"
                                    class="text-1b1c17 text-decoration-underline fw-700">{{__('google play store')}}</a> {{__('or')}}
                                <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605"
                                   target="__blank"
                                   class="text-1b1c17 text-decoration-underline fw-700">{{__('App store')}}</a></p>
                            <p class="fs-14 fw-400 lh-22 pb-10"><span
                                    class="text-1b1c17 fw-700">{{__('Step 2 ')}}:</span> {{__('Scan the below QR code by your google authenticator app, or you can add account manually.')}}
                            </p>
                            <p class="fs-14 fw-700 lh-22 text-1b1c17 pb-10">{{__('Manually Add Account:')}}</p>
                            <p class="fs-14 fw-700 lh-22 text-1b1c17 pb-10">{{__('Account Name : ')}} {{ getOption('app_name') }}</p>
                            <p class="fs-14 fw-700 lh-22 text-1b1c17 pb-20">{{__('Key')}}
                                : {{ auth()->user()->google2fa_secret }}
                            </p>
                            <!-- Form -->
                            <form class="ajax reset" action="{{ route('google2fa.authenticate.enable') }}"
                                  method="post" data-handler="commonResponseForModal">
                                @csrf
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="authenticationCode"
                                               class="form-label">{{__('Enter google authenticator code')}}</label>
                                        <input required type="text" name="one_time_password"
                                               class="primary-form-control"
                                               id="authenticationCode"
                                               placeholder="{{ __('Enter the code to verify') }}"/>
                                    </div>
                                </div>
                                <button
                                    class="mt-20 bd-ra-12 bg-cdef84 border-0 fs-15 fw-500 hover-bg-one lh-25 px-26 py-13 text-black">{{__('Confirm 2FA')}}</button>
                            </form>
                            <p class="fs-15 fw-500 lh-25 text-ea4335 pt-20">{{__('Note : If you lost your phone or uninstall the
                                google authenticator app, then you will lost access of your account.')}}</p>
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="right">
                        <div class="mClose">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                    src="assets/images/icon/delete.svg" alt=""/></button>
                        </div>
                        <div class="qr-code text-center pt-76">
                            {!!$qr_code !!}
                            <img src="{{ $qr_code }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disable Authentication Modal -->
    <div class="modal fade zModalOne" id="googleAuthDisableModal" tabindex="-1"
         aria-labelledby="googleAuthDisableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalOne-content">
                <div class="modal-body p-4">
                    <div class="max-w-408">
                        <h4 class="fs-24 fw-500 lh-38 text-black pb-9">{{__('Disable 2FA Authentication')}}</h4>
                        <div class="card-body">
                            <form class="ajax reset" action="{{ route('google2fa.authenticate.disable') }}"
                                  method="post" data-handler="commonResponseForModal">
                                @csrf
                                <div class="pb-20 pt-10 primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="authenticationCodeDisable"
                                               class="form-label">{{ __('Enter google authenticator
                                                                                                                                                                                                                                                                                                                                                                                                                                                    code') }}</label>
                                        <input type="text" class="primary-form-control" name="one_time_password"
                                               id="authenticationCodeDisable"
                                               placeholder="{{ __('Enter the code to verify') }}"/>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="bd-ra-12 bg-cdef84 border-0 fs-15 fw-500 hover-bg-one lh-25 px-26 py-13 text-black">{{ __('Disable 2FA') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('admin/js/configuration.js') }}"></script>
@endpush
