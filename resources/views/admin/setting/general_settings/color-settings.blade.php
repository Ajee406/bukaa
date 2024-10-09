@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('super_admin/css/codemirror.css') }}"/>
    <link rel="stylesheet" href="{{ asset('super_admin/css/monokai.css') }}"/>
@endpush
@section('content')
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __($title) }}</h4>
            <div class="row rg-15">
                <div class="col-xxl-2 col-md-4 pr-0">
                    <div class="bd-c-ebedf0 bd-half bd-ra-25 bg-white h-100 p-30">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-md-8">

                    <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                        <div
                            class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                            <div class="item-top mb-30">
                                <h4>{{ $title }}</h4>
                            </div>
                            <form class="ajax" action="{{route('admin.setting.application-settings.update')}}"
                                  method="POST"
                                  enctype="multipart/form-data" data-handler="commonResponseForModal">
                                @csrf

                                <div class="item-top mb-30">
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="primary-form-group my-2 pt-3">
                                            <div class="primary-form-group-wrap">
                                                <label for="app_color_design_type"
                                                       class="form-label">{{ __('System Color') }}</label>
                                                <select name="app_color_design_type" id="app_color_design_type"
                                                        class="form-control sf-select-without-search" required>
                                                    <option value="{{ DEFAULT_COLOR }}"
                                                        {{ getOption('app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR ? 'selected' : '' }}>
                                                        {{ __('Default') }}</option>
                                                    <option value="{{ CUSTOM_COLOR }}"
                                                        {{ getOption('app_color_design_type', DEFAULT_COLOR) == CUSTOM_COLOR ? 'selected' : '' }}>
                                                        {{ __('Custom') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="row {{getOption('app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR ? 'd-none' : ''}}"
                                    id="custom-color-block">
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Primary Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="app_primary_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="app_primary_color"
                                                               value="{{getOption('app_primary_color', '#cdef84')}}"
                                                               id="app_primary_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Hover Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="app_hover_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="app_hover_color"
                                                               value="{{getOption('app_hover_color', '#afd449')}}"
                                                               id="app_hover_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Text Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="app_text_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="app_text_color"
                                                               value="{{getOption('app_text_color', '#1b1c17')}}"
                                                               id="app_text_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Text Secondary Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="app_text_secondary_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="app_text_secondary_color"
                                                               value="{{getOption('app_text_secondary_color', '#707070')}}"
                                                               id="app_text_secondary_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Sidebar BG Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="app_sidebar_bg_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="app_sidebar_bg_color"
                                                               value="{{getOption('app_sidebar_bg_color', '#1b1c17')}}"
                                                               id="app_sidebar_bg_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Sidebar Text Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="app_sidebar_text_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="app_sidebar_text_color"
                                                               value="{{getOption('app_sidebar_text_color', '#f6f5f5')}}"
                                                               id="app_sidebar_text_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input__group general-settings-btn text-end">
                                            <button type="submit"
                                                    class="bd-ra-12 bg-cdef84 border-0 fw-500 hover-bg-one lh-25 px-26 py-10 mt-2 float-right">{{__('Update')}}</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div class="item-top mb-30">
                                <hr>
                            </div>
                            <form class="ajax"
                                  action="{{route('admin.setting.application-settings.update')}}"
                                  method="POST"
                                  enctype="multipart/form-data" data-handler="commonResponseForModal">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                Custom CSS
                                            </div>
                                            <div class="card-body">
                                                <textarea name="custom_css" id="custom-css-editor">{{getOption('custom_css', '/*css code here*/ ')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input__group general-settings-btn text-end">
                                            <button type="submit"
                                                    class="bd-ra-12 bg-cdef84 border-0 fw-500 hover-bg-one lh-25 px-26 py-10 mt-2 float-right">{{__('Update')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="item-top mb-30">
                                <hr>
                            </div>
                            <form class="ajax"
                                  action="{{route('admin.setting.application-settings.update')}}"
                                  method="POST"
                                  enctype="multipart/form-data" data-handler="commonResponseForModal">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                Custom JS
                                            </div>
                                            <div class="card-body">
                                                <textarea name="custom_js"
                                                          id="custom-js-editor">{{getOption('custom_js', '//js code here')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input__group general-settings-btn text-end">
                                            <button type="submit"
                                                    class="bd-ra-12 bg-cdef84 border-0 fw-500 hover-bg-one lh-25 px-26 py-10 mt-2 float-right">{{__('Update')}}</button>
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
    <script src="{{ asset('super_admin/js/codemirror.js') }}"></script>
    <script src="{{ asset('super_admin/js/codemirror-mode.js') }}"></script>
    <script src="{{ asset('super_admin/js/codemirror-js-mode.js') }}"></script>
    <script>
        $(function () {
            //Get Value
            document.querySelectorAll('input[type=color]').forEach(function (picker) {
                //Target Point
                var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
                    codeArea = document.createElement('span');

                codeArea.innerHTML = picker.value;
                targetLabel.appendChild(codeArea);

                //Now AddEventListener
                picker.addEventListener('change', function () {
                    codeArea.innerHTML = picker.value;
                    targetLabel.appendChild(codeArea);
                });
            });
        })

        $(document).on('change', '#app_color_design_type', function () {
            if ($(this).val() == {{DEFAULT_COLOR}}) {
                $('#custom-color-block').addClass('d-none');
            } else {
                $('#custom-color-block').removeClass('d-none');
            }
        });

        CodeMirror.fromTextArea(document.getElementById("custom-css-editor"), {
            mode: "css",
            theme: "monokai"
        })

        CodeMirror.fromTextArea(document.getElementById("custom-js-editor"), {
            mode: "javascript",
            theme: "monokai",
        });

    </script>
@endpush
