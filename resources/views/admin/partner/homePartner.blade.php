@extends('Layout.layoutAdmin')

<x-layout>
    {{-- Judul --}}
    <div class="mb-2">
        <h4>Partner</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="/dashboard/createPartner" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NamaPartner</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Data --}}
                        @foreach ($partners as $partner)
                            <tr>
                                <td>{{ $partner->nama_partner }}</td>
                                <td>{{ $partner->email }}</td>
                                <td>
                                    <!-- {{-- contoh tampilkan logo --}} -->
                                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="Logo" width="50">
                                </td>


                                <td>
                                    <a href="/dashboard/partner/edit" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailPartner{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
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

    @foreach ($partners as $partner)
        <!-- Modal Detail dengan Textbox -->
        <!-- Modal Detail -->
        <div class="modal fade" id="detailPartner{{ $loop->iteration }}" tabindex="-1"
            aria-labelledby="detailLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header bg-primary text-white rounded-top">
                        <h5 class="modal-title" id="detailLabel{{ $loop->iteration }}">Detail Partner</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nama Partner -->
                        <div class="mb-3">
                            <label class="form-label">Nama Partner</label>
                            <input type="text" class="form-control" value="{{ $partner->nama_partner }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $partner->email }}" readonly>
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

    @push('script')
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    @endpush
</x-layout>
