@extends('frontend.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')

    <section class="breadcrumb-wrap py-50 py-md-75 py-lg-100" data-background="{{getSettingImage('page_breadcrumb')}}">
        <div class="text-center position-relative">
            <h4 class="fs-50 fw-700 lh-60 text-white pb-8">{{$title}}</h4>
            <ul class="breadcrumb-list">
                <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
                <li><a href="{{route('our.news')}}">{{$title}}</a></li>
            </ul>
        </div>
    </section>

    <section class="pb-110 pt-60 bg-event-bg donationDetails-section">
        <div class="container">
            <div class="pb-50">
                <!--  -->
                <div class="pb-40 d-flex justify-content-between align-items-center flex-wrap g-20">
                    <!--  -->
                    <div class="d-flex align-items-center flex-wrap g-20">
                        <div
                            class="flex-shrink-0 w-110 h-110 rounded-circle bd-four bd-c-primary-color overflow-hidden">
                            <img src="{{asset('frontend/images/alumni-img-1.png')}}" alt=""></div>
                        <div class="">
                            <h4 class="fs-36 fw-500 lh-34 text-text-black pb-11">Azmain Anam Sharif </h4>
                            <p class="fs-18 fw-400 lh-17 text-para-color">Vice President</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="">
                        <h4 class="fs-18 fw-500 lh-24 text-text-black ls-60 pb-9">SHARE:</h4>
                        <ul class="d-flex align-items-center flex-wrap g-7">
                            <li>
                                <a target="__blank" href="#"
                                   class="d-flex justify-content-center align-items-center w-50 h-50 bd-one bd-c-stroke-color rounded-circle bg-white hover-bg-color-primary hover-border-color-primary">
                                    <img src="{{asset('frontend/images/icon/facebook.svg')}}" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a target="__blank" href="#"
                                   class="d-flex justify-content-center align-items-center w-50 h-50 bd-one bd-c-stroke-color rounded-circle bg-white hover-bg-color-primary hover-border-color-primary">
                                    <img src="{{asset('frontend/images/icon/twitter.svg')}}" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a target="__blank" href="#"
                                   class="d-flex justify-content-center align-items-center w-50 h-50 bd-one bd-c-stroke-color rounded-circle bg-white hover-bg-color-primary hover-border-color-primary">
                                    <img src="{{asset('frontend/images/icon/instagram.svg')}}" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a target="__blank" href="#"
                                   class="d-flex justify-content-center align-items-center w-50 h-50 bd-one bd-c-stroke-color rounded-circle bg-white hover-bg-color-primary hover-border-color-primary">
                                    <img src="{{asset('frontend/images/icon/linkedin.svg')}}" alt=""/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="pb-47">
                    <div class="election-date-wrap">
                        <div class="row rg-0">
                            <div class="col-lg-5">
                                <div class="election-date-left">
                                    <div class="graphic-1">
                                        <img src="{{asset('frontend/images/election-shape-1.svg')}}" alt="">
                                    </div>
                                    <div class="graphic-2">
                                        <img src="{{asset('frontend/images/election-shape-2.svg')}}" alt="">
                                    </div>
                                    <div class="flag">
                                        <img src="{{asset('frontend/images/election-flag.svg')}}" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="date">12/10/2024</h4>
                                        <p class="fs-18 fw-500 text-white">ELECTION DATE</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="election-date-right">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="electionNameCommittee-item">
                                                <h4 class="title">Election Name</h4>
                                                <p class="info">Executive Committee Selection </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="electionNameCommittee-item electionNameCommittee-item-2">
                                                <h4 class="title">Committee Name</h4>
                                                <p class="info">Awami League United Kingdom</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row rg-24">
                    <div class="col-lg-7 col-md-6">
                        <div class="p-sm-25 p-15 bd-ra-25 bg-white h-100">
                            <div class="pb-25 mb-25 bd-b-one bd-c-stroke-color">
                                <h4 class="fs-18 fw-500 lh-22 text-text-black pb-10">{{ __('Profile Bio') }}</h4>
                                <p class="fs-14 fw-400 lh-24 text-para-color pb-12">I am based in Miami, Florida USA and
                                    am a Business Entrepreneur with proven talent for driving website traffic along with
                                    a superior quality deliverable.A keen acumen and web building spirit help me in
                                    providing impeccable customer service for your personal or business website. </p>
                                <p class="fs-14 fw-400 lh-24 text-para-color">There are many variations of passages of
                                    Lorem Ipsum available, but the majority have suffered alteration in some form by
                                    injected humour.</p>
                            </div>
                            <!-- Personal Info -->
                            <ul class="zList-one">
                                <li>
                                    <p>{{ __('Full Name') }} :</p>
                                    <p>Azmain Anam Sharif</p>
                                </li>
                                <li>
                                    <p>{{ __('Email') }} :</p>
                                    <p>azmain880@gmail.com</p>
                                </li>
                                <li>
                                    <p>{{ __('Blood Group') }} :</p>
                                    <p>O+</p>
                                </li>
                                <li>
                                    <p>{{ __('Date of Birth') }} :</p>
                                    <p>12/08/23</p>
                                </li>
                                <li>
                                    <p>{{ __('City') }} :</p>
                                    <p>Khulna</p>
                                </li>
                                <li>
                                    <p>{{ __('Country') }} :</p>
                                    <p>Bangladesh</p>
                                </li>
                                <li>
                                    <p>{{ __('Zip Code') }} :</p>
                                    <p>5216</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="p-sm-25 p-15 bd-ra-25 bg-white h-100">
                            <div class="pb-25 mb-25 bd-b-one bd-c-stroke-color">
                                <h4 class="fs-18 fw-500 lh-22 text-text-black pb-10">{{ __('Educational Info') }}</h4>
                                <div class="pb-25">
                                    <p class="fs-14 fw-400 lh-17 text-para-color pb-10">Higher secondary certificate</p>
                                    <ul class="zList-one">
                                        <li>
                                            <p>{{ __('Degree') }} :</p>
                                            <p>BBA</p>
                                        </li>
                                        <li>
                                            <p>{{ __('Passing Year') }} :</p>
                                            <p>2019</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="">
                                    <p class="fs-14 fw-400 lh-17 text-para-color pb-10">Secondary School certificate</p>
                                    <ul class="zList-one">
                                        <li>
                                            <p>{{ __('Degree') }} :</p>
                                            <p>BBA</p>
                                        </li>
                                        <li>
                                            <p>{{ __('Passing Year') }} :</p>
                                            <p>2019</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="">
                                <h4 class="fs-18 fw-500 lh-22 text-text-black pb-10">{{ __('Professional Info') }}</h4>
                                <ul class="zList-one">
                                    <li>
                                        <p>{{ __('Company Name') }} :</p>
                                        <p>Zainiklab</p>
                                    </li>
                                    <li>
                                        <p>{{ __('Designation') }} :</p>
                                        <p>Software Engineer</p>
                                    </li>
                                    <li>
                                        <p>{{ __('Office Address') }} :</p>
                                        <p>Gulsan 02, Dhaka</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Comments -->
            <h4 class="fs-36 fw-600 lh-46 text-text-black pb-25">Comments (02)</h4>
            <div class="bg-white px-lg-60 px-md-30 py-sm-34 p-15 bd-ra-25 bd-one bd-c-black-10">
                <div class="donation-comments-wrap">
                    <ul class="donation-comments">
                        <li>
                            <div class="d-flex align-items-start g-12">
                                <div class="flex-shrink-0 w-30 h-30 overflow-hidden rounded-circle">
                                    <img src="{{asset('frontend/images/news-user.png')}}" alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="py-9 px-15 bd-one bd-c-text-black-10 bd-ra-6">
                                        <div class="d-flex align-items-center g-14 pb-14">
                                            <h4 class="fs-18 fw-500 lh-22 text-text-black">Eva P</h4>
                                        </div>
                                        <div class="d-flex flex-column g-14">
                                            <p class="fs-15 fw-400 lh-18 text-para-color">Hello Arash,</p>
                                            <p class="fs-15 fw-400 lh-18 text-para-color">I like your course! One
                                                question: When I'm on the published website on a dynamic project page
                                                the navlink "Projects" is not highlighted like "Home" on the Homepage.
                                                Any idea how to achieve this?</p>
                                        </div>
                                    </div>
                                    <div class="pt-12 d-flex align-items-center g-30">
                                        <button class="border-0 p-0 bg-transparent fs-15 fw-500 lh-18 text-text-black">
                                            Reply
                                        </button>
                                        <p class="fs-15 fw-500 lh-18 text-para-color">2 days ago</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="donation-comment-reply">
                                <li>
                                    <div class="d-flex align-items-start g-12">
                                        <div class="flex-shrink-0 w-30 h-30 overflow-hidden rounded-circle">
                                            <img src="{{asset('frontend/images/news-user.png')}}" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="py-9 px-15 bd-one bd-c-text-black-10 bd-ra-6">
                                                <div class="d-flex align-items-center g-14 pb-14">
                                                    <h4 class="fs-18 fw-500 lh-22 text-text-black">Arash Ahadzadeh</h4>
                                                    <p class="py-3 px-12 bd-ra-4 bg-color3 fs-14 fw-500 lh-17 text-text-black">
                                                        Author</p>
                                                </div>
                                                <div class="d-flex flex-column g-14">
                                                    <p class="fs-15 fw-400 lh-18 text-para-color">Hello Arash,</p>
                                                    <p class="fs-15 fw-400 lh-18 text-para-color">I like your course!
                                                        One question: When I'm on the published website on a dynamic
                                                        project page the navlink "Projects" is not highlighted like
                                                        "Home" on the Homepage. Any idea how to achieve this?</p>
                                                </div>
                                            </div>
                                            <div class="pt-12 d-flex align-items-center g-30">
                                                <p class="fs-15 fw-500 lh-18 text-para-color">2 days ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-start g-12">
                                        <div class="flex-shrink-0 w-30 h-30 overflow-hidden rounded-circle">
                                            <img src="{{asset('frontend/images/news-user.png')}}" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="py-9 px-15 bd-one bd-c-text-black-10 bd-ra-6">
                                                <div class="d-flex align-items-center g-14 pb-14">
                                                    <h4 class="fs-18 fw-500 lh-22 text-text-black">Eva P</h4>
                                                    <p class="py-3 px-12 bd-ra-4 bg-color3 fs-14 fw-500 lh-17 text-text-black">
                                                        Author</p>
                                                </div>
                                                <div class="d-flex flex-column g-14">
                                                    <p class="fs-15 fw-400 lh-18 text-para-color">Hello Arash,</p>
                                                    <p class="fs-15 fw-400 lh-18 text-para-color">I like your course!
                                                        One question: When I'm on the published website on a dynamic
                                                        project page the navlink "Projects" is not highlighted like
                                                        "Home" on the Homepage. Any idea how to achieve this?</p>
                                                </div>
                                            </div>
                                            <div class="pt-12 d-flex align-items-center g-30">
                                                <p class="fs-15 fw-500 lh-18 text-para-color">2 days ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        {{--                                <li>--}}
                        {{--                                    <div class="d-flex align-items-start g-12">--}}
                        {{--                                        <div class="flex-shrink-0 w-30 h-30 overflow-hidden rounded-circle">--}}
                        {{--                                            <img src="{{asset('frontend/images/news-user.png')}}" alt="">--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="flex-grow-1">--}}
                        {{--                                            <div class="py-9 px-15 bd-one bd-c-text-black-10 bd-ra-6">--}}
                        {{--                                                <div class="d-flex align-items-center g-14 pb-14">--}}
                        {{--                                                    <h4 class="fs-18 fw-500 lh-22 text-text-black">Eva P</h4>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="d-flex flex-column g-14">--}}
                        {{--                                                    <p class="fs-15 fw-400 lh-18 text-para-color">Hello Arash,</p>--}}
                        {{--                                                    <p class="fs-15 fw-400 lh-18 text-para-color">I like your course! One question: When I'm on the published website on a dynamic project page the navlink "Projects" is not highlighted like "Home" on the Homepage. Any idea how to achieve this?</p>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="pt-12 d-flex align-items-center g-30">--}}
                        {{--                                                <button class="border-0 p-0 bg-transparent fs-15 fw-500 lh-18 text-text-black">Reply</button>--}}
                        {{--                                                <p class="fs-15 fw-500 lh-18 text-para-color">2 days ago</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </li>--}}
                    </ul>
                </div>
                <div class="donation-comment-input">
                    <textarea class="form-control" placeholder="Add a Comment"></textarea>
                    <button><img src="{{asset('frontend/images/icon/comment-send.svg')}}" alt=""></button>
                </div>
            </div>
        </div>
    </section>

@endsection

