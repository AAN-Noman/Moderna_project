@extends('layouts.frontendapp')
@section('title', 'Our Team |')
@section('content')
    <main id="main">

        <!-- ======= Our Team Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Our Team</h2>
                    <ol>
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Our Team</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Our Team Section -->

        <!-- ======= Team Section ======= -->
        <section class="team" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container">

                <div class="row">

                    @foreach ($team as $data)
                        @if ($data->status == 1)
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                <div class="member">
                                    <div class="member-img">
                                        <img src="{{ asset('/storage/team/' . $data->photo) }}" class="img-fluid"
                                            alt="">
                                        <div class="social">
                                            <a href="{{ $data->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a>
                                            <a href="{{ $data->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                            <a href="{{ $data->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                            <a href="{{ $data->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>{{ $data->name }}</h4>
                                        <span>{{ $data->profession }}</span>
                                        <p>{{ $data->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
        </section><!-- End Team Section -->

    </main><!-- End #main -->
@endsection
@section('team')
    class='active'
@endsection
