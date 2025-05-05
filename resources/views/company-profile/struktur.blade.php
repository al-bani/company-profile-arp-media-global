@extends('company-profile.Layout.company')

@section('content')
    <div class="container struktur">
        <h4 class="text-center">Struktur Organisasi PT.ARP Global Media</h4>

        <div class="container struktur text-center">
            <div class="row mb-5 d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                    <div class="card">
                        <img src="{{ asset('images/ceo.png') }}" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Budi Santoso</b></h4>
                            <p>CEO AGM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 mb-5 text-center justify-content-center">
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/ceo.png') }}" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Budi Santoso</b></h4>
                            <p>CEO AGM</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/ceo.png') }}" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Budi Santoso</b></h4>
                            <p>CEO AGM</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/ceo.png') }}" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Budi Santoso</b></h4>
                            <p>CEO AGM</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/ceo.png') }}" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Budi Santoso</b></h4>
                            <p>CEO AGM</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
