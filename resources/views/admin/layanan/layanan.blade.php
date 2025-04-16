<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Layanan Perusahaan</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="">
                @csrf

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">ID Perusahaan</label>
                    <input class="form-control" id="id_perusahaan" name="id_perusahaan" type="text" placeholder="ID123456" disabled>
                </div>

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">ID</label>
                    <input class="form-control" id="id" name="id" type="text" placeholder="ID123456" disabled>
                </div>

                <!-- Nama Layanan -->
                <div class="mb-3">
                    <label for="nama_admin">Nama Layanan</label>
                    <input class="form-control" id="nama_layanan" name="nama_layanan" type="text" placeholder="Nama Layanan">
                </div>

                <!-- deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="admin@example.com">
                </div>

                <!-- No Telepon -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Logo</label>
                    <input class="form-control" id="foto" name="foto" type="file" accept="image/*">
                </div>

                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/homeLayanan" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
