<x-layout>
    {{-- Load CKEditor --}}
    <script src="/ckeditor/ckeditor.js"></script>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Berita</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('berita.update', ['berita' => $berita->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Masukkan judul berita" oninput="previewJudul()"
                            value="{{ old('judul', $berita->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- perusahaan --}}
                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select @error('id_perusahaan') is-invalid @enderror"
                                name="id_perusahaan" id="id_perusahaan">
                            @foreach ($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}"
                                    {{ old('id_perusahaan', $berita->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Thumbnail</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($berita->foto)
                                        <img src="{{ asset($berita->foto) }}" alt="Current Thumbnail" class="img-fluid mb-3">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div id="input-container-image" class="image-group mb-3">
                                        <div class="mb-2">
                                            <label>Judul Foto</label>
                                            <input class="form-control @error('foto.0.judul_foto') is-invalid @enderror"
                                                   type="text"
                                                   name="foto[0][judul_foto]"
                                                   value="{{ old('foto.0.judul_foto') }}"
                                                   placeholder="Masukkan Judul Foto">
                                            @error('foto.0.judul_foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label>Foto</label>
                                            <input type="file"
                                                   name="foto[0][foto]"
                                                   class="form-control @error('foto.0.foto') is-invalid @enderror"
                                                   accept="image/*"
                                                   onchange="previewImage(event)">
                                            @error('foto.0.foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <img id="preview" src="#" alt="Preview Thumbnail" class="img-fluid mt-3 d-none"
                                        style="max-height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="mb-3">
                        <label for="konten" class="form-label">Isi Berita</label>
                        <textarea name="konten" id="konten" rows="6" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penulis --}}
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror"
                            value="{{ old('penulis', $berita->penulis) }}" placeholder="Nama penulis">
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" id="tanggal"
                               value="{{ old('tanggal', $berita->tanggal) }}"
                               class="form-control @error('tanggal') is-invalid @enderror">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary me-2 px-4">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Update Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CKEditor Init + Preview --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('konten', {
                contentsCss: '/ckeditor/contents.css',
                removePlugins: 'tableselection',
                allowedContent: true
            });
        });

        function previewJudul() {
            const judul = document.getElementById("judul").value;
            const cardTitle = document.getElementById("cardTitle");
            if (cardTitle) {
                cardTitle.textContent = judul || 'Judul Berita';
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.classList.remove('d-none');
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</x-layout>
