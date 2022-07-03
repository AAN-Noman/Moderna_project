@extends('layouts.frontendapp')
@section('title', 'Our Services |')
@section('content')
    <main id="main">
        <!-- ======= Our Services Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Our Services</h2>
                    <ol>
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Our Services</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Our Services Section -->

        <!-- ======= Services Section ======= -->
        <section class="services">
            <div class="container">
                <div class="row">
                    @foreach ($services as $data)
                        @if ($data->status == 1)
                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up">
                                <div class="icon-box icon-box-{{ $data->iconColor }}">
                                    <div class="icon"><i class="bx {{ $data->icon }}"></i></div>
                                    <h4 class="title"><a href="">{{ $data->title }}</a></h4>
                                    <p class="description">{{ $data->description }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Why Us Section ======= -->
        <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
            <div class="container">

                <div class="row">
                    @foreach ($ironman as $data)
                        @if ($data->status == 1)
                            <div class="col-lg-6 video-box">
                                <img src="{{ asset('/storage/whyus/' . $data->photo) }}" class="img-fluid" alt="">
                                <a href="{{ $data->link }}" target="_blank" class="venobox play-btn mb-4"
                                    data-vbtype="video" data-autoplay="true"></a>
                            </div>

                            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">

                                <div class="icon-box">
                                    <div class="icon"><i class="bx bx-{{ $data->icon }}"></i></div>
                                    <h4 class="title"><a href="">{{ $data->title }}</a></h4>
                                    <p class="description">{{ $data->description }}</p>
                                </div>

                                <div class="icon-box">
                                    <div class="icon"><i class="bx bx-{{ $data->icon2 }}"></i></div>
                                    <h4 class="title"><a href="">{{ $data->title2 }}</a></h4>
                                    <p class="description">{{ $data->title2 }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Service Details Section ======= -->
        <section class="service-details">
            <div class="container">

                <div class="row">
                    @foreach ($batman as $data)
                        @if ($data->status == 1)
                            <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('/storage/service_details/' . $data->photo) }}" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="#">{{ $data->title }}</a></h5>
                                        <p class="card-text">{{ $data->description }}</p>
                                        <div class="read-more"><a href="{{ $data->link }}" target="_blank"><i class="bi bi-arrow-right"></i> Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </section><!-- End Service Details Section -->

        <!-- ======= Pricing Section ======= -->
        <section class="pricing section-bg" data-aos="fade-up">
            <div class="container">
                @foreach ($price as $data)
                        @if ($data->status == 1)
                            <div class="section-title">
                                <h2>{{ $data->title }}</h2>
                                <p>{{ $data->description }}</p>
                            </div>
                        @endif
                @endforeach

                <div class="row no-gutters">
                    @if ($antman->count())
                        @foreach ($antman as $data)
                            @if ($data->status == 1)
                                <div @if ($loop->iteration == 2) class="col-lg-4 box featured" @else class="col-lg-4 box" @endif>
                                    <h3>{{ $data->title }}</h3>
                                    <h4>${{ $data->price }}<span>{{ $data->title2 }}</span></h4>
                                    <ul>
                                        <li><i class="bx bx-check"></i> {{ $data->line }}</li>
                                        <li><i class="bx bx-check"></i> {{ $data->line2 }}</li>
                                        <li><i class="bx bx-check"></i> {{ $data->line3 }}</li>
                                        <li><i class="bx bx-check"></i> {{ $data->line4 }}</li>
                                        <li><i class="bx bx-check"></i> {{ $data->line5 }}</li>
                                    </ul>
                                    <a href="{{ $data->link }}" target="_blank" class="get-started-btn">Get Started</a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

            </div>
        </section><!-- End Pricing Section -->

    </main><!-- End #main -->
@endsection
@section('services')
    class='active'
@endsection
