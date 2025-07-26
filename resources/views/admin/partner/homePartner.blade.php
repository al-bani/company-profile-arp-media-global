@extends('Layout.layoutAdmin')

<x-layout>
    {{-- Judul --}}
    <div class="mb-2">
        <h4>Partner Perusahaan</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="container-fluid">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center"
                role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                    style="cursor: pointer; text-decoration: none;"></button>
            </div>
        @endif
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/partner/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NamaPartner</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Data --}}
                        @php $role = $role ?? 'admin'; @endphp
                        @foreach ($partners as $partner)
                            @if (
                                $role === 'superAdmin' ||
                                    (isset($partner->id_perusahaan) && $partner->id_perusahaan == Auth::user()->id_perusahaan))
                                <tr>
                                    <td>{{ $partner->nama_partner }}</td>
                                    <td>{{ $partner->email }}</td>
                                    <td>
                                        @if ($partner->foto)
                                            <img src="{{ asset('images/upload/partner/'.$partner->foto) }}" alt="Logo" width="100">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/dashboard/partner/{{ $partner->id }}/edit"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#detailPartner{{ $loop->iteration }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletePartner{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            @foreach ($partners as $partner)
                <!-- Modal Detail Partner -->
                <div class="modal fade" id="detailPartner{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailLabel{{ $loop->iteration }}">Detail Partner</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                {{-- Logo --}}
                                @if ($partner->foto)
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset($partner->foto) }}" class="img-fluid rounded shadow-sm"
                                            style="max-height: 150px;" alt="Logo Partner">
                                    </div>
                                @else
                                    <div class="mb-3 text-center">
                                        <span style="color: red;">Logo Partner belum tersedia</span>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label">Nama Partner</label>
                                    <div class="form-control" readonly>
                                        {!! $partner->nama_partner ?? '<span style="color: red;">Nama Partner Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="form-control" readonly>
                                        {!! $partner->email ?? '<span style="color: red;">Email Partner Kosong</span>' !!}
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary rounded-pill px-4"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Modal Delete -->
    @foreach ($partners as $partner)
        <div class="modal fade" id="deletePartner{{ $loop->iteration }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">

                    <!-- Modal Header -->
                    <div class="modal-header bg-light border-0 rounded-top">
                        <h5 class="modal-title text-danger fw-bold" id="modalLabel{{ $loop->iteration }}">
                            <i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus
                        </h5>

                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body text-center">
                        <p class="fs-6 mb-1">Apakah Anda yakin ingin menghapus data berikut?</p>
                        <p class="fw-semibold text-danger small">Nama partner:
                            {{ $partner->nama_partner }}</p>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                        <form action="/dashboard/partner/{{ $partner->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger px-4 rounded-pill shadow-sm">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </button>
                        </form>
                        <button type="button" class="btn btn-outline-secondary px-4 rounded-pill"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($partners as $partner)
        <div class="modal fade" id="deletePartner{{ $loop->iteration }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">

                    <!-- Modal Header -->
                    <div class="modal-header bg-light border-0 rounded-top">
                        <h5 class="modal-title text-danger fw-bold" id="modalLabel{{ $loop->iteration }}">
                            <i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus
                        </h5>

                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body text-center">
                        <p class="fs-6 mb-1">Apakah Anda yakin ingin menghapus data berikut?</p>
                        <p class="fw-semibold text-danger ">Nama Partner: {{ $partner->nama_partner }}</p>
                        <p class="fw-semibold text-danger ">Nama Partner: {{ $partner->email }}</p>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                        <form action="/dashboard/partner/{{ $partner->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger px-4 rounded-pill shadow-sm">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </button>
                        </form>
                        <button type="button" class="btn btn-outline-secondary px-4 rounded-pill"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    @foreach ($partners as $partner)
        <!-- Modal Detail dengan Textbox -->
        <!-- Modal Detail -->
        <div class="modal fade" id="detailPartner{{ $loop->iteration }}" tabindex="-1"
            aria-labelledby="detailLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header bg-primary text-white rounded-top">
                        <h5 class="modal-title" id="detailLabel{{ $loop->iteration }}">Detail Partner</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Logo Partner</label>
                            @if ($partner->foto)
                                <img src="{{ asset($partner->foto) }}" alt="Logo" class="w-100">
                            @endif
                        </div>
                        <!-- Nama Partner -->

                        <div class="mb-3">
                            <label class="form-label">Nama Partner</label>
                            <input type="text" class="form-control" value="{{ $partner->nama_partner }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $partner->email }}" readonly>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('script')
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    @endpush
</x-layout>
