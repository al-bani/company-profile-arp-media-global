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
                            <th>NIB</th>
                            <th>Notaris</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaans as $perusahaan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $perusahaan->logo }}</td>
                                <td>{{ $perusahaan->nib }}</td>
                                <td>{{ $perusahaan->npwp }}</td>
                                <td>
                                    <a href="/dashboard/perusahaan/{{ $perusahaan->id }}/edit"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1">
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
<div class="modal fade" id="deletePerusahaan{{ $loop->iteration }}" tabindex="-1" aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
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
        <p class="fw-semibold text-danger small">ID: {{ $perusahaan->id }}</p>
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
        <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">
          Batal
        </button>
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
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>

        <!-- Bootstrap Bundle JS (sudah termasuk Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-layout>
