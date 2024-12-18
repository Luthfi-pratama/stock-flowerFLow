@extends('layouts.user_app')

@section('content')
    <div class="intro11-slider-wrap section">
        <div class="intro11-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="intro11-section swiper-slide slide-1 slide-bg-1 bg-position">
                    <div class="intro11-content text-left">
                        <h3 class="title-slider text-uppercase">Top Trend</h3>
                        <h2 class="title">2023 Toko Bunga</h2>
                        <p class="desc-content">Kami menyediakan berbagai bunga yang indah</p>
                        <a href="product-details.html" class="btn flosun-button secondary-btn theme-color rounded-0">Shop Now</a>
                    </div>
                </div>
                <div class="intro11-section swiper-slide slide-2 slide-bg-1 bg-position">
                    <div class="intro11-content text-left">
                        <h3 class="title-slider black-slider-title text-uppercase">Collection</h3>
                        <h2 class="title">Bunga dan Lilin <br /> Hadiah ulang tahun</h2>
                        <p class="desc-content">Bunga untuk hadiah ulang tahun.</p>
                        <a href="product-details.html" class="btn flosun-button secondary-btn rounded-0">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="home1-slider-prev swiper-button-prev main-slider-nav">
                <i class="lnr lnr-arrow-left"></i>
            </div>
            <div class="home1-slider-next swiper-button-next main-slider-nav">
                <i class="lnr lnr-arrow-right"></i>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
@endsection