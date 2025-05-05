@extends('company-profile.Layout.company')

@section('content')
    <img src="{{ asset('images/banner.png') }}" class="berita-web-banner w-100">
    <div class="container-fluid ">
        <div class="text-center ">

            {{-- bagian header --}}
            <div class="row detail-header">
                <div class="col-lg-4 mt-5 ">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="logo-detail  w-75">
                </div>
                <div class="col-lg-8 mt-4 text-start p-4 mb-4">
                    <h1 class="h2 fw-bold">Media Perusahaan Yang Mengedapankan Kualitas</h1>
                    <p>Kami hadir sebagai penggerak untuk membuka dunia penuh peluang serta kemungkinan tanpa batas melalui
                        serta kemungkinan tanpa batas melalui pemanfaatan laanan dan solusi digital integrasi</p>
                </div>
            </div>

            {{-- Project  --}}
            <div class="container p-4">
                <h1 class="h1">Projects</h1>
                <div class="row p-4">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mb-3 border-0 w-100">
                            <img src="{{ asset('images/event.png') }}" class="card-img-top " alt="...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mb-3 border-0 w-100">
                            <img src="{{ asset('images/event.png') }}" class="card-img-top " alt="...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mb-3 border-0 w-100">
                            <img src="{{ asset('images/event.png') }}" class="card-img-top " alt="...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mb-3 border-0 w-100">
                            <img src="{{ asset('images/event.png') }}" class="card-img-top " alt="...">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
