@extends('Layout.layoutAdmin')

<x-layout>
    {{-- Judul --}}
    <div class="mb-2">
        <h4>Portofolio Perusahaan</h4>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/createPortofolio" class="btn btn-primary">+ Tambah Data</a>
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
                                <td>{{$portofolio->id_portofolio}}</td>
                                <td>{{$portofolio->perusahaan->nama_perusahaan}}</td>
                                <td>{{$portofolio->nama_project}}</td>
                                <td>{{$portofolio->team}}</td>
                                <td>{{$portofolio->tempat}}</td>
                                <td>{{$portofolio->tanggal}}</td>
                                <td>{{$portofolio->waktu}}</td>
                                <td>{{$portofolio->deskripsi}}</td>
                                <td>
                                    <a href="/dashboard/portofolio/edit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
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
