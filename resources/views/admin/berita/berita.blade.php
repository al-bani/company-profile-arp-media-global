<x-layout>
    {{-- Load CKEditor --}}
    <script src="/ckeditor/ckeditor.js"></script>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita Baru</h1>
    </div>

    <div class="mb-4">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Thumbnail Upload --}}
            <div class="mb-4 text-center">
                <div class="card" style="max-width: 18rem; margin: auto;">
                    <img src="https://coffective.com/wp-content/uploads/2018/06/default-featured-image.png.jpg" class="card-img-top" alt="Logo Perusahaan">
                    <div class="card-body">
                        <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                </div>
            </div>

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul">Judul Berita</label>
                <input name="judul" class="form-control" id="judul">
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

            {{-- Submit --}}
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Simpan Data Perusahaan</button>
            </div>
        </form>
    </div>

    {{-- CKEditor Init --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            CKEDITOR.replace('deskripsi');
        });
    </script>
</x-layout>
