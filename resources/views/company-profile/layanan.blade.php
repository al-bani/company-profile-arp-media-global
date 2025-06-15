@extends('company-profile.Layout.company')

@section('content')
    <div class="container layanan-web">
        <h3 class="text-center">Layanan Kami</h3>

        <div class="container">
            @foreach ($layanans as $layanan)
                @if ($layanan->id_perusahaan % 2 == 0)
                <div class="row mt-5 d-flex align-items-center gap-3">
                    <div class="col-sm-12 col-md-6 col-lg-7">
                        <h4> <b>{{ $layanan->nama_layanan }}</b> </h4>
                        <p>{{ $layanan->deskripsi }}</p>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-4">
                        <img src="{{ asset($layanan->foto) }}" alt="" class="w-100">
                    </div>
                </div>
                @else
                <div class="row mt-5 d-flex align-items-center gap-3">
                    <div class="col-sm-12 col-md-5 col-lg-4">
                        <img src="{{ asset($layanan->foto) }}" alt="" class="w-100">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-7">
                        <h4> <b>{{ $layanan->nama_layanan }}</b> </h4>
                        <p>{{ $layanan->deskripsi }}</p>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

