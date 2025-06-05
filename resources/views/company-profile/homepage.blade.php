@extends('company-profile.Layout.company')

@section('content')
    @php
        $logos = ['bi.png', 'bjb.png', 'disdik.png', 'diskominfo.png', 'ojk.png', 'unpad.png'];
    @endphp

    @php
        $subsidiaries = [
            ['name' => 'Perusahaan A', 'image' => 'unpad.png'],
            ['name' => 'Perusahaan B', 'image' => 'unpad.png'],
            ['name' => 'Perusahaan C', 'image' => 'unpad.png'],
            ['name' => 'Perusahaan D', 'image' => 'unpad.png'],
            ['name' => 'Perusahaan E', 'image' => 'unpad.png'],
        ];
    @endphp

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($banners as $index => $foto)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <!-- Gambar -->
                    <img src="{{ asset($foto->foto) }}" class="carousel-img d-block w-100" alt="Slide {{ $index + 1 }}">

                    <!-- Overlay Teks -->
                    <div class="carousel-text-overlay">
                        <h2>{{ $foto->judul ?? 'Judul Banner' }}</h2>
                        <p>{{ $foto->deskripsi ?? 'Deskripsi singkat banner' }}</p>
                    </div>
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
                        <!-- <a href="">Read More</a> -->
                    </div>
                </div>
            @endforeach
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
                    <a href="/detail/{{ $perusahaans->nama_perusahaan }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita --}}
    
    <div class="container berita pt-5">
        <h1 class="text-center h1 mb-5">Berita Terbaru</h1>
        <div class="row g-4 justify-content-center">
            @foreach ($beritas as $berita)
                <!-- Untuk dekstop -->
                <div class="col-12 col-md-6 d-none d-md-block col-lg-3">
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
                <!-- untuk mobile -->
                <div class="berita-mobile col-12 d-lg-none" style="width: 280px">
                    <div class="card h-100 shadow-sm" >
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

    <!-- Anak Perusahaan -->
    <div class="container pt-5">
        <h1 class="text-center h1">Anak Perusahaan</h1>
        <div class="subsidiary-container  justify-content-center">
            @if ($perusahaans->status === 'induk')
                @foreach ($anaks as $perusahaan)
                    @if ($perusahaan->status === 'anak')
                        <div class="subsidiary-card">
                            <div class="subsidiary-img-box">
                                <img src="{{ asset($perusahaan->logo) }}" alt="">
                            </div>
                            <div class="subsidiary-content">
                                <h2>{{ $perusahaan->nama_perusahaan }}</h2>

                                <a href="/{{ $perusahaan->nama_perusahaan }}">Read More</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

        </div>
    </div>


    {{-- Klien --}}
    @php
        $totalPartners = count($partners);
        $isMarquee = $totalPartners >= 8; // Ubah kondisi menjadi >= 5
    @endphp

    <div class="client-section bg-white">
        <div class="container text-center">
            <h1 class="text-center mb-4">Klien Kami</h1>
            <div class="marquee-container overflow-hidden">
                <div class="marquee-track d-flex {{ $isMarquee ? 'animate-marquee' : 'justify-content-center w-100' }}"
                    style="flex-wrap: nowrap;">

                    @foreach ($partners as $partner)
                        <div class="px-3" style="flex: 0 0 auto;">
                            <img src="{{ asset($partner->foto) }}" alt="Logo Klien" class="img-fluid"
                                style="height: 120px;">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>






@endsection
<style>

</style>
