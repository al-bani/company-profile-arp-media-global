@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>Layanan Perusahaan</h4>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/createLayanan" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Perusahaan</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Data --}}
                        @foreach ($layanans as $layanan)
                            
                        
                        <tr>
                            <td>{{ $layanan->id_perusahaan }}</td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>{{ $layanan->deskripsi }}</td>
                            <td>
                                <a href="/dashboard/layanan/edit" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/dashboard/layanan" class="btn btn-info btn-sm me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/dashboard" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                       
                        {{-- @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id_perusahaan }}</td>
                                <td>{{ $item->nama_admin }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telepon }}</td>
                                <td>
                                    @if ($item->status == 'aktif')
                                        <span class="badge bg-success text-white px-4 py-2 fs-6 rounded-pill">Aktif</span>
                                    @else
                                        <span class="badge bg-danger text-white px-4 py-2 fs-6 rounded-pill">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit', $item->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('delete', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
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
