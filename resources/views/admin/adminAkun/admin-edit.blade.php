<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Akun Admin</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Akun</h6>
        </div>
        <div class="card-body">
            <form action="">
                @csrf

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">ID Perusahaan</label>
                    <input class="form-control" id="id_perusahaan" name="id_perusahaan" type="text" placeholder="ID123456">
                </div>

                <!-- Nama Admin -->
                <div class="mb-3">
                    <label for="nama_admin">Nama Admin</label>
                    <input class="form-control" id="nama_admin" name="nama_admin" type="text" placeholder="Nama Lengkap Admin">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="admin@example.com">
                </div>

                <!-- No Telepon -->
                <div class="mb-3">
                    <label for="no_telepon">No Telepon</label>
                    <input class="form-control" id="no_telepon" name="no_telepon" type="tel" placeholder="081234567890">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="ms-1 form-select btn btn-primary" id="status" name="status">
                        <option selected disabled>Pilih Status</option>
                        <option value="anak">Anak</option>
                        <option value="induk">Induk</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/dashboard/akunAdmin" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
