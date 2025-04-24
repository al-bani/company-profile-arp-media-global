@extends('layout.company')

@section('content')
    <div class="container layanan-web">
        <h3 class="text-center">Layanan Kami</h3>

        <div class="container">
            <div class="row mt-5 d-flex align-items-center gap-3">
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <img src="{{ asset('images/event.png') }}" alt="" class="w-100">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-7">
                    <h4> <b> Event </b></h4>
                    <p>Perusahaan kami telah berpengalaman dalam merancang dan menyelenggarakan acara untuk kegiatan
                        Coorporate, Brand Activity maupun Pemerintahan.

                        Kami siap membantu perusahaan anda dari konsep hingga eksekusi dengan perencanaan yang matang secara
                        profesional agar memberikan hasil yang sesuai dengan yang diharapkan.</p>
                </div>
            </div>

            <div class="row mt-5 d-flex align-items-center gap-3">
                <div class="col-sm-12 col-md-6 col-lg-7">
                    <h4> <b> Media Adversting</b> </h4>
                    <p>PT.ATP Global Media sangat terbuka untuk membantu perusahaan anda dalam mengelola program publikasi
                        di media manapun. Baik di Media Elektronik, Media Cetak, Media Online, dan Media Luar Ruang

                        Perusahaan kami sering bekerja sama dengan media-media lokal maupun nasional, dan siap menjadi Mitra
                        Terbaik bagi perusahaan anda.</p>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <img src="{{ asset('images/media.png') }}" alt="" class="w-100">
                </div>
            </div>

            <div class="row mt-5 d-flex align-items-center gap-3">
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <img src="{{ asset('images/sampah.png') }}" alt="" class="w-100">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-7">
                    <h4> <b> Pengelolaan Sampah </b></h4>
                    <p>Perusahaan kami telah berpengalaman dalam merancang dan menyelenggarakan acara untuk kegiatan
                        Coorporate, Brand Activity maupun Pemerintahan.

                        Kami siap membantu perusahaan anda dari konsep hingga eksekusi dengan perencanaan yang matang secara
                        profesional agar memberikan hasil yang sesuai dengan yang diharapkan.</p>
                </div>
            </div>
        </div>

    </div>
@endsection
