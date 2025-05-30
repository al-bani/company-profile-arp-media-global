@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>Layanan Perusahaan</h4>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/layanan/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="container-fluid">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer; text-decoration: none;"></button>
                </div>
                @endif
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Data --}}
                        @php $role = $role ?? 'admin'; @endphp
                        @foreach ($layanans as $layanan)
                            @if ($role === 'superAdmin' || (isset($layanan->id_perusahaan) && $layanan->id_perusahaan == Auth::user()->id_perusahaan))
                            <tr>
                                <td>{{ $layanan->perusahaan->nama_perusahaan }}</td>
                                <td>{{ $layanan->nama_layanan }}</td>
                                <td>{{ $layanan->deskripsi }}</td>
                                <td>
                                    <a href="/dashboard/layanan/{{ $layanan->id }}/edit"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailLayanan{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteLayanan{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Modal Delete -->
            @foreach ($layanans as $layanan)
                <div class="modal fade" id="deleteLayanan{{ $loop->iteration }}" tabindex="-1"
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
                                <p class="fw-semibold text-danger ">Nama layanan: {{ $layanan->nama_layanan }}</p>
                                <p class="fw-semibold text-danger ">Nama layanan: {{ $layanan->email }}</p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/layanan/{{ $layanan->id }}" method="POST">
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

            @foreach ($layanans as $layanan)
                <!-- Modal Detail Layanan -->
                <div class="modal fade" id="detailLayanan{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailLayananLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailLayananLabel{{ $loop->iteration }}">Detail Layanan
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $layanan->perusahaan->nama_perusahaan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Layanan</label>
                                    <input type="text" class="form-control" value="{{ $layanan->nama_layanan }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $layanan->deskripsi }}</textarea>
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
