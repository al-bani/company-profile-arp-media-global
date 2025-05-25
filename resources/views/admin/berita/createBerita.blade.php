<x-layout>
    {{-- Load CKEditor --}}
    <script src="/ckeditor/ckeditor.js"></script>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Berita</h6>
            </div>

            <div class="card-body">
                <form action="/dashboard/berita" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            placeholder="Masukkan judul berita" oninput="previewJudul()">
                    </div>

                    {{-- perusahaan --}}
                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                            name="id_perusahaan" id="id_perusahaan">
                            @foreach ($perusahaans as $perusahaan)
                                @if (old('id_perusahaan') == $perusahaan->id_perusahaan)
                                    <option value="{{ $perusahaan->id_perusahaan }}" selected>
                                        {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                    </option>
                                @else
                                    <option value="{{ $perusahaan->id_perusahaan }}" selected>
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

                    {{-- Penulis --}}
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="form-control"
                            placeholder="Nama penulis">
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
                                    <input class="form-control" type="text" name="foto[0][judul_foto]"
                                        class="form-control" placeholder="Masukkan Judul Foto">
                                </div>
                                <div>
                                    <label>Foto</label>
                                    <input type="file" name="foto[0][foto]" class="form-control" placeholder="foto"
                                        accept="image/*">
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- Tombol --}}
                    <div class="d-flex justify-content-center">
                        <a href="/dashboard/berita" class="btn btn-secondary me-2 px-4">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Publish Berita</button>
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

        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('add-field-image');
            const container = document.getElementById('input-container-image');
            const maxFields = 3;
            let timelineIndex = 1; // dimulai dari 1 karena field pertama sudah ada di HTML

            button.addEventListener('click', function() {
                const currentFields = container.querySelectorAll('.image-group').length;

                if (currentFields < maxFields) {
                    const newGroup = document.createElement('div');
                    newGroup.classList.add('image-group', 'mb-3');
                    newGroup.innerHTML = `
                    <hr class="my-4 border-2">
                    <div class="mb-2">
                        <label>Judul Foto</label>
                        <input class=" form-control" name="foto[${timelineIndex}][judul_foto]" placeholder="Masukkan tanggal/tahun">
                    </div>
                    <div>
                        <label>Foto</label>
                        <input type="file" name="foto[${timelineIndex}][foto]" class="form-control" placeholder="Masukkan Foto">
                    </div>
                `;
                    container.appendChild(newGroup);
                    timelineIndex++;
                } else {
                    alert("Maksimal hanya 3 field yang boleh ditambahkan.");
                }
            });
        });
    </script>
</x-layout>
