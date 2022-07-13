@extends('layouts.frontendapp')
@section('title', 'About |')
@section('content')


    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>About Us</h2>
                    <ol>
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>About Us</li>
                    </ol>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <div class="row">
                    @foreach ($about as $data)
                        @if ($data->status == 1)
                            <div class="col-lg-6">
                                <img src="{{ asset('/storage/about/' . $data->photo) }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6 pt-4 pt-lg-0">
                                <h3>{{ $data->title }}</h3>
                                <p class="fst-italic">
                                    {{ $data->description }}
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-circle"></i>
                                        {{ $data->line }}
                                    </li>
                                    <li><i class="bi bi-check2-circle"></i>{{ $data->line2 }}</li>
                                    <li><i class="bi bi-check2-circle"></i>{{ $data->line3 }}</li>
                                </ul>
                                <p>
                                    {{ $data->description2 }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Facts Section ======= -->
        <section class="facts section-bg" data-aos="fade-up">
            <div class="container">

                <div class="row counters">
                    @foreach ($about as $data)
                        @if ($data->status == 1)
                            <div class="col-lg-3 col-6 text-center">
                                <span data-purecounter-start="0" data-purecounter-end="{{ $data->fact }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Clients</p>
                            </div>

                            <div class="col-lg-3 col-6 text-center">
                                <span data-purecounter-start="0" data-purecounter-end="{{ $data->fact2 }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Projects</p>
                            </div>

                            <div class="col-lg-3 col-6 text-center">
                                <span data-purecounter-start="0" data-purecounter-end="{{ $data->fact3 }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Hours Of Support</p>
                            </div>

                            <div class="col-lg-3 col-6 text-center">
                                <span data-purecounter-start="0" data-purecounter-end="{{ $data->fact4 }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Hard Workers</p>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </section><!-- End Facts Section -->

        <!-- ======= Our Skills Section ======= -->
        <section class="skills" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    @foreach ($skill as $data)
                        @if ($data->status == 1)
                            <h2>{{ $data->title }}</h2>
                            <p>{{ $data->description }}</p>
                        @endif
                    @endforeach

                </div>

                @foreach ($language as $data)
                    @if ($data->status == 1)
                        <div class="skills-content">
                            <div class="progress">
                                <div class="progress-bar bg-{{ $data->color }}" role="progressbar" aria-valuenow="{{ $data->aria }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <span class="skill">{{ $data->language }} <i class="val">{{ $data->percentage }}%</i></span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </section><!-- End Our Skills Section -->

        <!-- ======= Tetstimonials Section ======= -->
        <section class="testimonials" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    @foreach ($tetstimonial as $data)
                        @if ($data->status == 1)
                            <div class="section-title">
                                <h2>{{ $data->title }}</h2>
                                <p>{{ $data->description }}</p>
                            </div>
                        @endif
                @endforeach
                </div>

                <div class="testimonials-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($worker as $data)
                                <div class="testimonial-item swiper-slide">
                                <img src="{{ asset('/storage/worker/' . $data->image) }}"
                                    class="testimonial-img" alt="">
                                <h3>{{ $data->title }}</h3>
                                <h4>{{ $data->proportion }}</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    {{ $data->description }}
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Ttstimonials Section -->

    </main><!-- End #main -->

@endsection

@section('about')
    class="active"
@endsection
