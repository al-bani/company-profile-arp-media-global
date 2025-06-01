@extends('Layout.layoutAdmin')

<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Struktur Perusahaan</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Data Struktur Perusahaan</h6>
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

            <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama">Nama Lengkap</label>
                    <input class="form-control" id="nama" name="nama" type="text"
                           placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                </div>

                <!-- Jabatan -->
                <div class="mb-3">
                    <label for="jabatan">Jabatan</label>
                    <input class="form-control" id="jabatan" name="jabatan" type="text"
                           placeholder="Masukkan jabatan" value="{{ old('jabatan') }}" required>
                </div>

                <!-- Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                            name="id_perusahaan" id="id_perusahaan" required onchange="checkTopPosition(this.value)">
                        @foreach ($perusahaans as $perusahaan)
                            @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}"
                                    {{ old('id_perusahaan', $selectedPerusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
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
                            name="atasan" id="atasan" {{ $isFirstData || !$hasTopPosition ? 'disabled' : '' }}>
                        @if($isFirstData || !$hasTopPosition)
                            <option value="0" selected>-- Posisi Puncak (Tidak Ada Atasan) --</option>
                        @else
                            <option value="">-- Tidak Ada Atasan (Posisi Puncak) --</option>
                            @foreach($strukturs as $struktur)
                                <option value="{{ $struktur->nama }}" {{ old('atasan') == $struktur->nama ? 'selected' : '' }}>
                                    {{ $struktur->nama }} ({{ $struktur->jabatan }})
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @if($isFirstData || !$hasTopPosition)
                        <input type="hidden" name="atasan" value="0">
                        <small class="text-success">
                            @if($isFirstData)
                                Ini adalah data pertama, otomatis menjadi posisi puncak
                            @else
                                Perusahaan ini belum memiliki posisi puncak, otomatis menjadi posisi puncak
                            @endif
                        </small>
                    @endif
                </div>

                <!-- Foto -->
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="/images/default.jpg" class="card-img-top border" alt="Foto Struktur"
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
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
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
            const maxSize = 5 * 1024 * 1024; // 5MB dalam bytes
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

        function checkTopPosition(perusahaanId) {
            // Redirect ke halaman create dengan parameter id_perusahaan
            window.location.href = "{{ route('struktur.create') }}?id_perusahaan=" + perusahaanId;
        }
    </script>
</x-layout>
