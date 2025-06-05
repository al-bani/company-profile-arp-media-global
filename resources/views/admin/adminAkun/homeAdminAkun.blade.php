@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>Akun Admin</h4>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center"
            role="alert">
            {{ session('error') }}
            <a class="btn-close pe-auto text-black" style="cursor: pointer; text-decoration: none;" data-bs-dismiss="alert"
                aria-label="Close">X</a>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/akunAdmin/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Nama Admin</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{!! $item->perusahaan->nama_perusahaan ?? '<span style="color: red;">Nama Perusahaan Kosong</span>' !!}</td>
                                <td>{!! $item->nama_admin ? $item->nama_admin : '<span style="color: red;">Nama Admin Kosong</span>' !!}</td>
                                <td>{!! $item->email ? $item->email : '<span style="color: red;">Email Kosong</span>' !!}</td>
                                <td>{!! $item->no_telepon ? $item->no_telepon : '<span style="color: red;">No Telepon Kosong</span>' !!}</td>

                                <td>
                                    @if ($item->status == 'aktif')
                                        <span
                                            class="badge bg-success text-white px-4 py-2 fs-6 rounded-pill">Aktif</span>
                                    @else
                                        <span
                                            class="badge bg-danger text-white px-4 py-2 fs-6 rounded-pill">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/dashboard/akunAdmin/{{ $item->id }}/edit"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailAkunAdmin{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteAkunAdmin{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Modal Delete -->
            @foreach ($data as $item)
                <div class="modal fade" id="deleteAkunAdmin{{ $loop->iteration }}" tabindex="-1"
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
                                <p class="fw-semibold text-danger ">Nama admin: {{ $item->nama_admin }}</p>
                                <p class="fw-semibold text-danger ">Nama admin: {{ $item->email }}</p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/akunAdmin/{{ $item->id }}" method="POST">
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
            @foreach ($data as $item)
                <!-- Modal Detail Akun Admin -->
                <div class="modal fade" id="detailAkunAdmin{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailAkunAdminLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailAkunAdminLabel{{ $loop->iteration }}">Detail Akun
                                    Admin</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- Nama Perusahaan -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->perusahaan?->nama_perusahaan ?? 'Nama Perusahaan Kosong' }}"
                                        readonly>


                                </div>

                                <!-- Nama Admin -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Admin</label>
                                    <input type="text" class="form-control" value="{{ $item->nama_admin }}"
                                        readonly>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ $item->email }}" readonly>
                                </div>

                                <!-- No Telepon -->
                                <div class="mb-3">
                                    <label class="form-label">No Telepon</label>
                                    <input type="text" class="form-control" value="{{ $item->no_telepon }}"
                                        readonly>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control" value="{{ ucfirst($item->status) }}"
                                        readonly>
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

    @push('script')
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    @endpush
</x-layout>
