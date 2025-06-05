@extends('company-profile.Layout.company')

@section('content')
    <img src="{{ asset('images/banner.png') }}" class="berita-web-banner w-100">

    <div class="container berita-web ">


        <h4 class="">Berita</h4>

        <div class="container ">
            <div class="rowberita row g- mb-5">
                <div class=" col-lg-3 ">
                    @foreach ($beritas as $berita)
                        <div class="card-template">
                            <div class="card-template-img-holder">
                                <img src="{{ asset($berita->foto) }}" alt="Blog image">
                            </div>
                            <h3 class="blog-title">{{ $berita->judul }}</h3>
                            <span class="blog-time">{{$berita->tanggal}}</span>
                            <p class="description">
                              {!!$berita->konte!!}

                            </p>
                            <div class="options">
                                <span></span>
                                <span>
                                    Read More
                                </span>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- @foreach ($beritas as $berita)
    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset($berita->foto) }}" class="card-img-top" alt="Berita">
                            <div class="card-body">
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text"><small class="text-muted">{!! $berita->tanggal !!}</small></p>
                                <p class="card-text">{!! $berita->konten !!}</p>
                                <a href="#" class="btn btn-outline-primary btn-sm">Read Full Blog</a>
                            </div>
                        </div>
                    </div>
    @endforeach -->
@endsection
