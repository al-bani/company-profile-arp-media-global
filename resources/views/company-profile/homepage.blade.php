@extends('company-profile.Layout.company')

@section('content')


    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($banners as $index => $foto)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <!-- Gambar -->
                    <img src="{{ asset('images/upload/banner/' . $foto->foto) }}" class="carousel-img d-block w-100"
                        alt="Slide {{ $index + 1 }}">

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
    <div class="container pt-5">
        <h2 class="text-center fw-bold">Layanan Kami</h2>
        <div class="layanan-container">
            @foreach ($layanans as $layanan)
                <div class="custom-card">
                    <div class="img-box">
                        <img src="{{ asset('images/upload/layanan/' . $layanan->foto) }}"
                            alt="{{ $layanan->nama_layanan }}">
                    </div>
                    <div class="custom-content">
                        <h2>{{ $layanan->nama_layanan }}</h2>
                        <p>{!! $layanan->deskripsi !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    {{-- Profil Perusahaan --}}
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="container-fluid bg-white py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 text-center mb-4 mb-lg-0">
                <img src="{{ asset('images/upload/logo/primary/' . $perusahaans->logo_utama) }}" class="img-fluid w-50"
                    alt="Logo Perusahaan">
            </div>
            <div class="col-lg-7">
                <h3 class="fw-bold mb-3">PROFILE PERUSAHAAN</h3>
                <p class="mb-4">
                    {!! Str::limit(strip_tags($perusahaans->deskripsi), 250, '...') !!}
                </p>
                <a href="/detail/{{ $perusahaans->nama_perusahaan }}" class="btn btn-primary">Baca Selengkapnya</a>
            </div>
        </div>
    </div>


    {{-- Visi dan Misi --}}
    <div class="container pt-5">
        @if ($perusahaans->visi != null || $perusahaans->misi != null)
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h2 class="fw-bold">Visi & Misi</h2>
                </div>
                @if ($perusahaans->visi != '-')
                    <div class="col-md-6 mb-4">
                        <div class="p-4 shadow-sm bg-white rounded h-100">
                            <h5 class="fw-bold text mb-3">Visi</h5>
                            <p class="mb-0">{{ $perusahaans->visi }}</p>
                        </div>
                    </div>
                @endif
                @if ($perusahaans->misi != '-')
                    <div class="col-md-6 mb-4">
                        <div class="p-4 shadow-sm bg-white rounded h-100">
                            <h5 class="fw-bold text mb-3">Misi</h5>
                            <p class="mb-0">{{ $perusahaans->misi }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    {{-- Berita --}}

    <div class="container berita pt-5">
        <h2 class="text-center fw-bold h2 mb-5">Berita Terbaru</h2>
        <div class="row g-4 justify-content-center">
            @foreach ($beritas as $berita)
                <!-- Tampilan untuk desktop -->
                <div class="col-12 col-md-6 d-none d-md-block col-lg-3 mb-3">
                    <div class="card h-100 shadow rounded-4 border border-light-subtle">
                        <div class="ratio ratio-16x9 mb-3">
                            <img src="{{ asset('images/upload/berita/' . $berita->foto) }}"
                                class="object-fit-cover rounded-top-4" alt="{{ $berita->judul }}">
                        </div>
                        <div class="card-body d-flex flex-column pt-0">
                            <h5 class="card-title fw-semibold mb-2">{{ $berita->judul }}</h5>
                            <small class="text-muted mb-3 d-block">{!! $berita->tanggal !!}</small>
                            <p class="card-text flex-grow-1" style="font-size: 0.95rem;">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100, '...') !!}
                            </p>

                        </div>
                    </div>
                </div>

                <!-- Tampilan untuk mobile -->
                <div class="berita-mobile col-12 d-lg-none mb-3" style="max-width: 280px;">
                    <div class="card h-100 shadow rounded-4 border border-light-subtle">
                        <div class="ratio ratio-16x9 mb-3">
                            <img src="{{ asset($berita->foto) }}" class="object-fit-cover rounded-top-4"
                                alt="{{ $berita->judul }}">
                        </div>
                        <div class="card-body d-flex flex-column pt-0">
                            <h5 class="card-title fw-semibold mb-2">{{ $berita->judul }}</h5>
                            <small class="text-muted mb-3 d-block">{!! $berita->tanggal !!}</small>
                            <p class="card-text flex-grow-1" style="font-size: 0.95rem;">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100, '...') !!}
                            </p>
                            <a href="#" class="btn btn-primary btn-sm w-100 mt-3">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Anak Perusahaan -->
    @if ($perusahaans->status === 'induk')
        <div class="container pt-5">
            <h2 class="text-center h2 fw-bold">Anak Perusahaan</h2>
            <div class="subsidiary-container  justify-content-center">
                @foreach ($anaks as $perusahaan)
                    @if ($perusahaan->status === 'anak')
                        <div class="subsidiary-card">
                            <div class="subsidiary-img-box">
                                <img src="{{ asset('images/upload/logo/primary/' . $perusahaan->logo_utama) }}"
                                    alt="">
                            </div>
                            <div class="subsidiary-content">
                                <h2>{{ $perusahaan->nama_perusahaan }}</h2>

                                <a href="/{{ $perusahaan->nama_perusahaan }}">Read More</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif


    {{-- Klien --}}
    @php
        $totalPartners = count($partners);
        $isMarquee = $totalPartners >= 5; // Ubah kondisi menjadi >= 5
    @endphp

    <div class="client-section bg-white">
        <div class="container text-center">
            <h2 class="text-center fw-bold mb-4">Klien Kami</h2>
            <div class="marquee-container overflow-hidden">
                <div class="marquee-track d-flex {{ $isMarquee ? 'animate-marquee' : 'justify-content-center w-100' }}"
                    style="flex-wrap: nowrap;">

                    @foreach ($partners as $partner)
                        <div class="px-3" style="flex: 0 0 auto;">
                            <img src="{{ asset('images/upload/partner/' . $partner->foto) }}" alt="Logo Klien"
                                class="img-fluid" style="height: 120px;">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- FAQ -->
    <div class="container py-5">
        <h2 class="fw-bold mb-1 text-center">Pertanyaan Yang Sering Ditanyakan</h2>
        <p class="text-muted mb-4 text-center">Jawaban atas pertanyaan yang sering ditanyakan</p>

        <h4 class="fw-bold mb-3">Daftar Pertanyaan</h4>

        <div class="accordion faq-accordion" id="faqAccordion">


            @foreach ($faqs as $index => $faq)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed shadow-none px-0 py-3 bg-transparent" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                            aria-expanded="false" aria-controls="collapse{{ $index }}">
                            <span class="me-auto">{{ $faq->pertanyaan }}</span>
                            <span class="icon">+</span>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body ps-0 pt-0 pb-3 text-muted">
                            {{ $faq->jawaban }}
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

@endsection
