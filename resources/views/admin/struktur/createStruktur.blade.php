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

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="strukturTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="form1-tab" data-bs-toggle="tab" data-bs-target="#form1" type="button" role="tab" aria-controls="form1" aria-selected="true">Berupa Diagram</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="form2-tab" data-bs-toggle="tab" data-bs-target="#form2" type="button" role="tab" aria-controls="form2" aria-selected="false">Berupa List Tabel</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="strukturTabContent">

                <div class="tab-pane fade show active" id="form1" role="tabpanel" aria-labelledby="form1-tab">
                    <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama1">Nama Lengkap</label>
                            <input class="form-control" id="nama1" name="nama" type="text"
                                placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label for="jabatan1">Jabatan</label>
                            <input class="form-control" id="jabatan1" name="jabatan" type="text"
                                placeholder="Masukkan jabatan" value="{{ old('jabatan') }}" required>
                        </div>

                        <!-- Perusahaan -->
                        <div class="mb-3">
                            <label for="id_perusahaan1">Perusahaan</label>
                            <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                                name="id_perusahaan" id="id_perusahaan1" required onchange="checkTopPosition(this.value)">
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
                            <label for="atasan1">Melapor Kepada (Atasan)</label>
                            <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                                name="atasan" id="atasan1" {{ $isFirstData || !$hasTopPosition ? 'disabled' : '' }}>
                                @if($isFirstData || !$hasTopPosition)
                                    <option value="0" selected>-- Posisi Puncak (Tidak Ada Atasan) --</option>
                                @else
                                    <option value="0">-- Posisi Puncak (Tidak Ada Atasan) --</option>
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


                <div class="tab-pane fade" id="form2" role="tabpanel" aria-labelledby="form2-tab">
                    <form action="{{ route('struktur.store') }}" method="POST">
                        @csrf
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama2">Nama Lengkap</label>
                            <input class="form-control" id="nama2" name="nama" type="text"
                                placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label for="jabatan2">Jabatan</label>
                            <input class="form-control" id="jabatan2" name="jabatan" type="text"
                                placeholder="Masukkan jabatan" value="{{ old('jabatan') }}" required>
                        </div>

                        <!-- Perusahaan -->
                        <div class="mb-3">
                            <label for="id_perusahaan2">Perusahaan</label>
                            <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                                name="id_perusahaan" id="id_perusahaan2" required onchange="checkTopPosition(this.value)">
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

                        <div class="mb-3 text-center mt-4">
                            <a href="{{ route('struktur.index') }}" class="btn btn-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
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
            const maxSize = 10 * 1024 * 1024; // 10MB dalam bytes
            const file = input.files[0];

            if (file && file.size > maxSize) {
                alert("Ukuran file tidak boleh lebih dari 10MB!");
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
