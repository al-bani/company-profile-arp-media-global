<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perusahaan</h1>
        <div class="mb-3 text-center">
            <a href="/homePerusahaan" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </div>

    <!-- Card Wrapper -->
    <div class="mb-4">
        <div class="card-body">
            <form action="">
                @csrf

                <!-- Logo Upload Section -->
                <div class="mb-4 text-center">
                    <div class="card" style="max-width: 18rem; margin: auto;">
                        <img id="preview" src="/img/default.jpg" class="card-img-top" alt="Logo Perusahaan" style="height: 13.5rem; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                            <input type="file" name="perusahaan" class="form-control" accept="image/*" onchange="previewImage(event)">
                        </div>
                    </div>
                </div>

                <!-- NIB, Notaris, and NPWP -->
                <div class="mb-3">
                    <label for="nib">NIB</label>
                    <input class="form-control" id="nib" placeholder="1234567890123">
                </div>
                <div class="mb-3">
                    <label for="notaris">Notaris</label>
                    <input class="form-control" id="notaris" type="text" placeholder="No. 05 Tanggal 12 Februari 2023 oleh Notaris Rina Dewi, S.H., M.Kn.">
                </div>
                <div class="mb-3">
                    <label for="npwp">NPWP</label>
                    <input class="form-control" id="npwp" type="number" placeholder="12.345.678.9-123.000">
                </div>

                <!-- Deskripsi and Alamat -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="3"></textarea>
                </div>

                <!-- Contact Info (Email and Phone) -->
                <div class="mb-3 row">
                    <div class="col">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" placeholder="name@example.com">
                    </div>
                    <div class="col">
                        <label for="no_telpon">No Telp</label>
                        <input class="form-control" id="no_telpon" type="number" placeholder="629831267321">
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="mb-3 row">
                    <div class="col">
                        <label for="instagram">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" id="instagram" placeholder="Username" aria-label="Username">
                        </div>
                    </div>
                    <div class="col">
                        <label for="facebook">Facebook</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2">@</span>
                            <input type="text" class="form-control" id="facebook" placeholder="Username" aria-label="Username">
                        </div>
                    </div>
                    <div class="col">
                        <label for="tiktok">Tiktok</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">@</span>
                            <input type="text" class="form-control" id="tiktok" placeholder="Username" aria-label="Username">
                        </div>
                    </div>
                    <div class="col">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon4">@</span>
                            <input type="text" class="form-control" id="twitter" placeholder="Username" aria-label="Username">
                        </div>
                    </div>
                </div>

                <!-- Moto, Visi, and Misi -->
                <div class="mb-3">
                    <label for="moto">Moto</label>
                    <input class="form-control" id="moto" type="text">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="visi">Visi</label>
                        <input class="form-control" id="visi" type="text">
                    </div>
                    <div class="col">
                        <label for="misi">Misi</label>
                        <input class="form-control" id="misi" type="text">
                    </div>
                </div>

                <!-- Perusahaan Status -->
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="ms-1 form-select btn btn-primary" id="status">
                        <option selected>Choose</option>
                        <option value="anak">Anak</option>
                        <option value="perusahaan">Induk</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <script>
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
