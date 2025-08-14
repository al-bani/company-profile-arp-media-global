@extends('company-profile.Layout.company')

@section('content')

    <div class="container py-5">

        {{-- HEADER with CARD --}}
        <div class="card shadow-sm rounded mb-5 p-4 border-0">
            <div class="row g-4 align-items-center">
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('images/upload/logo/primary/' . $perusahaans->logo_utama) }}"
                        alt="Logo {{ $perusahaans->nama_perusahaan }}" class="img-fluid rounded" style="max-width: 180px;">
                </div>
                <div class="col-lg-8">
                    <h2 class="fw-bold">{{ $perusahaans->nama_perusahaan }}</h2>
                    <p class="fs-5 text-justify">{{ $perusahaans->deskripsi }}</p>

                    <div class="mt-4">
                        <h5 class="fw-bold text mb-2">Moto Perusahaan</h5>
                        <p class="fs-5 text-justify mb-0">{{ $perusahaans->moto }}</p>
                    </div>
                </div>
            </div>
        </div>



        {{-- INFO PERUSAHAAN --}}
        {{-- <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="icon-box shadow-sm p-4 text-center bg-white rounded">
                    <i class="bi bi-file-earmark-text fs-2 text mb-2"></i>
                    <h5 class="fw-bold">NIB</h5>
                    <p class="mb-0">{{ $perusahaans->nib }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box shadow-sm p-4 text-center bg-white rounded">
                    <i class="bi bi-shield-lock fs-2 text mb-2"></i>
                    <h5 class="fw-bold">NPWP</h5>
                    <p class="mb-0">{{ $perusahaans->npwp }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box shadow-sm p-4 text-center bg-white rounded">
                    <i class="bi bi-person-check fs-2 text mb-2"></i>
                    <h5 class="fw-bold">Notaris</h5>
                    <p class="mb-0">{{ $perusahaans->notaris }}</p>
                </div>
            </div>
        </div> --}}

        {{-- VISI & MISI --}}
        @if ($perusahaans->visi != '-' || $perusahaans->misi != '-')
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h3 class="fw-bold">Visi & Misi</h3>
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

        {{-- CEO & UCAPAN TERIMA KASIH --}}
        @foreach ($strukturs as $struktur)
            @if ($struktur->atasan === '0')
                <div class="row align-items-center shadow-sm rounded p-4 mb-5">
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <img src="{{ asset('images/upload/struktur/' . $struktur->foto) }}" alt="{{ $struktur->nama }}"
                            class=" mb-2 " style="width: 200px;">
                        <h5 class="fw-bold mb-0">{{ $struktur->nama }}</h5>
                        <p class="text-muted">{{ $struktur->jabatan }}</p>
                    </div>
                    <div class="col-md-8">
                        <h5 class="fw-bold">Harapan & Terima Kasih</h5>
                        <p class="text-justify">
                            Terima kasih atas kepercayaan dan dukungan yang telah Anda berikan.
                            Kami berkomitmen untuk terus berkembang, menghadirkan layanan terbaik, dan menjadi mitra yang
                            dapat diandalkan.
                            Mari terus berjalan bersama menuju masa depan yang lebih baik dan penuh inovasi.
                        </p>
                    </div>
                </div>
            @endif
        @endforeach



        {{-- SOCIAL MEDIA --}}
        @if (
            $perusahaans->instagram != '-' ||
                $perusahaans->facebook != '-' ||
                $perusahaans->tiktok != '-' ||
                $perusahaans->twitter != '-')
            <div class="text-center pb-4">
                <h4 class="fw-bold mb-3">Ikuti Kami</h4>
                <div class="d-flex justify-content-center gap-4">
                    @if ($perusahaans->instagram != '-')
                        <a href="{{ $perusahaans->instagram }}" target="_blank">
                            <i class="bi bi-instagram fs-3 text-dark"></i>
                        </a>
                    @endif
                    @if ($perusahaans->facebook != '-')
                        <a href="{{ $perusahaans->facebook }}" target="_blank">
                            <i class="bi bi-facebook fs-3 text-dark"></i>
                        </a>
                    @endif
                    @if ($perusahaans->tiktok != '-')
                        <a href="{{ $perusahaans->tiktok }}" target="_blank">
                            <i class="bi bi-tiktok fs-3 text-dark"></i>
                        </a>
                    @endif
                    @if ($perusahaans->twitter != '-')
                        <a href="{{ $perusahaans->twitter }}" target="_blank">
                            <i class="bi bi-twitter fs-3 text-dark"></i>
                        </a>
                    @endif
                </div>
            </div>
        @endif

    </div>
@endsection
