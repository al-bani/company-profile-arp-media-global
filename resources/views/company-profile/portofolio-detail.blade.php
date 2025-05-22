@extends('company-profile.Layout.company')

<link href="{{ asset('css/portofolio.css') }}" rel="stylesheet" type="text/css">
@section('content')
    @php
        $logos = ['bi.png', 'bjb.png', 'disdik.png', 'diskominfo.png', 'ojk.png', 'unpad.png'];
    @endphp

    <div id="carouselExample" class="carousel slide d-block d-md-none" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/berita.jpg') }}" class="corousel-img d-block w-75 " alt="...">
            </div>
            <div class="carousel-item">
                <video src="{{ asset('images/interview.mp4') }}" class="corousel-img d-block w-100 " autoplay controls loop
                    type="video/mp4"></video>
                {{-- <img src="{{ asset('images/berita.png') }}" class="corousel-img d-block w-100 " alt="..."> --}}
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/berita.jpg') }}" class="corousel-img d-block w-100 " alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="gambar-banner-desktop d-none d-md-block">
        <img src="{{ asset('images/berita.jpg') }}" class="corousel-img  w-100 " style="height: 400px" alt="...">

        <div class="row g-0">
            <div class="col-lg-6 col-md-6">
                <img src="{{ asset('images/berita.jpg') }}" class="w-100" style="height: 400px" alt="...">
            </div>
            <div class="col-lg-6 col-md-6">
                <img src="{{ asset('images/berita.jpg') }}" class="w-100" style="height: 400px" alt="...">
            </div>
        </div>
    </div>


    <div class="container pt-4" style="font-family: 'Roboto';">
        <div class="container ">
            <h1 class=" fst-italic fw-bold">Judul Project</h1>
            <p class="fs-5">Google Indonesia menggandeng tim kami untuk mengembangkan kampanye edukatif bertajuk “Cerdas
                Digital, Aman Berselancar”, yang bertujuan meningkatkan kesadaran masyarakat tentang literasi digital,
                keamanan data, dan etika berinternet di kalangan pelajar dan generasi muda.</p>
        </div>
        <div class="container mb-3">
            <h2 class=" fst-italic fw-bold">Client</h2>
            <div class="row p-4 g-0">
                <div class="col-lg-3 col-md-6">
                    <img src="{{ asset('images/logo copy.png') }}" class="w-100" style="height: 200px" alt="...">
                </div>
                <div class="col-lg-9 col-md-6">
                    <p class="fs-5 ps-2 pt-5">Google Indonesia menggandeng tim kami untuk mengembangkan kampanye edukatif bertajuk
                        “Cerdas Digital,
                        Aman Berselancar”, yang bertujuan meningkatkan kesadaran masyarakat tentang literasi digital,
                        keamanan data, dan etika berinternet di kalangan pelajar dan generasi muda.</p>
                </div>
            </div>
        </div>
        <div class="container p-3">
            <h2 class=" fst-italic fw-bold">Konsep</h2>
            <p class="fs-5">Google Indonesia menggandeng tim kami untuk mengembangkan kampanye edukatif bertajuk “Cerdas
                Digital, Aman Berselancar”, yang bertujuan meningkatkan kesadaran masyarakat tentang literasi digital,
                keamanan data, dan etika berinternet di kalangan pelajar dan generasi muda.</p>

        </div>

        {{-- Timeline --}}
        <div class="container p-3" style="font-family: 'Roboto';">
            <h2 class=" fst-italic fw-bold mb-5">Timeline</h2>
            <div class="timeline p-4">
                <div class="timeline-container left">
                    <div class="content">
                        <h2 class="fw-bold">2017</h2>
                        <p>Google Indonesia menggandeng tim kami untuk mengembangkan kampanye edukatif bertajuk “Cerdas
                            Digital, Aman Berselancar”, yang bertujuan meningkatkan kesadaran masyarakat tentang literasi
                            digital,
                            keamanan data, dan etika berinternet di kalangan pelajar dan generasi muda..</p>
                    </div>
                </div>
                <div class="timeline-container right">
                    <div class="content">
                        <h2 class="fw-bold">2016</h2>
                        <p>Lorem ipsum..</p>
                    </div>
                </div>
                <div class="timeline-container left">
                    <div class="content">
                        <h2 class="fw-bold">2017</h2>
                        <p>Lorem ipsum..</p>
                    </div>
                </div>
                <div class="timeline-container right">
                    <div class="content">
                        <h2 class="fw-bold">2016</h2>
                        <p>Lorem ipsum..</p>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
