@extends('Layout.layoutAdmin')

<x-layout>
    <div class="container mt-4">

        {{-- Flash message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Card 1: Upload Form + Preview --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upload Gambar</h5>
            </div>
            <div class="card-body">
                <form action="/dashboard/uploader" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Pilih Gambar</label>
                        <input class="form-control" type="file" id="image" name="foto" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="mb-3">
                        <img id="preview" src="#" alt="Preview Gambar" class="img-thumbnail d-none" style="max-height: 200px;">
                    </div>
                    <button type="submit" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>

        {{-- Card 2: Tabel Gambar --}}
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Daftar Gambar</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Preview</th>
                            <th>Url File</th>
                            <th>Uploaded At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($images as $index => $img)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('images/upload/' . $img->foto) }}" width="100" class="img-thumbnail">
                                </td>
                                <td><a href="{{ url('/') . '/images/upload/'.$img->foto }}" target="_blank">{{ url('/') . '/images/upload/'.$img->foto }}</a></td>
                                <td>{{ $img->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <form action="/dashboard/uploader/{{ $img->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada gambar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Script Preview --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('preview');
            reader.onload = () => {
                preview.src = reader.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
