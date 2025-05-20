@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>Berita</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/berita/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Penulis</th>
                            <th>Perusahaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ $berita->tanggal }}</td>
                                <td>{{ $berita->penulis }}</td>
                                <td>{{ $berita->perusahaan }}</td>
                                <td>
                                    <a href="/dashboard/berita/{{ $berita->id }}/edit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailBerita{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteBerita{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailBerita{{ $loop->iteration }}" tabindex="-1"
                                aria-labelledby="detailLabel{{ $loop->iteration }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content border-0 rounded-4 shadow">
                                        <div class="modal-header bg-primary text-white rounded-top">
                                            <h5 class="modal-title" id="detailLabel{{ $loop->iteration }}">Detail Berita</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Judul</label>
                                                <input type="text" class="form-control" value="{{ $berita->judul }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal</label>
                                                <input type="text" class="form-control" value="{{ $berita->tanggal }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Penulis</label>
                                                <input type="text" class="form-control" value="{{ $berita->penulis }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Isi Berita</label>
                                                <textarea class="form-control" rows="5" readonly>{{ $berita->isi }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary rounded-pill px-4"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteBerita{{ $loop->iteration }}" tabindex="-1"
                                aria-labelledby="modalDelete{{ $loop->iteration }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow rounded-4">
                                        <div class="modal-header bg-light border-0 rounded-top">
                                            <h5 class="modal-title text-danger fw-bold" id="modalDelete{{ $loop->iteration }}">
                                                <i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus
                                            </h5>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p class="fs-6 mb-1">Yakin ingin menghapus berita ini?</p>
                                            <p class="fw-semibold text-danger small">Judul: {{ $berita->judul }}</p>
                                        </div>
                                        <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                            <form action="/dashboard/berita/{{ $berita->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4 rounded-pill shadow-sm">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-outline-secondary px-4 rounded-pill"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
    @endpush
</x-layout>
