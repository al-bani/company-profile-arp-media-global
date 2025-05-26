@extends('Layout.layoutAdmin')

<x-layout>
    <div class="mb-2">
        <h4>FAQ Perusahaan</h4>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('faq.create') }}" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ Str::limit($faq->pertanyaan, 50) }}</td>
                                <td>{{ Str::limit($faq->jawaban, 50) }}</td>
                                <td>
                                    <a href="{{ route('faq.edit', $faq->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#detailFaq{{ $loop->iteration }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteFaq{{ $loop->iteration }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Delete -->
            @foreach ($faqs as $faq)
                <div class="modal fade" id="deleteFaq{{ $loop->iteration }}" tabindex="-1"
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
                                <p class="fw-semibold text-danger">Pertanyaan: {{ Str::limit($faq->pertanyaan, 50) }}</p>
                            </div>
                            <div class="modal-footer justify-content-center gap-3 border-0 pb-4">
                                <form action="/dashboard/faq/{{ $faq->id }}" method="POST">
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
            @foreach ($faqs as $faq)
                <div class="modal fade" id="detailFaq{{ $loop->iteration }}" tabindex="-1"
                    aria-labelledby="detailFaqLabel{{ $loop->iteration }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title" id="detailFaqLabel{{ $loop->iteration }}">Detail FAQ</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Pertanyaan</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $faq->pertanyaan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jawaban</label>
                                    <textarea class="form-control" rows="4" readonly>{{ $faq->jawaban }}</textarea>
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

