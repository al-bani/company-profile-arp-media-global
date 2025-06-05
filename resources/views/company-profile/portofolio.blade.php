@extends('company-profile.Layout.company')

@section('content')
    <link href="{{ asset('css/portofolio.css') }}" rel="stylesheet" type="text/css">
    <img src="{{ asset('images/banner.png') }}" class="berita-web-banner w-100">
    <div class="container pt-4">
        <h1 class="mb-4 ">Ongoing</h1>

        <!-- TAMPILAN DESKTOP: Grid -->
        <div class="row d-none d-md-flex">
            @foreach ($portofolios as $portofolio)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-inner">
                            @if ($portofolio->portofolio_foto->isNotEmpty())
                                @php $firstFoto = $portofolio->portofolio_foto->first(); @endphp
                                <div class="card-front" style="background-image: url('{{ asset($firstFoto->foto) }}');">

                                    <div class="overlay p-4">
                                        <h1 class="fst-italic fw-bold h3 text-outlined">{{ $portofolio->nama_project }}</h1>
                                    </div>
                                </div>


                                <div class="card-back p-4 position-relative"
                                    style="background-image: url('{{ asset($firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                    <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                        style="z-index: 1;"></div>
                                    <div class="position-relative" style="z-index: 2;">
                                        <h1 class="fst-italic fw-bold h3 text-white">{{ $portofolio->nama_project }}</h1>
                                        <p class="fs-6 text-white">
                                            {!! $portofolio->deskripsi !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- TAMPILAN MOBILE: Scroll horizontal -->
        <div class="scroll-container d-md-none">
            <div class="scroll-wrapper">
                @foreach (range(1, 4) as $i)
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front" style="background-image: url('{{ asset('images/test1.jpeg') }}');">
                                <div class="overlay p-4">
                                    <h1 class="fst-italic fw-bold h3">JUDUL PROJECT</h1>
                                </div>
                            </div>
                            <div class="card-back p-4 position-relative"
                                style="background-image: url('{{ asset('images/test1.jpeg') }}'); background-size: cover; background-position: center;">
                                <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                    style="z-index: 1;"></div>
                                <div class="position-relative" style="z-index: 2;">
                                    <h1 class="fst-italic fw-bold h3 text-white">JUDUL PROJECT</h1>
                                    <p class="fs-6 text-white">
                                        Project ini merupakan sebuah inisiatif periklanan modern berupa Billboard Digital
                                        beresolusi tinggi
                                        yang dirancang secara kreatif untuk menarik perhatian publik, dan dipasang secara
                                        strategis di pusat
                                        keramaian kota Bandung guna meningkatkan visibilitas dan daya tarik brand yang
                                        diiklankan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <h1 class="mb-4 ">Finish</h1>
        <!-- TAMPILAN DESKTOP: Grid -->
        <div class="row d-none d-md-flex">
            @foreach ($portofolios as $portofolio)
                <div class="col-md-4 mb-4">
                    <div class="card w-100">
                        <div class="card-inner">
                            @if ($portofolio->portofolio_foto->isNotEmpty())
                            @php $firstFoto = $portofolio->portofolio_foto->first(); @endphp
                                <div class="card-front" style="background-image: url('{{ asset($firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                    <div class="overlay p-4">
                                        <h1 class="fst-italic fw-bold h3">{{ $portofolio->nama_project }}</h1>
                                    </div>
                                </div>
                                <div class="card-back p-4 position-relative"
                                    style="background-image: url('{{ asset($firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                    <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                        style="z-index: 1;"></div>
                                    <div class="position-relative" style="z-index: 2;">
                                        <h1 class="fst-italic fw-bold h3 text-white">{{ $portofolio->nama_project }}</h1>
                                        <p class="fs-6 text-white">
                                            {!!$portofolio->deskripsi!!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- TAMPILAN MOBILE: Scroll horizontal -->
        <div class="scroll-container d-md-none">
            <div class="scroll-wrapper">
                @foreach (range(1, 4) as $i)
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front" style="background-image: url('{{ asset('images/test1.jpeg') }}');">
                                <div class="overlay p-4">
                                    <h1 class="fst-italic fw-bold h3">JUDUL PROJECT</h1>
                                </div>
                            </div>
                            <div class="card-back p-4 position-relative"
                                style="background-image: url('{{ asset('images/test1.jpeg') }}'); background-size: cover; background-position: center;">
                                <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                    style="z-index: 1;"></div>
                                <div class="position-relative" style="z-index: 2;">
                                    <h1 class="fst-italic fw-bold h3 text-white">JUDUL PROJECT</h1>
                                    <p class="fs-6 text-white">
                                        Project ini merupakan sebuah inisiatif periklanan modern berupa Billboard Digital
                                        beresolusi tinggi
                                        yang dirancang secara kreatif untuk menarik perhatian publik, dan dipasang secara
                                        strategis di pusat
                                        keramaian kota Bandung guna meningkatkan visibilitas dan daya tarik brand yang
                                        diiklankan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
