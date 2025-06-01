@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>Struktur Organisasi</h4>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/struktur/create" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="container-fluid">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer; text-decoration: none;"></button>
                </div>
                @endif

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
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Perusahaan</th>
                            <th>Atasan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $role = $role ?? 'admin'; @endphp
                        @foreach ($strukturs as $struktur)
                            @if ($role === 'superAdmin' || (isset($struktur->id_perusahaan) && $struktur->id_perusahaan == Auth::user()->id_perusahaan))
                            <tr>
                                <td>{{ $struktur->nama }}</td>
                                <td>{{ $struktur->jabatan }}</td>
                                <td>{{ $struktur->perusahaan->nama_perusahaan ?? '-' }}</td>
                                @if ($struktur->atasan == '0')
                                    <td>Posisi Tertinggi (tidak ada atasan)</td>
                                @else
                                    <td>{{ $struktur->atasan }}</td>
                                @endif
                                <td>
                                    <a href="/dashboard/struktur/{{ $struktur->id }}/edit"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailStruktur{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteStruktur{{ $loop->iteration }}">
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
            @foreach ($strukturs as $struktur)
                <div class="modal fade" id="deleteStruktur{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <div class="modal-header bg-danger text-white border-0 rounded-top">
                                <h5 class="modal-title fw-bold" id="modalLabel{{ $loop->iteration }}">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center py-4">
                                <p class="fs-6 mb-3">Apakah Anda yakin ingin menghapus data berikut?</p>
                                <div class="alert alert-danger">
                                    <p class="mb-1"><strong>Nama:</strong> {{ $struktur->nama }}</p>
                                    <p class="mb-1"><strong>Jabatan:</strong> {{ $struktur->jabatan }}</p>
                                    <p class="mb-0"><strong>Perusahaan:</strong> {{ $struktur->perusahaan->nama_perusahaan ?? '-' }}</p>
                                </div>
                                <p class="text-danger mt-3"><i class="fas fa-info-circle me-1"></i>Data yang dihapus tidak dapat dikembalikan!</p>
                            </div>
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/struktur/{{ $struktur->id }}" method="POST">
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
            @foreach ($strukturs as $struktur)
                <div class="modal fade" id="detailStruktur{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailStrukturLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailStrukturLabel{{ $loop->iteration }}">Detail Struktur Organisasi</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $struktur->nama }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" value="{{ $struktur->jabatan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    @if($struktur->foto)
                                        <img src="{{ asset($struktur->foto) }}" alt="Foto" class="img-fluid rounded">
                                    @else
                                        <p>Tidak ada foto</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Perusahaan</label>
                                    <input type="text" class="form-control" value="{{ $struktur->perusahaan->nama_perusahaan ?? '-' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Atasan</label>
                                    <input type="text" class="form-control" value="{{ $struktur->atasan == '0' ? 'Posisi Tertinggi (tidak ada atasan)' : $struktur->atasan }}" readonly>
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
