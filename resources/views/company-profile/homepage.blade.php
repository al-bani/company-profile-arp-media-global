@extends('company-profile.Layout.company')

@section('content')
    @php
        $logos = ['bi.png', 'bjb.png', 'disdik.png', 'diskominfo.png', 'ojk.png', 'unpad.png'];
    @endphp

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($banners as $foto)
                <div class="carousel-item active">
                    <img src="{{ asset($foto->foto) }}" class="corousel-img d-block w-100" alt="Slide 1">
                </div>
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

    {{-- Layanan --}}
    <div class="container pt-5 ">
        <h1 class="text-center h1">Layanan Kami</h1>
        <div class="layanan-container">
            @foreach ($layanans as $layanan)
                <div class="custom-card">
                    <div class="img-box"><img src="{{ asset($layanan->foto) }}">
                    </div>
                    <div class="custom-content">
                        <h2>{{ $layanan->nama_layanan }}</h2>
                        <p>{!! $layanan->deskripsi !!}</p>
                        <a href="">Read More</a>
                    </div>
                </div>
            @endforeach
            {{-- <div class="custom-card">
                <div class="img-box"><img
                        src="https://images.unsplash.com/photo-1682686578023-dc680e7a3aeb?auto=format&fit=crop&q=80&w=1470&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                </div>
                <div class="custom-content">
                    <h2>Media Advertising</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, hic? Magnam eum error saepe
                        doloribus corrupti repellat quisquam alias doloremque!</p>
                    <a href="">Read More</a>
                </div>
            </div>
            <div class="custom-card">
                <div class="img-box"><img
                        src="https://images.unsplash.com/photo-1682686580224-cd46ea1a6950?auto=format&fit=crop&q=80&w=1470&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                </div>
                <div class="custom-content">
                    <h2>Pengelolaan Sampah</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, hic? Magnam eum error saepe
                        doloribus corrupti repellat quisquam alias doloremque!</p>
                    <a href="">Read More</a>

                </div>
            </div> --}}
        </div>
    </div>

    {{-- Profil Perusahaan --}}
    <div class="container-fluid bg-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 text-center mb-4 mb-lg-0">
                    <img src="{{ asset($perusahaans->logo) }}" class="img-fluid w-50" alt="Logo Perusahaan">
                </div>
                <div class="col-lg-7">
                    <h3 class="fw-bold mb-3">PROFILE PERUSAHAAN</h3>
                    <p class="mb-4">{!! $perusahaans->deskripsi !!}</p>
                    <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita --}}
    <div class="container berita pt-5">
        <h1 class="text-center h1 mb-5">Berita Terbaru</h1>
        <div class="row g-4">
            @foreach ($beritas as $berita)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($berita->foto) }}" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text"><small class="text-muted">{!! $berita->tanggal !!}</small></p>
                            <p class="card-text">{!! $berita->konten !!}</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Read Full Blog</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- Klien --}}
    <div class="client-section  bg-white ">
        <div class="container text-center">
            <h2 class="text-center mb-4">Klien Kami</h2>
            <div class="marquee-container overflow-hidden">
                <div class="marquee-track d-flex">

                    @foreach ($partners as $partner)
                        <div class="px-3">
                            <img src="{{ asset($partner->foto) }}" alt="Logo Klien" class="img-fluid" style="height: 70px;">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
<style>

</style>
