@extends('Layout.layoutAdmin')

<x-layout>
    {{-- Judul --}}
    <div class="mb-2">
        <h4>Portofolio Perusahaan</h4>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/portofolio/create" class="btn btn-primary">+ Tambah Data</a>
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
                            <th>ID Portofolio</th>
                            <th>Perusahaan</th>
                            <th>Nama Project</th>
                            <th>Team</th>
                            <th>Tempat</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($portofolios as $portofolio)
                            <tr>
                                <td>{{ $portofolio->id_portofolio }}</td>
                                <td>{{ $portofolio->perusahaan->nama_perusahaan }}</td>
                                <td>{{ $portofolio->nama_project }}</td>
                                <td>{{ $portofolio->team }}</td>
                                <td>{{ $portofolio->tempat }}</td>
                                <td>{{ $portofolio->tanggal }}</td>
                                <td>{{ $portofolio->waktu }}</td>
                                <td>{{ $portofolio->deskripsi }}</td>
                                <td>
                                    <a href="/dashboard/portofolio/{{ $portofolio->id }}/edit"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailPortofolio{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletePortofolio{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- Modal Delete -->
            @foreach ($portofolios as $portofolio)
                <div class="modal fade" id="deletePortofolio{{ $loop->iteration }}" tabindex="-1"
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
                                <p class="fw-semibold text-danger small">Nama portofolio:
                                    {{ $portofolio->nama_portofolio }}</p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/portofolio/{{ $portofolio->id }}" method="POST">
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


            @foreach ($portofolios as $portofolio)
                <!-- Modal Detail -->
                <div class="modal fade" id="detailPortofolio{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailLabel{{ $loop->iteration }}">Detail Portofolio</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                {{-- Gambar (jika ada) --}}
                                @if ($portofolio->foto)
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('storage/' . $portofolio->foto) }}"
                                            class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label">ID Portofolio</label>
                                    <input type="text" class="form-control" value="{{ $portofolio->id_portofolio }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Perusahaan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $portofolio->perusahaan->nama_perusahaan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Project</label>
                                    <input type="text" class="form-control" value="{{ $portofolio->nama_project }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Team</label>
                                    <input type="text" class="form-control" value="{{ $portofolio->team }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tempat</label>
                                    <input type="text" class="form-control" value="{{ $portofolio->tempat }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" value="{{ $portofolio->tanggal }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Waktu</label>
                                    <input type="text" class="form-control" value="{{ $portofolio->waktu }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $portofolio->deskripsi }}</textarea>
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
