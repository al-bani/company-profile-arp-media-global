@extends('company-profile.Layout.company')

@section('content')
    <img src="{{ asset('images/banner.png') }}" class="berita-web-banner w-100">

    <div class="container berita-web ">


        <h4 class="">Berita</h4>

        <div class="container ">
            <div class="rowberita row g- mb-5">
                <div class=" col-lg-3 ">
                    <div class="card-template">
                        <div class="card-template-img-holder">
                            <img src="{{ asset('images/berita.jpg') }}" alt="Blog image">
                        </div>
                        <h3 class="blog-title">Media Avertising</h3>
                        <span class="blog-time">Monday Jan 20, 2020</span>
                        <p class="description">
                            Jakarta - Iklan hadir di sekitar kita, bersaing untuk menarik perhatian kita dan mempengaruhi
                            keputusan pembelian kita. Sebagian besar perusahaan membuat iklan, tetapi tidak semuanya
                            mencapai hasil yang diharapkan.

                        </p>
                        <div class="options">
                            <span></span>
                            <span>
                                Read More
                            </span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
