<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$perusahaans->nama_perusahaan}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- <link href="{{ asset('css/style-compro.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="icon" href="{{ asset('images/upload/logo/primary/'.$perusahaans->logo_utama) }}" type="image/png">

    <link href="{{ asset('css/style-desktop.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style-tablet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style-mobile.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .footer {
            box-shadow: 0 -6px 20px rgba(0, 0, 0, 0.08);
        }
    </style>

</head>

<body>

    {{-- Header --}}
    <nav class="navbar navbar-expand-lg w-100 sticky-top shadow">
        <div class="container-fluid">
            <a href="/" class="navbar-brand ms-3">
                <img class="nav-logo" src="{{ asset('images/upload/logo/website/' . $perusahaans->logo_website) }}"
                    alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex gap-5 me-5">
                    <li class="nav-item dropdown">
                        <!-- MOBILE Toggle -->
                        <a class="nav-link d-lg-none d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse" href="#submenuMobilePerusahaan" role="button"
                            aria-expanded="false" aria-controls="submenuMobilePerusahaan">
                            Perusahaan
                            <i class="bi bi-chevron-down"></i>
                        </a>

                        <!-- submenu khusus mobile -->
                        <div class="collapse d-lg-none ps-3" id="submenuMobilePerusahaan">
                            <a class="dropdown-item"
                                href="/portofolio/{{ $perusahaans->nama_perusahaan }}">Portofolio</a>
                            <a class="dropdown-item" href="/struktur/{{ $perusahaans->nama_perusahaan }}">Struktur
                                Organisasi</a>
                        </div>

                        <!-- DESKTOP dropdown toggle -->
                        <a class="nav-link dropdown-toggle d-none d-lg-block" href="#" id="dropdownPerusahaan"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Perusahaan
                        </a>

                        <!-- DESKTOP dropdown menu -->
                        <ul class="dropdown-menu custom-dropdown" aria-labelledby="dropdownPerusahaan">
                            <li><a class="dropdown-item"
                                    href="/portofolio/{{ $perusahaans->nama_perusahaan }}">Portofolio</a></li>
                            <li><a class="dropdown-item" href="/struktur/{{ $perusahaans->nama_perusahaan }}">Struktur
                                    Organisasi</a></li>

                        </ul>
                    </li>

                    <li class="nav-link">
                        <a class="text-decoration-none" href="/berita/{{ $perusahaans->nama_perusahaan }}">Berita</a>
                    </li>
                    <li class="nav-link">
                        <a class="text-decoration-none" href="/layanan/{{ $perusahaans->nama_perusahaan }}">Layanan</a>
                    </li>
                    <li class="nav-link">
                        <a class="text-decoration-none" href="/kontak/{{ $perusahaans->nama_perusahaan }}">Kontak</a>
                    </li>
                    <li class="nav-link">
                        <a class="text-decoration-none" href="/faq/{{ $perusahaans->nama_perusahaan }}">FAQ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <div class="footer mt-4" style="box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <footer class="py-4">
                <!-- Navigasi -->
                <ul class="nav flex-wrap justify-content-center gap-4 gap-md-5 pb-3">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black">ARP Global Media</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black">Kontak</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black">FAQ</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black">Struktur Organisasi</a>
                    </li>
                </ul>

                <!-- Sosial Media -->
                <div class="d-flex justify-content-center gap-4 mb-3">
                    <a href="{{ $perusahaans->instagram }}" class="text-black fs-5"><i
                            class="bi bi-instagram"></i></a>
                    <a href="{{ $perusahaans->facebook }}" class="text-black fs-5"><i
                            class="bi bi-facebook"></i></a>
                    <a href="{{ $perusahaans->tiktok }}" class="text-black fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="{{ $perusahaans->twitter }}" class="text-black fs-5"><i class="bi bi-youtube"></i></a>
                </div>

                <!-- Alamat -->
                <p class="text-center text-muted small mb-2">
                    Jl. Media Digital No.88, Jakarta Selatan, Indonesia | Telp: +62 812-3456-7890
                </p>

                <!-- Copyright -->
                <p class="text-center fw-bold">
                    Copyright © 2025
                    <a href="#" data-bs-toggle="modal" data-bs-target="#itenasModal"
                        class="text-decoration-none">Itenas</a>
                </p>

            </footer>
        </div>
    </div>

    <!-- Modal Footer PengembangItenas -->


    <div class="modal fade" id="itenasModal" tabindex="-1" aria-labelledby="itenasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4 shadow-lg rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="itenasModalLabel">Tentang Itenas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">

                    <!-- Logo Itenas -->
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('images/images/logo-itenas.jpg') }}" alt="Logo Itenas" class="img-fluid"
                            style="max-width: 300px;">
                    </div>

                    <!-- Alamat -->
                    <p class="text-muted small fs-6">Alamat Kampus: Jl. PHH Mustofa No.23, Bandung 40124</p>

                    <!-- Dosen Pembimbing -->
                    <h5 class="fw-semibold  mt-4">Dosen Pembimbing</h6>
                        <div class="row justify-content-center mb-5">
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('images/images/3.jpg') }}" alt="Dosen"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="container py-3">
                                        <h6 class="mb-1"><b>Sofia Umaroh</b></h6>
                                        <p class="mb-0 text-muted">Dosen Pembimbing</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tim Pengembang -->
                        <h5 class="fw-semibold mb-3">Tim Pengembang</h5>
                        <div class="row justify-content-center">

                            <!-- Card: Ramzi -->
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('images/images/3.jpg') }}" alt="Ramzi"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="container py-3">
                                        <h6 class="mb-1"><b>Ramzi Mubarak</b></h6>
                                        <p class="mb-0 text-muted">(162021004)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card: Zildan -->
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('images/images/1.jpg') }}" alt="Zildan"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="container py-3">
                                        <h6 class="mb-1"><b>Al Zildan</b></h6>
                                        <p class="mb-0 text-muted">(162021016)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card: Bagas -->
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('images/images/Group 1.png') }}" alt="Bagas"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="container py-3">
                                        <h6 class="mb-1"><b>Bagas Praditya</b></h6>
                                        <p class="mb-0 text-muted">(162021028)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card: Darari -->
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('images/images/2.jpg') }}" alt="Darari"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="container py-3">
                                        <h6 class="mb-1"><b>Darari Yafi Fuadi</b></h6>
                                        <p class="mb-0 text-muted">(162021046)</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let descriptions = document.querySelectorAll(".description");

            descriptions.forEach(function(desc) {
                let maxLength = 120; // Ganti sesuai kebutuhan
                let text = desc.innerText;

                if (text.length > maxLength) {
                    desc.innerText = text.substring(0, maxLength) + "...";
                }
            });
        });
    </script>


</html>
