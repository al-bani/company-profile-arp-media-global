@extends('company-profile.Layout.company')

@section('content')
    <div class="container py-5 berita-detail">

        {{-- Judul & Tanggal --}}
        <div class="text-center mb-4">
            <h3 class="fw-bold display-5 mb-2">{{ $beritas->judul }}</h3>
            <p class="text-muted"><i class="bi bi-calendar-event me-1"></i> {{ $beritas->tanggal }}</p>
        </div>

        {{-- Gambar Utama --}}
        <div class="text-center mb-5">
            <img src="{{ asset($beritas->foto) }}" alt="{{ $beritas->judul }}" class="img-fluid rounded-4 shadow-sm"
                style="max-height: 480px; object-fit: cover; width: 100%;">
        </div>

        {{-- Isi Berita --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9 col-md-11">
                <article class="fs-5 lh-lg text-justify">
                    {!! $beritas->konten !!}
                </article>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-center mb-5">
            <a href="{{ route('berita.index') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill">
                ← Kembali ke Daftar Berita
            </a>
        </div>

        {{-- Berita Terkait --}}
        @if ($beritaAlls->count() > 1)
            <div class="border-top pt-5">
                <h3 class="fw-bold mb-4 text-center">Berita Lainnya</h3>
                <div class="row g-4">
                    @foreach ($beritaAlls->where('id', '!=', $beritas->id)->take(3) as $berita)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0 rounded-4">
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset($berita->foto) }}" alt="{{ $berita->judul }}"
                                        class="object-fit-cover rounded-top-4">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-1">{{ $berita->judul }}</h5>
                                    <small class="text-muted">{{ $berita->tanggal }}</small>
                                    <p class="card-text mt-2" style="font-size: 0.95rem;">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 90, '...') }}
                                    </p>
                                    <a href="{{ route('berita.show', $berita->id) }}"
                                       class="btn btn-primary btn-sm w-100 mt-2 ">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@endsection
