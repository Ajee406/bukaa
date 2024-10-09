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
                        <label for="candidateSession" class="form-label">Session</label>
                        <select class="primary-form-control sf-select-without-search" id="candidateSession">
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
                                <button class="border-0 p-0 bg-transparent fs-18 fw-500 lh-22 text-text-black">Business Automation LTD</button>
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
@endsection
