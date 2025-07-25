@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>Berita Perusahaan</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
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
                <a href="/dashboard/berita/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Perusahaan</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $role = $role ?? 'admin'; @endphp
                        @foreach ($beritas as $berita)
                            @if ($role === 'superAdmin' || (isset($berita->id_perusahaan) && $berita->id_perusahaan == Auth::user()->id_perusahaan))
                                <tr>

                                    <td>
                                        {!! $berita->judul ?? '<span style="color: red;">Judul Kosong</span>' !!}
                                    </td>

                                    <td>
                                        {!! $berita->penulis ?? '<span style="color: red;">Penulis Kosong</span>' !!}
                                    </td>

                                    <td>
                                        {!! $berita->id_perusahaan ?? '<span style="color: red;">ID Perusahaan Kosong</span>' !!}
                                    </td>

                                    <td>
                                        {!! $berita->tanggal ?? '<span style="color: red;">Tanggal Kosong</span>' !!}
                                    </td>

                                    <td>
                                        <a href="{{ route('berita.edit', $berita->id) }}"
                                            class="btn btn-warning btn-sm">
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
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Modal Delete -->
            @foreach ($beritas as $berita)
                <div class="modal fade" id="deleteBerita{{ $loop->iteration }}" tabindex="-1"
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
                                <p class="fw-semibold text-danger ">Judul berita: {{ $berita->judul }}</p>
                                <p class="fw-semibold text-danger ">ID berita: {{ $berita->id_berita }}</p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/berita/{{ $berita->id }}" method="POST">
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
            @foreach ($beritas as $berita)
                <!-- Modal Detail Berita -->
                <div class="modal fade" id="detailBerita{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailBeritaLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailBeritaLabel{{ $loop->iteration }}">Detail Berita</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- ID Berita -->
                                <div class="mb-3">
                                    <label class="form-label">ID Berita</label>
                                    <input type="text" class="form-control" value="{{ $berita->id_berita }}"
                                        readonly>
                                </div>

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" value="{{ $berita->judul }}" readonly>
                                </div>

                                <!-- Penulis -->
                                <div class="mb-3">
                                    <label class="form-label">Penulis</label>
                                    <input type="text" class="form-control" value="{{ $berita->penulis }}" readonly>
                                </div>

                                <!-- Perusahaan -->
                                <div class="mb-3">
                                    <label class="form-label">Perusahaan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $berita->perusahaan->nama_perusahaan ?? $berita->id_perusahaan }}"
                                        readonly>
                                </div>

                                <!-- Tanggal -->
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" value="{{ $berita->tanggal }}" readonly>
                                </div>
                                @foreach ($beritaFotos as $foto)
                                    @if ($foto->id_berita === $berita->id_berita)
                                        <label for="foto" class="form-label">Judul Foto:
                                            {{ $foto->judul_foto }}</label>
                                        <div class="mb-3 ">
                                            <img src="{{ asset($foto->foto) }}" class="img-fluid rounded shadow-sm"
                                                style="max-height: 120px;">
                                        </div>
                                    @endif
                                @endforeach


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
