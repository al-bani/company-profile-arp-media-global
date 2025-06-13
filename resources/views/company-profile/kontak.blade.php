@extends('company-profile.Layout.company')

@section('content')
    <div class="container kontak">
        <h3 class="text-center">Kontak Kami</h3>

        <div class="container struktur text text-center">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.580496655258!2d107.6218472750902!3d-6.940634293059432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e862553b7bf3%3A0x7b959ac165b2bdc7!2sJl.%20Zamrud%20No.19%2C%20Cijagra%2C%20Kec.%20Lengkong%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040265!5e0!3m2!1sid!2sid!4v1742114960647!5m2!1sid!2sid"
                style="border:0;" allowfullscreen="" loading="lazy" class="google-map"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        {{-- bawah --}}
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <h4 class="mt-3"><b>Alamat Perusahaan</b></h4>
                    <p>{!!$perusahaans->alamat_perusahaan!!}</p>
                    <p style="margin-top: -14px">Telp:{!!$perusahaans->no_telpon!!}</p>
                    <p style="margin-top: -14px">Fax: {!!$perusahaans->no_telpon!!}</p>
                    <h4 class="mt-3"><b>Alamat Kantor</b></h4>
                    <p>{!!$perusahaans->alamat_kantor!!}</p>
                    <p style="margin-top: -14px">Telp: {!!$perusahaans->no_telpon!!}</p>
                    <p style="margin-top: -14px">Fax: {!!$perusahaans->no_telpon!!}</p>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-8 shadow">
                    <form action="/kontak/{{ $perusahaans->nama_perusahaan }}" method="post">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" id="nama" name="nama" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Email</label>
                            <input class="form-control" type="email" id="email" name="email" rows="3"></input>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="3"></textarea>
                        </div>
                        <div class="mb-4 ">
                            <input class="btn btn-primary w-100 text-white bg-black border-0" type="submit" value="Submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
