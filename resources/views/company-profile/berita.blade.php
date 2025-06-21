@extends('company-profile.Layout.company')

@section('content')
    <img src="{{ asset('images/banner.png') }}" class="berita-web-banner w-100" alt="Banner">
    <div class="container berita-web my-5">
        <h4 class="mb-4 fw-bold text-center">Berita Terbaru</h4>
        <div class="row g-4">
            @foreach ($beritas as $berita)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 shadow rounded-4 border-0">
                        <!-- Gambar dengan rasio dan jarak bawah -->
                        <div class="ratio ratio-16x9 mb-3">
                            <img src="{{ asset('images/upload/berita/' . $berita->foto) }}"
                                class="object-fit-cover rounded-top-4" alt="{{ $berita->judul }}">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold mb-2">{{ $berita->judul }}</h5>
                            <small class="text-muted mb-3">{{ $berita->tanggal }}</small>
                            <p class="card-text flex-grow-1" style="font-size: 0.95rem;">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->konte), 100, '...') !!}
                            </p>
                            <a href="/berita/{{ $perusahaans->nama_perusahaan }}/detail/{{ $berita->id }}"
                                class="btn btn-primary btn-sm w-100 mt-3">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
