<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $perusahaans->nama_perusahaan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- <link href="{{ asset('css/style-compro.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="icon" href="{{ asset('images/upload/logo/primary/' . $perusahaans->logo_utama) }}" type="image/png">

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
            @if ($perusahaans->status === 'induk')
             <a href="/" class="navbar-brand ms-3">
                    <img class="nav-logo" src="{{ asset('images/upload/logo/website/' . $perusahaans->logo_website) }}"
                        alt="Logo">
                </a>
            @else
                <a href="/{{ $perusahaans->nama_perusahaan }}" class="navbar-brand ms-3">
                    <img class="nav-logo" src="{{ asset('images/upload/logo/website/' . $perusahaans->logo_website) }}"
                        alt="Logo">
                </a>
            @endif


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
                            <a class="dropdown-item"
                                href="/Detail/{{ $perusahaans->nama_perusahaan }}">Portofolio</a>
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
                                    href="/detail/{{ $perusahaans->nama_perusahaan }}">Detail Perusahaan</a></li>
                            <li><a class="dropdown-item"
                                    href="/portofolio/{{ $perusahaans->nama_perusahaan }}">Portofolio</a></li>
                            <li><a class="dropdown-item" href="/struktur/{{ $perusahaans->nama_perusahaan }}">Struktur
                                    Organisasi</a></li>
                            <li><a class="dropdown-item" href="/kbli/{{ $perusahaans->nama_perusahaan }}">KBLI</a></li>

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
                    <a href="https://instagram.com/{{ $perusahaans->instagram }}" class="text-black fs-5"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://facebook.com/{{ $perusahaans->facebook }}" class="text-black fs-5"><i
                            class="bi bi-facebook"></i></a>
                    <a href="https://tiktok.com/{{ $perusahaans->tiktok }}" class="text-black fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="https://x.com/{{ $perusahaans->twitter }}" class="text-black fs-5"><i class="bi bi-twitter"></i></a>
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
                        <img src="{{ asset('images/itenas.jpg') }}" alt="Logo Itenas" class="img-fluid"
                            style="max-width: 300px;">
                    </div>

                    <!-- Alamat -->
                    <p class="text-muted small fs-6">Alamat Kampus: Jl. PHH Mustofa No.23, Bandung 40124</p>
                    <!-- Tabel Informasi -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Role</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Sofia Umaroh</td>
                                    <td>Project Manager</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Bagas Praditya</td>
                                    <td>System Analyst</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Al Zildan Abrar</td>
                                    <td>Backend Developer</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Ramzi Mubarak</td>
                                    <td>Frontend Developer</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Darari Yafi</td>
                                    <td>UI/UX Designer</td>
                                </tr>
                            </tbody>
                        </table>
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
