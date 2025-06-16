@extends('company-profile.Layout.company')

@section('content')
    <div class="container struktur">
        <h4 class="text-center">Struktur Organisasi PT.ARP Global Media</h4>

        <div class="container struktur text-center">
            <div class="row mb-5 d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                    @foreach ($strukturs as $struktur)
                        @if ($struktur->atasan === '0' && $struktur->atasan != '1')
                            <div class="card">
                                <img src="{{ asset('images/upload/struktur/'.$struktur->foto) }}" alt="Avatar" style="width:100%">
                                <div class="container">
                                    <h4><b>{!! $struktur->nama !!}</b></h4>
                                    <p>{!! $struktur->jabatan !!}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="row mt-4 mb-5 text-center justify-content-center">
                @foreach ($strukturs as $struktur)
                    @if ($struktur->atasan != '0' && $struktur->atasan != '1')
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('images/upload/struktur/'.$struktur->foto) }}" alt="Avatar" style="width:100%">
                                <div class="container">
                                    <h4><b>{!! $struktur->nama !!}</b></h4>
                                    <p>{!! $struktur->jabatan !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Tabel Data Struktur --}}
             <div class="mt-5">
                <h4 class="text-center mb-4">Data Pegawai</h4>
                <div class="table-responsive">
                    <table id="strukturTable" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($strukturs as $struktur)
                                @if ($struktur->atasan == '1')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $struktur->nama }}</td>
                                        <td>{{ $struktur->jabatan}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script>
        $(document).ready(function () {
            $('#strukturTable').DataTable({
                responsive: true,
                pageLength: 5,
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf', 'print'],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    },
                    buttons: {
                        copy: 'Salin',
                        print: 'Cetak'
                    }
                }
            });
        });
    </script>
@endpush
