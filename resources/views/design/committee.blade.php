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
                <li><a href="{{route('donation.campaigns.index')}}">{{$title}}</a></li>
            </ul>
        </div>
    </section>

    <section class="pb-110 pt-60">
        <div class="container">
            <div class="max-w-416 d-flex">
                <div class="primary-form-group w-100">
                    <div class="primary-form-group-wrap">
                        <label for="executiveCommitteeSession" class="form-label">Session</label>
                        <select class="primary-form-control sf-select-without-search" id="executiveCommitteeSession">
                            <option value="1">2022 - 2023</option>
                            <option value="2">2023 - 2024</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="pt-60">
                <div class="row rg-24">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="bd-ra-25 bg-event-bg">
                            <div class="bd-ra-25 overflow-hidden h-341">
                                <img class="w-100 h-100 object-fit-cover" src="{{asset('frontend/images/alumni-img-1.png')}}" alt="">
                            </div>
                            <div class="pt-21 pb-29 px-10 text-center">
                                <h4 class="fs-20 fw-600 lh-28 text-black-color pb-2">Marvin McKinney</h4>
                                <p class="fs-18 fw-400 lh-28 text-para-color">President</p>
                            </div>
                            <div class=" text-center pb-28">
                                <button class="border-0 p-0 bg-transparent fs-18 fw-500 lh-22 text-text-black text-decoration-underline" data-bs-toggle="modal" data-bs-target="#executiveCommitteeProfileModal">View Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="zPagination-one pt-77">
                    <li>
                        <button class="z-link"><i class="fa-solid fa-angles-left"></i></button>
                    </li>
                    <li><button class="z-link active">1</button></li>
                    <li><button class="z-link">2</button></li>
                    <li><button class="z-link">3</button></li>
                    <li><button class="z-link">4</button></li>
                    <li>
                        <button class="z-link"><i class="fa-solid fa-angles-right"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="executiveCommitteeProfileModal" tabindex="-1" aria-labelledby="executiveCommitteeProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 bd-ra-25">
                <div class="p-sm-25 p-15 d-flex justify-content-between align-items-center g-10 bd-b-one bd-c-stroke-color">
                    <h1 class="fs-24 fw-500 lh-28 text-text-black" id="executiveCommitteeProfileModalLabel">Executive Committee Members</h1>
                    <button type="button" class="w-50 h-50 bd-one bd-c-text-black-10 bd-ra-10 d-flex justify-content-center align-items-center bg-color4 text-text-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-times"></i></button>
                </div>
                <div class="py-25 px-35">
                    <div class="text-center pb-50">
                        <div class="mb-23 bd-ra-25 overflow-hidden d-inline-block"><img src="{{asset('frontend/images/alumni-img-1.png')}}" alt=""></div>
                        <h4 class="fs-20 fw-600 lh-28 text-black-color pb-2">Marvin McKinney</h4>
                        <p class="fs-18 fw-400 lh-28 text-para-color">President</p>
                    </div>
                    <ul class="list-pt-22 list-pb-22 list-border-bottom">
                        <li class="d-flex justify-content-between align-items-center g-5 flex-wrap">
                            <p class="fs-18 fw-400 lh-28 text-para-color">Mobile Number :</p>
                            <p class="fs-18 fw-400 lh-28 text-para-color">(+880) 25663 0216</p>
                        </li>
                        <li class="d-flex justify-content-between align-items-center g-5 flex-wrap">
                            <p class="fs-18 fw-400 lh-28 text-para-color">Email Address :</p>
                            <p class="fs-18 fw-400 lh-28 text-para-color">marvinmckinney@gmai.com</p>
                        </li>
                        <li class="d-flex justify-content-between align-items-center g-5 flex-wrap">
                            <p class="fs-18 fw-400 lh-28 text-para-color">Company :</p>
                            <p class="fs-18 fw-400 lh-28 text-para-color">Zainiklab</p>
                        </li>
                        <li class="d-flex justify-content-between align-items-center g-5 flex-wrap">
                            <p class="fs-18 fw-400 lh-28 text-para-color">Address :</p>
                            <p class="fs-18 fw-400 lh-28 text-para-color">1901 Thornridge Cir. Shiloh, Hawaii 81063</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
