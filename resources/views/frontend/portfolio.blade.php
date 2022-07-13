@extends('layouts.frontendapp')
@section('title', 'Protfolio |')
@section('content')
    <main id="main">

        <!-- ======= Our Portfolio Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Our Portfolio</h2>
                    <ol>
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Our Portfolio</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Our Portfolio Section -->

        <!-- ======= Portfolio Section ======= -->
        <section class="portfolio">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-easing="ease-in-out"
                    data-aos-duration="500">

                    @foreach ($portfolio as $data)
                        @if ($data->status == 1)
                            <div class="col-lg-4 col-md-6 portfolio-wrap filter-{{ $data->filter }}">
                                <div class="portfolio-item">
                                    <img src="{{ asset('/storage/portfolio/' . $data->image) }}" class="img-fluid"
                                        alt="">
                                    <div class="portfolio-info">
                                        <h3>{{ $data->title }}</h3>
                                        <div>
                                            <a href="{{ asset('/storage/portfolio/' . $data->image) }}"
                                                data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $data->title }}"><i
                                                    class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" title="Portfolio Details"><i
                                                    class="bx bx-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </section><!-- End Portfolio Section -->

    </main><!-- End #main -->
@endsection

@section('portfolio')
    class='active'
@endsection
