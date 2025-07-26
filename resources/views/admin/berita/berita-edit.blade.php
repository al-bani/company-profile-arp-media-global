<x-layout>
    {{-- Load CKEditor --}}
    <script src="/ckeditor/ckeditor.js"></script>

    @php $role = $role ?? 'admin'; @endphp

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Berita</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    {{-- Debug foto --}}
                    @php
                        // dd($berita);
                        // echo "Foto: " . $berita->foto;
                    @endphp
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Masukkan judul berita" oninput="previewJudul()"
                            value="{{ old('judul', $berita->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- perusahaan --}}
                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select btn btn-secondary" name="id_perusahaan" id="id_perusahaan" required>
                            @foreach ($perusahaans as $perusahaan)
                                @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}"
                                    {{ old('id_perusahaan', $berita->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="mb-3">
                        <label for="konten" class="form-label">Isi Berita</label>
                        <textarea name="konten" id="konten" rows="6" class="form-control @error('konten') is-invalid @enderror" required>{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penulis --}}
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror"
                            value="{{ old('penulis', $berita->penulis) }}" placeholder="Nama penulis" required>
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" id="tanggal"
                               value="{{ old('tanggal', $berita->tanggal) }}"
                               class="form-control @error('tanggal') is-invalid @enderror" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Thumbnail</h5>
                        </div>
                        <div class="card-body">
                            <div id="input-container-image" class="image-group mb-3">
                                <div class="mb-2">
                                    <label>Judul Foto</label>
                                    <input class="form-control @error('judul_foto') is-invalid @enderror"
                                           type="text"
                                           name="judul_foto"
                                           value="{{ old('judul_foto', $berita->judul_foto) }}"
                                           placeholder="Masukkan Judul Foto" required>
                                    @error('judul_foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label>Foto</label>
                                    <input type="file"
                                           name="foto"
                                           class="form-control @error('foto') is-invalid @enderror"
                                           accept="image/*"
                                           onchange="validateFileSize(this)">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Preview</h5>
                        </div>
                        <div class="mb-4 mt-4">
                            <div class="card" style="max-width: 18rem; margin: auto;">
                                <img id="preview" src="{{ asset($berita->foto ? 'images/upload/berita/' . $berita->foto : 'images/default.jpg') }}"
                                     class="card-img-top"
                                     alt="Logo Perusahaan"
                                     style="height: 12rem; object-fit: cover;"
                                     onerror="this.src='{{ asset('images/default.jpg') }}'">
                                <div class="card-body">
                                    <h5 class="card-title" id="cardTitle"><b>{{ $berita->judul ?? 'Judul Berita' }}</b></h5>
                                    <p class="card-text"><i class="fas fa-user fs-3"></i> {{ $berita->penulis ?? 'Nama Penulis' }}</p>
                                    <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" class="ml-2 btn btn-primary px-4">Update Berita</button>
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
                removePlugins: 'elementspath,resize,about,flash,iframe,forms,smiley,specialchar,tabletools,find,pagebreak,preview,print,save,showblocks,stylescombo,templates,newpage,language,scayt,div,justify,font,colorbutton,background,image2,uploadimage,uploadfile,filebrowser,link,anchor,horizontalrule,indent,outdent,blockquote,removeformat,format,sourcearea',
                allowedContent: true,
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                    { name: 'styles', items: ['Styles', 'Format'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'insert', items: ['Image'] },
                    { name: 'tools', items: ['Maximize'] }
                ],
                height: 400,
                removeButtons: '',
                format_tags: 'p;h1;h2;h3;pre',
                removeDialogTabs: 'image:advanced;link:advanced'
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
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
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
    </script>
</x-layout>
