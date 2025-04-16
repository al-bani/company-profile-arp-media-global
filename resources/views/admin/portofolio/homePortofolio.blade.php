@extends('Layout.layoutAdmin')

<x-layout>
    {{-- Judul --}}
    <div class="mb-2">
        <h4>Portofolio Perusahaan</h4>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/createPortofolio" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Perusahaan</th>
                            <th>ID</th>
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
                        <tr>
                            <td>PSH10000</td>
                            <td>12000</td>
                            <td>Seminar</td>
                            <td>Team 1</td>
                            <td>Daring</td>
                            <td>2011-04-25</td>
                            <td>08.00-09.00</td>
                            <td>Lorem Ipsum blablaba</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>PSH10002</td>
                            <td>12002</td>
                            <td>Seminar 2</td>
                            <td>Team 2</td>
                            <td>Daring</td>
                            <td>2011-04-25</td>
                            <td>08.00-09.00</td>
                            <td>Lorem Ipsum blablaba</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        
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
