@extends('landingfo.template.head')
@include('landingfo.template.body')
@include('landingfo.template.modalundangan')
@include('landingfo.template.header')
<!-- start of hero -->
<section class="wpo-hero-slider wpo-hero-slider-s2">
    <div class="swiper-container">
        <div class="swiper-wrapper">
        	@foreach($landing as $p)
            <div class="swiper-slide">
                <div class="slide-inner slide-bg-image" data-background="{{ $p->url_foto }}">
                    <!-- <div class="gradient-overlay"></div> -->
                    <div class="container-fluid">
                        <div class="slide-content">
                            <div data-swiper-parallax="300" class="slide-title">
                                <h2>{{ $p->nama_mempelai }}</h2>
                            </div>
                            <div data-swiper-parallax="400" class="slide-text">
                                <p>{{ $p->keterangan }}</p>
                            </div>
                            <div class="border-1"></div>
                            <div class="border-2"></div>
                            <div class="border-3"></div>
                            <div class="border-4"></div>
                            <div class="s-img-1"><img src="loveme/assets/images/slider/shape3.png" alt=""></div>
                            <div class="s-img-2"><img src="loveme/assets/images/slider/shape4.png" alt=""></div>
                        </div>
                    </div>
                </div> <!-- end slide-inner -->
            </div> <!-- end swiper-slide -->
            @endforeach
        </div>
        <!-- end swiper-wrapper -->

        <!-- swipper controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<!-- end of wpo-hero-slide-section-->

<section class="wpo-wedding-date">
    <!-- <h2 class="hidden">some</h2> -->
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="clock-grids">
                    <div id="clock"></div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
@include('landingfo.template.footer')
