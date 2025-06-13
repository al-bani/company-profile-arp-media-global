@extends('company-profile.Layout.company')

@section('content')
    <div class="container kontak">
        <h3 class="text-center">Kontak Kami</h3>

        <div class="container struktur text text-center">
            <iframe
                src="{{$perusahaans->maps}}"
                style="border:0;" allowfullscreen="" loading="lazy" class="google-map"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>


        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <h4 class="mt-3"><b>Alamat Perusahaan</b></h4>
                    <p>{!! $perusahaans->alamat_perusahaan !!}</p>
                    <p style="margin-top: -14px">Telp: {!! $perusahaans->no_telpon !!}</p>
                    <p style="margin-top: -14px">Fax: {!! $perusahaans->no_telpon !!}</p>

                    <h4 class="mt-3"><b>Alamat Kantor</b></h4>
                    <p>{!! $perusahaans->alamat_kantor !!}</p>
                    <p style="margin-top: -14px">Telp: {!! $perusahaans->no_telpon !!}</p>
                    <p style="margin-top: -14px">Fax: {!! $perusahaans->no_telpon !!}</p>
                </div>

                <div class="col-sm-12 col-md-7 col-lg-8 shadow">
                    <form action="/kontak/{{ $perusahaans->nama_perusahaan }}" method="post">
                        @csrf

                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" id="nama" name="nama" placeholder="Nama Anda" value="{{ old('nama') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="3">{{ old('pesan') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <input class="btn btn-primary w-100 text-white bg-black border-0" type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
