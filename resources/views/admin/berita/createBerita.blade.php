<x-layout>
    {{-- Load CKEditor --}}
    <script src="/ckeditor/ckeditor.js"></script>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Berita</h6>
            </div>

            <div class="card-body">
                @php $role = $role ?? 'admin'; @endphp
                <form action="/dashboard/berita" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            placeholder="Masukkan judul berita" oninput="previewJudul()">
                    </div>
                    {{-- penulis  --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="form-control"
                            placeholder="" value="{{Auth::user()->nama_admin}}">
                    </div>

                    {{-- perusahaan --}}
                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                            name="id_perusahaan" id="id_perusahaan">
                            @foreach ($perusahaans as $perusahaan)
                                @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                    <option value="{{ $perusahaan->id_perusahaan }}" {{ old('id_perusahaan') == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                        {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Thumbnail --}}
                    {{-- <div class="mb-3">
                        <label for="foto" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                            onchange="previewImage(event)">
                        <img id="preview" src="#" alt="Preview Thumbnail" class="img-fluid mt-3 d-none"
                            style="max-height: 200px; object-fit: cover;">
                    </div> --}}

                    {{-- Isi Berita --}}
                    <div class="mb-3">
                        <label for="konten" class="form-label">Isi Berita</label>
                        <textarea name="konten" id="konten" rows="6" class="form-control"></textarea>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>


                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Thumbnail</h5>
                        </div>
                        <div class="card-body">
                            <div id="input-container-image" class="image-group mb-3">
                                <div class="mb-2">
                                    <label>Judul Foto</label>
                                    <input class="form-control" type="text" name="judul_foto"
                                        class="form-control" placeholder="Masukkan Judul Foto">
                                </div>
                                <div>
                                    <label>Foto</label>
                                    <input type="file" name="foto" class="form-control" placeholder="foto"
                                        accept="image/*" onchange="validateFileSize(this)">
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
                                <img id="preview" src="/images/default.jpg" class="card-img-top" alt="Logo Perusahaan" style="height: 12rem; object-fit: cover;" >

                                <div class="card-body">
                                    <h5 class="card-title" id="cardTitle"><b>Judul Berita</b></h5>
                                    <p class="card-text"><i class="fas fa-user fs-3"></i> Nama Penulis</p>
                                    <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-center">
                        <a href="/dashboard/berita" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" class="ml-2 btn btn-primary px-4">Publish Berita</button>
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
