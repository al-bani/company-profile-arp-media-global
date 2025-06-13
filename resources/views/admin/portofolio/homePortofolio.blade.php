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
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center"
                        role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="cursor: pointer; text-decoration: none;"></button>
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
                                <td>
                                    {!! $portofolio->id_portofolio ?? '<span style="color: red;">ID Portofolio Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->perusahaan->nama_perusahaan ?? '<span style="color: red;">Nama Perusahaan Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->nama_project ?? '<span style="color: red;">Nama Project Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->team ?? '<span style="color: red;">Team Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->tempat ?? '<span style="color: red;">Tempat Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->tanggal ?? '<span style="color: red;">Tanggal Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->waktu ?? '<span style="color: red;">Waktu Kosong</span>' !!}
                                </td>

                                <td>
                                    {!! $portofolio->deskripsi ?? '<span style="color: red;">Deskripsi Kosong</span>' !!}
                                </td>

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
                                @if (!empty($portofolio->foto))
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('storage/' . $portofolio->foto) }}"
                                            class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                                    </div>
                                @else
                                    <div class="mb-3 text-center">
                                        <span style="color: red;">Foto dokumentasi belum tersedia</span>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label">ID Portofolio</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->id_portofolio ?? '<span style="color: red;">ID Portofolio Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Perusahaan</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->perusahaan->nama_perusahaan ?? '<span style="color: red;">Nama Perusahaan Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Project</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->nama_project ?? '<span style="color: red;">Nama Project Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Team</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->team ?? '<span style="color: red;">Team Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tempat</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->tempat ?? '<span style="color: red;">Tempat Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->tanggal ?? '<span style="color: red;">Tanggal Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Waktu</label>
                                    <div class="form-control" readonly>
                                        {!! $portofolio->waktu ?? '<span style="color: red;">Waktu Kosong</span>' !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    @if (!empty($portofolio->deskripsi))
                                        <textarea class="form-control" rows="3" readonly>{{ $portofolio->deskripsi }}</textarea>
                                    @else
                                        <span style="color: red;">Deskripsi Kosong</span>
                                    @endif
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
