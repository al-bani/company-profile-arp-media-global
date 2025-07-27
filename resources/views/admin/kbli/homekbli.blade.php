@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>KBLI Perusahaan</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/kbli/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode KBLI</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            @if($role === 'superAdmin')
                                <th>Perusahaan</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kblis as $kbli)
                            <tr>
                                <td>{{ $kbli->kode_kbli }}</td>
                                <td>{{ Str::limit($kbli->judul, 50) }}</td>
                                <td>{{ $kbli->kategori }}</td>
                                @if($role === 'superAdmin')
                                    <td>{{ $kbli->perusahaan->nama_perusahaan ?? '-' }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('kbli.edit', $kbli->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailkbli{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletekbli{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Delete -->
            @foreach ($kblis as $kbli)
                <div class="modal fade" id="deletekbli{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <div class="modal-header bg-light border-0 rounded-top">
                                <h5 class="modal-title text-danger fw-bold" id="modalLabel{{ $loop->iteration }}">
                                    <i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus
                                </h5>
                            </div>
                            <div class="modal-body text-center">
                                <p class="fs-6 mb-1">Apakah Anda yakin ingin menghapus data berikut?</p>
                                <p class="fw-semibold text-danger">Kode KBLI: {{ $kbli->kode_kbli }}</p>
                                <p class="fw-semibold">Judul: {{ $kbli->judul }}</p>
                            </div>
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/kbli/{{ $kbli->id }}" method="POST">
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

            <!-- Modal Detail -->
            @foreach ($kblis as $kbli)
                <div class="modal fade" id="detailkbli{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailkbliLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailkbliLabel{{ $loop->iteration }}">Detail KBLI</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kode KBLI</label>
                                    <input class="form-control" value="{{ $kbli->kode_kbli }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Judul</label>
                                    <input class="form-control" value="{{ $kbli->judul }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kategori</label>
                                    <input class="form-control" value="{{ $kbli->kategori }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control" rows="4" readonly>{{ $kbli->deskripsi }}</textarea>
                                </div>
                                @if($role === 'superAdmin')
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Perusahaan</label>
                                        <input class="form-control" value="{{ $kbli->perusahaan->nama_perusahaan ?? '-' }}" readonly />
                                    </div>
                                @endif
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


