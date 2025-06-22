@extends('Layout.layoutAdmin')

<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Struktur Organisasi</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Struktur Organisasi</h6>
        </div>
        <div class="card-body">
            @php $role = $role ?? 'admin'; @endphp
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Ada beberapa masalah dengan input Anda.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($struktur->atasan == '1')
                <form action="{{ route('struktur.update', $struktur->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama">Nama Lengkap</label>
                        <input class="form-control" id="nama" name="nama" type="text"
                            placeholder="Masukkan nama lengkap" value="{{ old('nama', $struktur->nama) }}" required>
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <input class="form-control" id="jabatan" name="jabatan" type="text"
                            placeholder="Masukkan jabatan" value="{{ old('jabatan', $struktur->jabatan) }}" required>
                    </div>

                    <!-- Perusahaan -->
                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                                name="id_perusahaan" id="id_perusahaan" required>
                            @foreach ($perusahaans as $perusahaan)
                                @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                    <option value="{{ $perusahaan->id_perusahaan }}"
                                        {{ old('id_perusahaan', $struktur->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                        {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 text-center mt-4">
                        <a href="{{ route('struktur.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            @else
                <form action="{{ route('struktur.update', $struktur->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama">Nama Lengkap</label>
                        <input class="form-control" id="nama" name="nama" type="text"
                            placeholder="Masukkan nama lengkap" value="{{ old('nama', $struktur->nama) }}" required>
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <input class="form-control" id="jabatan" name="jabatan" type="text"
                            placeholder="Masukkan jabatan" value="{{ old('jabatan', $struktur->jabatan) }}" required>
                    </div>

                    <!-- Perusahaan -->
                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                                name="id_perusahaan" id="id_perusahaan" required>
                            @foreach ($perusahaans as $perusahaan)
                                @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                    <option value="{{ $perusahaan->id_perusahaan }}"
                                        {{ old('id_perusahaan', $struktur->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                        {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Atasan -->
                    <div class="mb-3">
                        <label for="atasan">Melapor Kepada (Atasan)</label>
                        <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                                name="atasan" id="atasan" {{ $struktur->atasan === '0' ? 'disabled' : '' }}>
                            <option value="">-- Tidak Ada Atasan (Posisi Puncak) --</option>
                            @foreach($strukturs as $s)
                                <option value="{{ $s->nama }}"
                                    {{ old('atasan', $struktur->atasan) == $s->nama ? 'selected' : '' }}>
                                    {{ $s->nama }} ({{ $s->jabatan }})
                                </option>
                            @endforeach
                        </select>
                        @if($struktur->atasan === '0')
                            <input type="hidden" name="atasan" value="0">
                        @endif
                    </div>

                    <!-- Foto -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img id="preview" src="{{ asset('images/upload/struktur/'.$struktur->foto) }}" class="card-img-top border" alt="Foto Struktur"
                                style="height: 10rem; width: 10rem; object-fit: cover;">
                        </div>
                        <div class="col">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" id="foto" name="foto" type="file" accept="image/*"
                                onchange="validateFileSize(this)" required>
                        </div>
                    </div>

                    <div class="mb-3 text-center mt-4">
                        <a href="{{ route('struktur.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            @endif

        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function validateFileSize(input) {
            const maxSize = 10 * 1024 * 1024; // 5MB dalam bytes
            const file = input.files[0];

            if (file && file.size > maxSize) {
                alert("Ukuran file tidak boleh lebih dari 5MB!");
                input.value = ''; // Reset input file
                return false;
            }

            // Jika file valid, preview gambar
            if (file) {
                previewImage({ target: input });
            }
        }
    </script>
</x-layout>
