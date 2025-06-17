@extends('company-profile.Layout.company')

<link href="{{ asset('css/portofolio.css') }}" rel="stylesheet" type="text/css">
@section('content')

    <div id="carouselExample" class="carousel slide d-block d-md-none" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
            @foreach($portofolio->portofolio_foto as $index => $foto)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @if(str_ends_with(strtolower($foto->foto), '.mp4'))
                        <video src="{{ asset('images/upload/portofolio/' . $foto->foto) }}" class="corousel-img d-block w-100" autoplay controls loop type="video/mp4"></video>
                    @else
                        <img src="{{ asset('images/upload/portofolio/' . $foto->foto) }}" class="corousel-img d-block w-75" alt="{{ $foto->judul_foto }}">
                    @endif
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

    <div class="gambar-banner-desktop d-none d-md-block">
        @foreach($portofolio->portofolio_foto->take(3) as $index => $foto)
            @if($index === 0)
                <img src="{{ asset('images/upload/portofolio/' . $foto->foto) }}" class="corousel-img w-100" style="height: 400px" alt="{{ $foto->judul_foto }}">
            @else
                <div class="row g-0">
                    <div class="col-lg-6 col-md-6">
                        <img src="{{ asset('images/upload/portofolio/' . $foto->foto) }}" class="w-100" style="height: 400px" alt="{{ $foto->judul_foto }}">
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="container pt-4" style="font-family: 'Roboto';">
        <div class="container">
            <h1 class="fst-italic fw-bold">{{ $portofolio->nama_project }}</h1>
            <p class="fs-5">{{ $portofolio->deskripsi }}</p>
        </div>

        <div class="container mb-3">
            <h2 class="fst-italic fw-bold">Informasi Project</h2>
            <div class="row p-4 g-0">
                <div class="col-lg-3 col-md-6">
                    <p class="fs-5">Tempat: {{ $portofolio->tempat }}</p>
                    <p class="fs-5">Status: {{ $portofolio->status_project }}</p>
                    <p class="fs-5">Tanggal: {{ $portofolio->tanggal }}</p>
                    <p class="fs-5">Waktu: {{ $portofolio->waktu }}</p>
                </div>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="container p-3" style="font-family: 'Roboto';">
            <h2 class="fst-italic fw-bold mb-5">Timeline</h2>
            <div class="timeline p-4">
                @if($portofolio->portofolio_timeline && count($portofolio->portofolio_timeline) > 0)
                    @foreach($portofolio->portofolio_timeline as $index => $item)
                        <div class="timeline-container {{ $index % 2 == 0 ? 'left' : 'right' }}">
                            <div class="content">
                                <h2 class="fw-bold">{{ $item->tanggal }}</h2>
                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p class="fs-5">Timeline belum tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
