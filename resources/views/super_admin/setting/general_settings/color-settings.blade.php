@extends('super_admin.layouts.app')
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
                        @include('super_admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-md-8">

                    <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                        <div
                            class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                            <div class="item-top mb-30">
                                <h4>{{ $title }}</h4>
                            </div>
                            <form class="ajax"
                                  action="{{route('saas.super_admin.frontend-setting.application-settings.update')}}"
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
                                                <label for="sa_app_color_design_type"
                                                       class="form-label">{{ __('System Color') }}</label>
                                                <select name="sa_app_color_design_type" id="sa_app_color_design_type"
                                                        class="form-control sf-select-without-search" required>
                                                    <option value="{{ DEFAULT_COLOR }}"
                                                        {{ getOption('sa_app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR ? 'selected' : '' }}>
                                                        {{ __('Default') }}</option>
                                                    <option value="{{ CUSTOM_COLOR }}"
                                                        {{ getOption('sa_app_color_design_type', DEFAULT_COLOR) == CUSTOM_COLOR ? 'selected' : '' }}>
                                                        {{ __('Custom') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="row {{getOption('sa_app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR ? 'd-none' : ''}}"
                                    id="custom-color-block">
                                    <div class="col-xxl-2 col-lg-6">
                                        <div class="sf-new-color-wrap">
                                            <div class="primary-form-group my-2 pt-3">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Primary Color') }} <span
                                                            class="text-danger">*</span></label>
                                                    <label for="sa_app_primary_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_primary_color"
                                                               value="{{getOption('sa_app_primary_color', '#cdef84')}}"
                                                               id="sa_app_primary_color">
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
                                                    <label for="sa_app_hover_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_hover_color"
                                                               value="{{getOption('sa_app_hover_color', '#afd449')}}"
                                                               id="sa_app_hover_color">
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
                                                    <label for="sa_app_text_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_text_color"
                                                               value="{{getOption('sa_app_text_color', '#1b1c17')}}"
                                                               id="sa_app_text_color">
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
                                                    <label for="sa_app_text_body_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_text_body_color"
                                                               value="{{getOption('sa_app_text_color', '#707070')}}"
                                                               id="sa_app_text_body_color">
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
                                                    <label for="sa_app_sidebar_bg_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_sidebar_bg_color"
                                                               value="{{getOption('sa_app_sidebar_bg_color', '#1b1c17')}}"
                                                               id="sa_app_sidebar_bg_color">
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
                                                    <label for="sa_app_sidebar_text_color" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_sidebar_text_color"
                                                               value="{{getOption('sa_app_sidebar_text_color', '#f6f5f5')}}"
                                                               id="sa_app_sidebar_text_color">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6">
                                        <span
                                            class="color-picker d-flex flex-wrap sf-new-color-wrap sf-new-color-wrap-2">
                                            <div class="primary-form-group my-2 pt-3 w-100">
                                                 <label for="sa_app_timezone" class="form-label">{{ __('Landing Header/Footer') }} <span
                                                         class="text-danger">*</span></label>
                                                <div class="primary-form-group-wrap">
                                                    <label for="sa_app_gradiant1_color1" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_app_gradiant1_color1"
                                                               value="{{  getOption('sa_app_gradiant1_color1', '#1b1c17') }}"
                                                               id="sa_app_gradiant1_color1">
                                                    </label>
                                                    <label for="sa_app_gradiant1_color2" class="mb-0">
                                                        <input class="color6 primary-form-control" type="color"
                                                               name="sa_app_gradiant1_color2"
                                                               value="{{  getOption('sa_app_gradiant1_color2', '#0fa958') }}"
                                                               id="sa_app_gradiant1_color2">
                                                    </label>
                                                </div>
                                            </div>
                                        </span>

                                        <div id="sa_gradient1" class="p-5">
                                            <input class="sa_gradiant1_color" type="hidden"
                                                   name="sa_gradiant1_color"
                                                   id="sa_gradiant1_color"
                                                   value="{{ getOption('sa_gradiant1_color', 'radial-gradient( circle, #1b1c17 -60.43%, #1b1c17 19.49%, #1b1c17 50%, #0fa958 410%)') }}">
                                            <h2 class="text-white">{{ __('Current CSS Background') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6">
                                        <span
                                            class="color-picker d-flex flex-wrap sf-new-color-wrap sf-new-color-wrap-2">
                                            <div class="primary-form-group my-2 pt-3 w-100">
                                                 <label for="app_timezone" class="form-label">{{ __('Landing Middle') }} <span
                                                         class="text-danger">*</span></label>
                                                <div class="primary-form-group-wrap">
                                                    <label for="sa_inner_gradient_color_1" class="mb-0">
                                                        <input class="color5 primary-form-control" type="color"
                                                               name="sa_inner_gradient_color_1"
                                                               value="{{  getOption('sa_inner_gradient_color_1', '#1b1c17') }}"
                                                               id="sa_inner_gradient_color_1">
                                                    </label>
                                            <label for="sa_inner_gradient_color_2" class="mb-0">
                                                <input class="color6 primary-form-control" type="color"
                                                       name="sa_inner_gradient_color_2"
                                                       value="{{  getOption('sa_inner_gradient_color_2', '#1ad717') }}"
                                                       id="sa_inner_gradient_color_2">
                                            </label>
                                                </div>
                                            </div>
                                        </span>

                                        <div id="sa_inner-gradient" class="p-5">
                                            <input class="sa_inner_gradient_color" type="hidden"
                                                   name="sa_inner_gradient_color"
                                                   id="sa_inner_gradient_color"
                                                   value="{{  getOption('sa_inner_gradient_color', 'linear-gradient(180deg, #1b1c17 0%, #1ad717 900%)') }}">
                                            <h2 class="text-white">{{ __('Current CSS Background') }}</h2>
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
                                  action="{{route('saas.super_admin.frontend-setting.application-settings.update')}}"
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
                                                <textarea name="sa_custom_css" id="custom-css-editor">{{getOption('sa_custom_css', '/*css code here*/')}}</textarea>
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
                                  action="{{route('saas.super_admin.frontend-setting.application-settings.update')}}"
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
                                                <textarea name="sa_custom_js"
                                                          id="custom-js-editor">{{getOption('sa_custom_js', '//js code here')}}</textarea>
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

            var color1 = document.querySelector("#sa_app_gradiant1_color1");
            var color2 = document.querySelector("#sa_app_gradiant1_color2");
            var div = document.getElementById("sa_gradient1");

            var color5 = document.querySelector("#sa_inner_gradient_color_1");
            var color6 = document.querySelector("#sa_inner_gradient_color_2");
            var div3 = document.getElementById("sa_inner-gradient");

            setGradient()
            setGradient3()

            function setGradient() {
                var textContent = "radial-gradient(circle, " + color1.value + " -60.43%, " + color1.value + " 19.49%, " + color1.value + " 50%, " + color2.value + " 410%)"
                div.style.background = textContent;
                $('#sa_gradiant1_color').val(textContent);
            }

            function setGradient3() {
                var textContent3 = "linear-gradient(180deg, " + color5.value + " 0%, " + color6.value + " 900%)"
                div3.style.background = textContent3;
                $('#sa_inner_gradient_color').val(textContent3);
            }

            color1.addEventListener("input", setGradient);
            color2.addEventListener("input", setGradient);

            color5.addEventListener("input", setGradient3);
            color6.addEventListener("input", setGradient3);
        })

        $(document).on('change', '#sa_app_color_design_type', function () {
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
