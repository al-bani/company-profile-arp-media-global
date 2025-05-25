@extends('company-profile.Layout.company')

{{-- Content --}}
@section('content')

    @php
        $logos = ['bi.png', 'bjb.png', 'disdik.png', 'diskominfo.png', 'ojk.png', 'unpad.png'];
    @endphp
    @foreach ($perusahaans as $perusahaan)
        @if ($perusahaan->nib === '2102220087754')
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($banners as $foto)
                        @if ($foto->id_perusahaan === $perusahaan->id_perusahaan)
                            <div class="carousel-item active">
                                <img src="{{ asset($foto->foto) }}" class="corousel-img d-block w-100 " alt="...">
                            </div>
                        @endif
                    @endforeach
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



            {{-- Profile Perusahaan --}}
            <div class="hp-profile container-fluid p-4 ">
                <div class="row justify-content-center ">
                    <div class="col-sm-12 col-md-6 col-lg-5  d-flex justify-content-center ps-lg-5 mb-4 mt-4">
                        <img src="{{ asset($perusahaan->logo) }}" class="hp-profile-logo mt-3 mb-3 w-50" alt>
                    </div>
                    <div class="col-sm-12 col-mt-6 col-lg-6 text-profile mt-lg-3 mb-lg-5 text-white ">
                        <h4 class=" pt-3  mb-3"><b>PROFILE PERUSAHAAN</b></h4>
                        <p>{{ $perusahaan->deskripsi }}</p>
                        <button class="btn d-flex justify-content-center justify-content-lg-start">Baca Selengkapnya
                        </button>
                    </div>
                </div>
            </div>

            {{-- Layanan --}}
            <div class="container layanan ">
                <h1 class="display-5 pb-3">Layanan</h1>
                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-12 col-md-4    col-lg-4 layanan-card1 ">
                            @foreach ($layanans as $layanan)
                                @if ($layanan->id_perusahaan === $perusahaan->id_perusahaan)
                                    <div class="card mb-3 border-0 w-100">
                                        <img src="{{ asset($layanan->foto) }}" class="card-img-top " alt="...">
                                    </div>
                                @endif
                            @endforeach

                        </div>


                    </div>
                </div>
                {{-- Buat Yang bawah card nya --}}
                {{-- <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 layanan-card4">
                            <div class="card mb-3 border-0">
                                <img src="{{ asset('images/berita.jpg') }}" class="card-img-top " alt="...">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 layanan-card5">
                            <div class="card  mb-3 border-0">

                                <img src="{{ asset('images/sampah.png') }}" class="card-img-top " alt="...">

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 layanan-card6">
                            <div class="card mb-3 border-0">
                                <a href="">
                                    <img src="{{ asset('images/viewmore.png') }}" class="card-img-top " alt="...">
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            {{-- Berita --}}
            <div class="container berita ">
                <h1 class="display-5 text-center">Berita</h1>
                <div class="container">
                    <div class="rowberita row">
                        <div class="col-sm-12 col-md-6 col-lg-3 ">
                            @foreach ($beritas as $berita)
                                @foreach ($beritaFotos as $beritaFoto)
                                    @if ($berita->id_perusahaan === $perusahaan->id_perusahaan)
                                        @if ($beritaFoto->id_berita === $berita->id_berita)
                                            <div class="card-template">
                                                <div class="card-template-img-holder">
                                                    <img src="{{ asset($beritaFoto->foto) }}" alt="Blog image">
                                                </div>
                                                <h3 class="blog-title">{{ $berita->judul }}</h3>
                                                <span class="blog-time">{{ $berita->tanggal }}</span>
                                                <p class="description">
                                                    {!! $berita->konten !!}
                                                </p>
                                                <div class="options">
                                                    <span></span>
                                                    <button class="btn">Read Full Blog</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </div>

                        {{-- ALTERNATE --}}
                        {{-- @foreach ($perusahaan->beritas as $berita)
                            @foreach ($berita->beritaFotos as $beritaFoto)
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card-template">
                                        <div class="card-template-img-holder">
                                            <img src="{{ asset($beritaFoto->foto) }}" alt="Blog image">
                                        </div>
                                        <h3 class="blog-title">{{ $berita->judul }}</h3>
                                        <span class="blog-time">{{ $berita->tanggal }}</span>
                                        <p class="description">{{ $berita->konten }}</p>
                                        <div class="options">
                                            <button class="btn">Read Full Blog</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach --}}


                    </div>
                </div>
            </div>

            {{-- Client --}}
            <div class="client-section">
                <h4>Klien Kita</h4>
                <div class="marquee-container">
                    <div class="marquee-track">

                            @foreach ($partners as $partner)
                                <div class="logo">
                                    <img src="{{ asset($partner->foto) }}" alt="logo {{ $partner->nama_partner }}">
                                </div>
                            @endforeach

                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
