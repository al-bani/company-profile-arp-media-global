<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARP GLOBAL MEDIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- <link href="{{ asset('css/style-compro.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('css/style-desktop.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style-tablet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style-mobile.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">


</head>

<body>

    {{-- Header --}}
    <nav class="navbar navbar-expand-lg w-100 sticky-top shadow ">
        <div class="container-fluid">
            <img class="nav-logo navbar-brand ms-3 " src="{{ asset('images/logo-AGM.png') }}"></img>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex gap-5 me-5">
                    <li class="nav-item ">
                        <a class="nav-link " aria-current="page" href="/"> Perusahaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/kontak" aria-disabled="true">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <div class="footer mt-4">
        <div class="container">
            <footer class="py-3 ">
                <ul class="nav justify-content-center gap-5 pb-3 ">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black ">ARP Global Media</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black ">Kontak</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black ">FAQ</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-black ">Struktur Organisasi</a>
                    </li>
                </ul>
                <p class="text-center"> <b> Copyright © 2025 ARP Global Media</b></p>
            </footer>
        </div>
    </div>
</body>

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
