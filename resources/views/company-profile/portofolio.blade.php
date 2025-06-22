@extends('company-profile.Layout.company')

@section('content')
    <link href="{{ asset('css/portofolio.css') }}" rel="stylesheet" type="text/css">
    <div class="container pt-4">
        <h1 class="mb-4">Ongoing</h1>

        <!-- TAMPILAN DESKTOP: Grid -->

        <div class="row d-none d-md-flex">
            @foreach ($portofolios as $portofolio)
                @if ($portofolio->status_project == 'ongoing')
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('portofolio.detail', ['nama_perusahaan' => $perusahaans->nama_perusahaan, 'id' => $portofolio->id]) }}"
                            class="text-decoration-none">
                            <div class="card">
                                <div class="card-inner">
                                    @if ($portofolio->portofolio_foto->isNotEmpty())
                                        @php $firstFoto = $portofolio->portofolio_foto->first(); @endphp
                                        <div class="card-front"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}');">
                                            <div class="overlay p-4">
                                                <h1 class="fst-italic fw-bold h3 text-outlined">
                                                    {{ $portofolio->nama_project }}</h1>
                                            </div>
                                        </div>

                                        <div class="card-back p-4 position-relative"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                            <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                                style="z-index: 1;"></div>
                                            <div class="position-relative" style="z-index: 2;">
                                                <h1 class="fst-italic fw-bold h3 text-white">{{ $portofolio->nama_project }}
                                                </h1>
                                                <p class="fs-6 text-white">
                                                    {!! $portofolio->deskripsi !!}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- TAMPILAN MOBILE: Scroll horizontal -->
        <div class="scroll-container d-md-none">
            <div class="scroll-wrapper">
                @foreach ($portofolios as $portofolio)
                    @if ($portofolio->status_project == 'ongoing')
                        @if ($portofolio->portofolio_foto->isNotEmpty())
                            @php $firstFoto = $portofolio->portofolio_foto->first(); @endphp
                            <a href="{{ route('portofolio.detail', ['nama_perusahaan' => $perusahaans->nama_perusahaan, 'id' => $portofolio->id]) }}"
                                class="text-decoration-none">
                                <div class="card">
                                    <div class="card-inner">
                                        <div class="card-front"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}');">
                                            <div class="overlay p-4">
                                                <h1 class="fst-italic fw-bold h3">{{ $portofolio->nama_project }}</h1>
                                            </div>
                                        </div>
                                        <div class="card-back p-4 position-relative"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                            <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                                style="z-index: 1;"></div>
                                            <div class="position-relative" style="z-index: 2;">
                                                <h1 class="fst-italic fw-bold h3 text-white">
                                                    {{ $portofolio->nama_project }}</h1>
                                                <p class="fs-6 text-white">
                                                    {!! $portofolio->deskripsi !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>

        <h1 class="mb-4">Finish</h1>
        <!-- TAMPILAN DESKTOP: Grid -->
        <div class="row d-none d-md-flex">
            @foreach ($portofolios as $portofolio)
                @if ($portofolio->status_project == 'done')
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('portofolio.detail', ['nama_perusahaan' => $perusahaans->nama_perusahaan, 'id' => $portofolio->id]) }}"
                            class="text-decoration-none">
                            <div class="card">
                                <div class="card-inner">
                                    @if ($portofolio->portofolio_foto->isNotEmpty())
                                        @php $firstFoto = $portofolio->portofolio_foto->first(); @endphp
                                        <div class="card-front"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}');">
                                            <div class="overlay p-4">
                                                <h1 class="fst-italic fw-bold h3 text-outlined">
                                                    {{ $portofolio->nama_project }}</h1>
                                            </div>
                                        </div>
                                        <div class="card-back p-4 position-relative"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                            <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                                style="z-index: 1;"></div>
                                            <div class="position-relative" style="z-index: 2;">
                                                <h1 class="fst-italic fw-bold h3 text-white">
                                                    {{ $portofolio->nama_project }}</h1>
                                                <p class="fs-6 text-white">
                                                    {!! $portofolio->deskripsi !!}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- TAMPILAN MOBILE: Scroll horizontal -->
        <div class="scroll-container d-md-none">
            <div class="scroll-wrapper">
                @foreach ($portofolios as $portofolio)
                    @if ($portofolio->status_project == 'done')
                        @if ($portofolio->portofolio_foto->isNotEmpty())
                            @php $firstFoto = $portofolio->portofolio_foto->first(); @endphp
                            <a href="{{ route('portofolio.detail', ['nama_perusahaan' => $perusahaans->nama_perusahaan, 'id' => $portofolio->id]) }}"
                                class="text-decoration-none">
                                <div class="card">
                                    <div class="card-inner">
                                        <div class="card-front"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}');">
                                            <div class="overlay p-4">
                                                <h1 class="fst-italic fw-bold h3">{{ $portofolio->nama_project }}</h1>
                                            </div>
                                        </div>
                                        <div class="card-back p-4 position-relative"
                                            style="background-image: url('{{ asset('images/upload/portofolio/' . $firstFoto->foto) }}'); background-size: cover; background-position: center;">
                                            <div class="bg-dark bg-opacity-75 position-absolute top-0 start-0 w-100 h-100"
                                                style="z-index: 1;"></div>
                                            <div class="position-relative" style="z-index: 2;">
                                                <h1 class="fst-italic fw-bold h3 text-white">
                                                    {{ $portofolio->nama_project }}</h1>
                                                <p class="fs-6 text-white">
                                                    {!! $portofolio->deskripsi !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
