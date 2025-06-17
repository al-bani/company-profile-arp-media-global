@extends('company-profile.Layout.company')

{{-- Content --}}
@section('content')
    <div class="container-fluid ">
        <div class="text-center ">

            {{-- bagian header --}}
            <div class="row detail-header">
                <div class="col-lg-4 mt-5 mb-4">
                    <img src="{{ asset('images/upload/logo/primary/'.$perusahaans->logo_utama) }}" alt="" class="logo-detail mb-5 w-50">
                </div>
                <div class="col-lg-8 mt-4 text-start pe-5 mb-4">
                    <h3  class="h1 bold"> {{ $perusahaans->nama_perusahaan }} </h3>
                    <p class="fs-4">{{ $perusahaans->deskripsi }}</p>
                </div>
            </div>

            {{-- Ucapan Terimakasih --}}
            <div class="container-fluid d-flex justify-content-center terimakasih mb-5 mt-3">
                <div class="row align-items-center w-75">
                    <div class="col-lg-4 col-md-4 mt-4 d-flex justify-content-center">
                        <div class="card w-100 border-0">
                            <img src="{{ asset('images/ceo.png') }}" alt="Avatar">
                            <div class="container">
                                <h4 class="mt-2"><b>Budi Santoso</b></h4>
                                <p>CEO AGM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 mt-4 text-start pe-4 text-terimakasih">
                        <h2 class="text-center">Harapan & Terimakasih!</h2>
                        <p style="text-align: justify;">
                            Kami mengucapkan terima kasih sebesar-besarnya atas kepercayaan dan dukungan yang telah
                            diberikan. Setiap langkah yang kami tempuh tidak akan berarti tanpa kolaborasi, kerja keras, dan
                            semangat bersama.
                            Ke depan, kami berharap dapat terus berkembang, berinovasi, dan memberikan yang terbaik. Semoga
                            perjalanan ini membawa manfaat bagi banyak orang dan membuka peluang baru untuk masa depan yang
                            lebih baik.

                            Mari kita terus melangkah bersama menuju kesuksesan yang lebih besar. Terima kasih!
                        </p>
                    </div>
                </div>
            </div>


            {{-- highlight --}}
            <div class="container-fluid w-75 mt-4 detail-highlight mb-5">
                <div class="row text-center">
                    <!-- Highlight 1 -->
                    <div class="highlight1 col-lg-4 ">
                        <p class="mt-2">Dipercaya oleh</p>
                        <h2 class=" d-inline ">200</h2>
                        <span class=""> Client</span>
                    </div>

                    <!-- Highlight 2 -->
                    <div class="highlight2 col-lg-4 ">
                        <p class="mt-2">Jumlah Jasa</p>
                        <h2 class=" ">8 Jasa</h2>
                    </div>

                    <!-- Highlight 3 -->
                    <div class="highlight3 col-lg-4 ">
                        <p class="mt-2">Jumlah Perusahaan</p>
                        <h2 class=" ">9</h2>
                    </div>
                </div>
            </div>

            {{-- moto --}}
            <div class="moto container-fluid d-flex justify-content-center mt-5">
                <div class="row g-4 px-5 w-100 justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                        <div class="card border-0" style="width: 100%; max-width: 21rem;">
                            <img src="{{ asset('images/integrasi.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b>Terintegrasi</b></h5>
                                <p class="card-text">Kami selalu menjunjung tinggi kejujuran dan nilai-nilai etika dalam
                                    setiap langkah yang kami ambil.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                        <div class="card border-0" style="width: 100%; max-width: 21rem;">
                            <img src="{{ asset('images/profesional.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b>Profesional</b></h5>
                                <p class="card-text">Kami mengutamakan kualitas, ketepatan, dan tanggung jawab dalam setiap
                                    pekerjaan yang kami lakukan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                        <div class="card border-0" style="width: 100%; max-width: 21rem;">
                            <img src="{{ asset('images/berdedikasi.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b>Berdedikasi</b></h5>
                                <p class="card-text">Kami berkomitmen penuh untuk memberikan yang terbaik dengan kerja keras
                                    dan semangat yang tinggi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
