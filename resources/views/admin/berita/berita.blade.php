<x-layout>
    {{-- Load CKEditor --}}
    <script src="ckeditor/ckeditor.js"></script>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita Baru</h1>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Publish Berita</button>
        </div>
    </div>

    <div class="mb-4">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Thumbnail Upload --}}
            <div class="mb-4">
                <div class="card" style="max-width: 18rem; margin: auto;">
                    <img id="preview" src="/img/default.jpg" class="card-img-top" alt="Logo Perusahaan" style="height: 12rem; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title" id="cardTitle"><b>Judul Berita</b></h5>
                        <p class="card-text"><i class="fas fa-user fs-3"></i> Nama Penulis</p>
                        <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul">Judul Berita</label>
                <input name="judul" class="form-control" id="judul" oninput="previewJudul()">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Thumbnail</label>
                <input class="form-control" id="foto" name="foto" type="file" accept="image/*" onchange="previewImage(event)">
            </div>

            {{-- Isi Berita --}}
            <div class="mb-3">
                <label for="deskripsi">Isi Berita</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="6"></textarea>
            </div>

            {{-- Perusahaan --}}
            <div class="mb-3">
                <label for="status">Perusahaan</label>
                <select class="form-select" name="status" id="status">
                    <option selected>Choose...</option>
                    <option value="arp">ARP</option>
                    <option value="red">Red gitulah</option>
                    <option value="nothing">[TANPA PERUSAHAAN]</option>
                </select>
            </div>


        </form>
    </div>

    {{-- CKEditor Init --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            CKEDITOR.replace('deskripsi', {
                contentsCss: '/ckeditor/contents.css',
                removePlugins: 'tableselection',
                allowedContent: true
            });
        });

        function previewJudul() {
            const judul = document.getElementById("judul").value;
            const cardTitle = document.getElementById("cardTitle");
            cardTitle.textContent = judul || 'Judul Berita';
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-layout>
