@extends('layouts.app')
@push('title')
    {{ __('Profile') }}
@endpush
@section('content')
<div class="p-30">
    <div class="">
        <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __('Profile') }}</h4>
        <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
            <div class="tab-content" id="myTabContent">
                <div>
                    <div class="max-w-840">
                        <form method="POST" class="ajax" data-handler="commonResponseRedirect" data-redirect-url="{{route('admin.alumni.list-search-with-filter')}}"
                               action="{{ route('admin.alumni.profile-update') }}">
                        @csrf
                        <!-- Photo -->
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="pb-40"></div>
                            <!-- Personal Info -->
                            <div class="pb-30">
                                <h4 class="fs-18 fw-500 lh-22 text-1b1c17 pb-20">{{ __('Personal Info') }}</h4>
                                <div class="row rg-25">
                                    <!-- Photo -->
                                    <div class="pb-40">
                                        <div class="upload-img-box profileImage-upload">
                                            <div class="icon"><img src="{{asset("assets/images/icon/edit-2.svg")}}" alt=""/></div>
                                            <img src="{{ getFileUrl($user->image) }}"/>
                                            <input type="file" name="image" id="zImageUpload" accept="image/*,video/*"
                                                   onchange="previewFile(this)"/>
                                        </div>
                                    </div>
                                    <!-- Personal Info -->
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epFullName" class="form-label">{{ __('Full Name') }}</label>
                                                <input type="text" class="primary-form-control" id="epFullName"
                                                       value="{{ $user->name }}" name="name"
                                                       placeholder="{{ __('Your Name') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epNickName" class="form-label">{{ __('Nick Name') }}</label>
                                                <input type="text" class="primary-form-control" id="epNickName"
                                                       value="{{ $user->nick_name }}" name="nick_name"
                                                       placeholder="{{ __('Your Nick Name') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="blood_group" class="form-label">{{ __('Blood Group') }}<span
                                                        class="text-danger"> *</span></label>
                                                <select class="primary-form-control form-select" id="blood_group"
                                                        name="blood_group">
                                                    <option {{ $user->alumni?->blood_group == 'O-' ? 'selected' : '' }}
                                                            value="O-">O-
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'O+' ? 'selected' : '' }}
                                                            value="O+">O+
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'A−' ? 'selected' : '' }}
                                                            value="A−">A−
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'A+' ? 'selected' : '' }}
                                                            value="A+">A+
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'B−' ? 'selected' : '' }}
                                                            value="B−">B−
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'B+' ? 'selected' : '' }}
                                                            value="B+">B+
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'AB-' ? 'selected' : '' }}
                                                            value="AB-">AB−
                                                    </option>
                                                    <option {{ $user->alumni?->blood_group == 'AB+' ? 'selected' : '' }}
                                                            value="AB+">AB+
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="batch" class="form-label">{{ __('Batch') }}<span
                                                        class="text-danger"> *</span></label>
                                                <select class="primary-form-control form-select" id="batch_id" name="batch_id">
                                                    @foreach($batches as $batch)
                                                        <option value="{{ $batch->id }}" {{ $user->alumni->batch_id == $batch->id ? 'selected' : '' }}>
                                                            {{ $batch->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="department" class="form-label">{{ __('Departments') }}<span
                                                        class="text-danger"> *</span></label>
                                                <select class="primary-form-control form-select" id="department_id" name="department_id">
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" {{ $user->alumni->department_id == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="passing_year" class="form-label">{{ __('Passing Year') }}<span
                                                        class="text-danger"> *</span></label>
                                                <select class="primary-form-control form-select" id="passing_year_id" name="passing_year_id">
                                                    @foreach($passing_years as $passing_year)
                                                        <option value="{{ $passing_year->id }}" {{ $user->alumni->passing_year_id == $passing_year->id ? 'selected' : '' }}>
                                                            {{ $passing_year->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epBirthDate" class="form-label">{{ __('Birth Date')
                                                    }}</label>
                                                <input type="date" class="primary-form-control"
                                                       value="{{ $user->alumni?->date_of_birth }}" name="date_of_birth"
                                                       id="epBirthDate"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epAbout" class="form-label">{{ __('About Me') }}</label>
                                                <textarea class="primary-form-control min-h-180" id="epAbout"
                                                          name="about_me"
                                                          placeholder="{{ __('Type about yourself') }}">{!! $user->alumni?->about_me !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Info -->
                            <div class="pb-30">
                                <h4 class="fs-18 fw-500 lh-22 text-1b1c17 pb-20">{{ __('Contact Info') }}</h4>
                                <div class="row rg-25">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epPhoneNumber" class="form-label">{{ __('Phone Number')
                                                    }}</label>
                                                <input type="mobile" value="{{ $user->mobile }}" name="mobile"
                                                       class="primary-form-control" id="epPhoneNumber"
                                                       placeholder="eg: (+880) 1254 8593"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epEmail" class="form-label">{{ __('Personal Email Address')
                                                    }}</label>
                                                <input type="email" value="{{ $user->email }}" name="email" disabled
                                                       class="primary-form-control" id="epEmail"
                                                       placeholder="{{ __('Your Email') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epLinkedin" class="form-label">{{ 'Linkedin Url' }}</label>
                                                <input type="url" value="{{ $user->alumni?->linkedin_url }}"
                                                       name="linkedin_url" class="primary-form-control" id="epLinkedin"
                                                       placeholder="{{ __('Your Linkedin Profile Url') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epFacebook" class="form-label">{{ __('Facebook Url')
                                                    }}</label>
                                                <input type="url" value="{{ $user->alumni?->facebook_url }}"
                                                       name="facebook_url" class="primary-form-control" id="epFacebook"
                                                       placeholder="{{ __('Your Facebook Profile Url') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epTwitter" class="form-label">{{ __('Twitter Url')
                                                    }}</label>
                                                <input type="url" value="{{ $user->alumni?->twitter_url }}"
                                                       name="twitter_url" class="primary-form-control" id="epTwitter"
                                                       placeholder="{{ __('Your Twitter Profile Url') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epInstagram" class="form-label">{{ __('Instagram Url')
                                                    }}</label>
                                                <input type="url" value="{{ $user->alumni?->instagram_url }}"
                                                       name="instagram_url" class="primary-form-control"
                                                       id="epInstagram"
                                                       placeholder="{{ __('Your Instagram Profile Url') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Educational Info -->
                            <div class="pb-30" id="education-parent">
                                <div class="d-flex flex-column {{ count($user->institutions) ? 'rg-30' : '' }}">
                                    @forelse ($user->institutions as $institute)
                                        <div class="education-item">
                                            <input type="hidden" name="institution[id][]" value="{{ $institute->id }}">
                                            @if ($loop->first)
                                                <div
                                                    class="d-flex justify-content-between align-items-center flex-wrap g-10 pb-20">
                                                    <h4 class="fs-18 fw-500 lh-22 text-1b1c17">
                                                        {{ __('Educational Info') }}</h4>
                                                    <div class="d-flex align-items-center cg-16">
                                                        <button type="button"
                                                                class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-1b1c17 text-decoration-underline hover-color-one"
                                                                data-bs-toggle="modal" data-bs-target="#addMoreModal">{{ __('+Add
                                                    More') }}</button>
                                                        <button type="button"
                                                                class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-ed0006 text-decoration-underline hover-color-one delete-education">{{
                                                    __('Delete') }}</button>
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="d-flex justify-content-end align-items-center flex-wrap g-10 pb-20">
                                                    <div class="d-flex align-items-center cg-16">
                                                        <button type="button"
                                                                class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-ed0006 text-decoration-underline hover-color-one delete-education">{{
                                                    __('Delete') }}</button>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row rg-25">
                                                <div class="col-md-6">
                                                    <div class="primary-form-group">
                                                        <div class="primary-form-group-wrap">
                                                            <label for="epDegree" class="form-label">{{ __('Degree')
                                                            }}</label>
                                                            <input type="text" value="{{ $institute->degree }}"
                                                                   name="institution[degree][]"
                                                                   class="institution-degree primary-form-control"
                                                                   id="epDegree" placeholder="{{ __('Your Degree') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="primary-form-group">
                                                        <div class="primary-form-group-wrap">
                                                            <label for="epPassingYear" class="form-label">{{ __('Passing
                                                            Year') }}</label>
                                                            <input type="text" value="{{ $institute->passing_year }}"
                                                                   name="institution[passing_year][]"
                                                                   class="institution-passing_year primary-form-control"
                                                                   id="epPassingYear"
                                                                   placeholder="{{ __('Passing Year') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="primary-form-group">
                                                        <div class="primary-form-group-wrap">
                                                            <label for="epInstitute" class="form-label">{{ __('Institute')
                                                            }}</label>
                                                            <input type="text" value="{{ $institute->institute }}"
                                                                   name="institution[institute][]"
                                                                   class="institution-institute primary-form-control"
                                                                   id="epInstitute"
                                                                   placeholder="{{ __('Your Institution') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div
                                            class="d-flex justify-content-between align-items-center flex-wrap g-10 pb-20">
                                            <h4 class="fs-18 fw-500 lh-22 text-1b1c17">{{ __('Educational Info') }}
                                            </h4>
                                            <div class="d-flex align-items-center cg-16">
                                                <button type="button"
                                                        class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-1b1c17 text-decoration-underline hover-color-one"
                                                        data-bs-toggle="modal" data-bs-target="#addMoreModal">{{ __('+Add New')
                                                }}</button>
                                            </div>
                                        </div>
                                        <div class="">
                                            <span>{{ __('No Educational Info Found') }}</span>
                                        </div>
                                    @endforelse
                                </div>
                                <div id="education-child-empty" class="d-none d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap g-10 pb-20">
                                        <h4 class="fs-18 fw-500 lh-22 text-1b1c17">{{ __('Educational Info') }}</h4>
                                        <div class="d-flex align-items-center cg-16">
                                            <button type="button"
                                                    class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-1b1c17 text-decoration-underline hover-color-one"
                                                    data-bs-toggle="modal" data-bs-target="#addMoreModal">{{ __('+Add New')
                                                }}</button>
                                        </div>
                                    </div>
                                    <div class="">
                                        <span>{{ __('No Educational Info Found') }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Professional Info -->
                            <div class="pb-30">
                                <h4 class="fs-18 fw-500 lh-22 text-1b1c17 pb-20">{{ __('Professional Info') }}</h4>
                                <div class="row rg-25">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epCompanyName" class="form-label">{{ __('Company Name')
                                                    }}</label>
                                                <input type="text" value="{{ $user->alumni?->company }}" name="company"
                                                       class="primary-form-control" id="epCompanyName"
                                                       placeholder="{{ __('Your Current Company') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epDesignation" class="form-label">{{ __('Designation')
                                                    }}</label>
                                                <input type="text" value="{{ $user->alumni?->company_designation }}"
                                                       name="company_designation" class="primary-form-control"
                                                       id="epDesignation"
                                                       placeholder="{{ __('Your Current Designation') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epCompanyAddress" class="form-label">{{ __('Address')
                                                    }}</label>
                                                <input type="text" value="{{ $user->alumni?->company_address }}"
                                                       name="company_address" class="primary-form-control"
                                                       id="epCompanyAddress"
                                                       placeholder="{{ __('Your Company Address') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="pb-30">
                                <h4 class="fs-18 fw-500 lh-22 text-1b1c17 pb-20">{{ __('Address') }}</h4>
                                <div class="row rg-25">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epCity" class="form-label">{{ __('City') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="primary-form-control"
                                                       value="{{ $user->alumni?->city }}" name="city" id="epCity"
                                                       placeholder="{{ __('Current Company City') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epCity" class="form-label">{{ __('State') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="primary-form-control"
                                                       value="{{ $user->alumni?->state }}" name="state" id="epCity"
                                                       placeholder="{{ __('Current Company State') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epCountry" class="form-label">{{ __('Country') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="{{ $user->alumni?->country }}" name="country"
                                                       class="primary-form-control" id="epCountry"
                                                       placeholder="{{ __('Current Company Country') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epZipCode" class="form-label">{{ __('Zip Code') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="{{ $user->alumni?->zip }}" name="zip"
                                                       class="primary-form-control" id="epZipCode"
                                                       placeholder="{{ __('Current Company Zip Code') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epAddress" class="form-label">{{ __('Address') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="{{ $user->alumni?->address }}" name="address"
                                                       class="primary-form-control" id="epAddress"
                                                       placeholder="{{ __('Current Company Address') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                    class="py-13 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{
                                __('Save Changes') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade zModalTwo" id="addMoreModal" tabindex="-1" aria-labelledby="addMoreModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content zModalTwo-content">
            <div class="modal-body zModalTwo-body">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center pb-30">
                    <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{ __('Add Info') }}</h4>
                    <div class="mClose">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                src="{{ asset('assets/images/icon/delete.svg') }}" alt="" /></button>
                    </div>
                </div>
                <!-- Body -->
                <form method="POST" class="ajax" data-handler="commonResponseForModal"
                      action="{{ route('admin.alumni.institution-store') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="hidden" name="tenant_id" value="{{$user->tenant_id}}">
                    <div class="pb-25">
                        <div class="row rg-25">
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="epDegree1" class="form-label">{{ __('Degree') }}</label>
                                        <input type="text" class="primary-form-control" id="epDegree1" name="degree"
                                               placeholder="{{ __('Your Degree') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="epInstitute" class="form-label">{{ __('Institution') }}</label>
                                        <input type="text" class="primary-form-control" id="epInstitute"
                                               name="institute" placeholder="{{ __('Your Institution') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="epPassingYear1" class="form-label">{{ __('Passing Year') }}</label>
                                        <input type="text" class="primary-form-control" id="epPassingYear1"
                                               name="passing_year" placeholder="{{ __('Your Passing Year') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                            class="py-13 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{
                        __('Save Now') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="{{ asset('alumni/js/profile.js') }}"></script>
@endpush

