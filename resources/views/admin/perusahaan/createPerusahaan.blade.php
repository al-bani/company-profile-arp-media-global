<x-layout>
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perusahaan</h1>

    </div> --}}

    <!-- Card Wrapper -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data Perusahaan</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/perusahaan" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Logo Upload Section -->
                <!-- <div class="mb-4 text-center">
                    <div class="card" style="max-width: 18rem; margin: auto;">
                        <img id="preview" src="/img/default.jpg" class="card-img-top" alt="Logo Perusahaan"
                            style="height: 13.5rem; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                            <input type="file" id="logo" name="logo" class="form-control" accept="image/*"
                                onchange="previewImage(event)">
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="mb-4 text-center col-md-6">
                        <div class="card" style="max-width: 18rem; margin: auto;">
                            <img id="preview" src="/images/default.jpg" class="card-img-top" alt="Logo Perusahaan"
                                style="height: 13.5rem; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">Upload Logo Utama(MAX 5MB)</p>
                                <input type="file" id="logo_utama" name="logo_utama" class="form-control" accept="image/*"
                                    onchange="validateFileSize(this)" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 text-center col-md-6">
                        <div class="card" style="max-width: 18rem; margin: auto;">
                            <img id="preview" src="/images/default.jpg" class="card-img-top" alt="Logo Website"
                                style="height: 13.5rem; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">Upload Logo Website(MAX 5MB)</p>
                                <input type="file" id="logo_website" name="logo_website" class="form-control" accept="image/*"
                                    onchange="validateFileSize(this)" required>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- NIB, Notaris, and NPWP -->
                {{-- <div class="mb-3">
                    <label for="logo" class="form-label">Logo Perusahaan</label>
                    <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo Perusahaan" width="100">
                </div> --}}

                <div class="mb-3">
                    <label for="Nama_Perusahaan">Nama Perusahaan</label>
                    <input class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                        placeholder="Nama Perusahaan" required>
                </div>
                <div class="mb-3">
                    <label for="nib">NIB</label>
                    <input class="form-control" id="nib" name="nib" placeholder="1234567890123" required>
                </div>
                <div class="mb-3">
                    <label for="notaris">Notaris</label>
                    <input class="form-control" id="notaris" name="notaris" type="text"
                        placeholder="Nama Notaris" required>
                </div>
                <div class="mb-3">
                    <label for="npwp">NPWP</label>
                    <input class="form-control" id="npwp" name="npwp"
                        placeholder="12.345.678.9-123.000" required>
                </div>

                <!-- Deskripsi and Alamat -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat Perusahaan</label>
                    <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat Kantor</label>
                    <textarea class="form-control" id="alamat_kantor" name="alamat_kantor" rows="3" required></textarea>
                </div>

                <!-- Contact Info (Email and Phone) -->
                <div class="mb-3 row">
                    <div class="col">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email"
                            placeholder="name@example.com" required>
                    </div>
                    <div class="col">
                        <label for="no_telpon">No Telp</label>
                        <input class="form-control" id="no_telpon" name="no_telpon" type="number"
                            placeholder="629831267321" required>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="mb-3 row">
                    <div class="col">
                        <label for="instagram">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" id="instagram" name="instagram"
                                placeholder="Username" aria-label="Username" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="facebook">Facebook</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2">@</span>
                            <input type="text" class="form-control" id="facebook" name="facebook"
                                placeholder="Username" aria-label="Username" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="tiktok">Tiktok</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">@</span>
                            <input type="text" class="form-control" id="tiktok" name="tiktok"
                                placeholder="Username" aria-label="Username" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon4">@</span>
                            <input type="text" class="form-control" id="twitter" name="twitter"
                                placeholder="Username" aria-label="Username" required>
                        </div>
                    </div>
                </div>

                <!-- Moto, Visi, and Misi -->
                <div class="mb-3">
                    <label for="moto">Moto</label>
                    <input class="form-control" id="moto" name="moto" type="text">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="visi">Visi</label>
                        <input class="form-control" id="visi" name="visi" type="text">
                    </div>
                    <div class="col">
                        <label for="misi">Misi</label>
                        <input class="form-control" id="misi" name="misi" type="text">
                    </div>
                </div>

                <!-- Perusahaan Status -->
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="ms-1 form-select btn btn-primary" id="status" name="status">
                        <option selected>Choose</option>
                        <option value="anak">Anak</option>
                        <option value="induk">Induk</option>
                    </select>
                </div>
                <div class="mb-3 text-center">
                    <a href="/dashboard/perusahaan" class="btn btn-secondary me-2">Kembali</a>
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
    </script>
</x-layout>
