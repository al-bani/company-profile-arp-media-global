@extends('Layout.layoutAdmin')

<x-layout>
    {{-- Judul --}}
    <div class="mb-2">
        <h4>Perusahaan</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/perusahaan/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Nama Perusahaan</th>
                            <th>NIB</th>
                            <th>Notaris</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaans as $perusahaan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    @if($perusahaan->logo)
                                        <img src="{{ asset($perusahaan->logo) }}" alt="Logo" width="60">
                                    @endif
                                </td>
                                <td>{{ $perusahaan->nama_perusahaan }}</td>
                                <td>{{ $perusahaan->nib }}</td>
                                <td>{{ $perusahaan->npwp }}</td>
                                <td>
                                    <a href="/dashboard/perusahaan/{{ $perusahaan->id }}/edit"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailPerusahaan{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletePerusahaan{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Delete -->
            @foreach ($perusahaans as $perusahaan)
                <div class="modal fade" id="deletePerusahaan{{ $loop->iteration }}" tabindex="-1"
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
                                <p class="fw-semibold text-danger small">Nama Perusahaan: {{ $perusahaan->nama_perusahaan }}</p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/perusahaan/{{ $perusahaan->id }}" method="POST">
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


            @foreach ($perusahaans as $perusahaan)
                <!-- Modal Detail dengan Textbox -->
                <!-- Modal Detail -->
                <div class="modal fade" id="detailPerusahaan{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailLabel{{ $loop->iteration }}">Detail Perusahaan</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar -->
                                @if ($perusahaan->logo)
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset( $perusahaan->logo) }}"
                                            class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                                    </div>
                                @endif

                                <!-- NIB -->
                                <div class="mb-3">
                                    <label class="form-label">NIB</label>
                                    <input type="text" class="form-control" value="{{ $perusahaan->nib }}" readonly>
                                </div>

                                <!-- Notaris -->
                                <div class="mb-3">
                                    <label class="form-label">Notaris</label>
                                    <input type="text" class="form-control" value="{{ $perusahaan->notaris }}"
                                        readonly>
                                </div>

                                <!-- NPWP -->
                                <div class="mb-3">
                                    <label class="form-label">NPWP</label>
                                    <input type="text" class="form-control" value="{{ $perusahaan->npwp }}"
                                        readonly>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $perusahaan->deskripsi }}</textarea>
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $perusahaan->alamat }}</textarea>
                                </div>

                                <!-- Email & Telp -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{ $perusahaan->email }}"
                                            readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">No Telp</label>
                                        <input type="text" class="form-control"
                                            value="{{ $perusahaan->no_telpon }}" readonly>
                                    </div>
                                </div>

                                <!-- Sosial Media -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control"
                                            value="{{ $perusahaan->instagram }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control"
                                            value="{{ $perusahaan->facebook }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Tiktok</label>
                                        <input type="text" class="form-control" value="{{ $perusahaan->tiktok }}"
                                            readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Twitter</label>
                                        <input type="text" class="form-control"
                                            value="{{ $perusahaan->twitter }}" readonly>
                                    </div>
                                </div>

                                <!-- Moto -->
                                <div class="mb-3">
                                    <label class="form-label">Moto</label>
                                    <input type="text" class="form-control" value="{{ $perusahaan->moto }}"
                                        readonly>
                                </div>

                                <!-- Visi & Misi -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Visi</label>
                                        <input type="text" class="form-control" value="{{ $perusahaan->visi }}"
                                            readonly>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Misi</label>
                                        <input type="text" class="form-control" value="{{ $perusahaan->misi }}"
                                            readonly>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control"
                                        value="{{ ucfirst($perusahaan->status) }}" readonly>
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
        <!-- jQuery dan DataTables -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>

        <!-- Bootstrap Bundle JS (sudah termasuk Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-layout>
