<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Portofolio</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Portofolio</h6>
        </div>
        <div class="card-body">
            <form action="">
                @csrf

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">ID Perusahaan</label>
                    <input class="form-control" id="id_perusahaan" name="id_perusahaan" type="text"
                        placeholder="ID123456" disabled>
                </div>

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id">ID</label>
                    <input class="form-control" id="id" name="id" type="text" placeholder="ID123456"
                        disabled>
                </div>

                <!-- Nama Layanan -->
                <div class="mb-3">
                    <label for="nama_project">Nama Project</label>
                    <input class="form-control" id="nama_project" name="nama_project" type="text"
                        placeholder="Nama Project">
                </div>

                <!-- Team -->
                <div class="mb-3">
                    <label for="team">Team</label>
                    <input class="form-control" id="team" name="team" type="text" placeholder="Nama Team">
                </div>

                <!-- Tempat -->
                <div class="mb-3">
                    <label for="tempat">Tempat</label>
                    <input class="form-control" id="tempat" name="tempat" type="text" placeholder="Tempat">
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="Tanggal">Tanggal</label>
                    <input class="form-control" id="tanggal" name="tangga;" type="text" placeholder="tanggal">
                </div>

                <!-- Waktu -->
                <div class="mb-3">
                    <label for="waktu">Waktu</label>
                    <input class="form-control" id="waktu" name="waktu" type="text" placeholder="waktu">
                </div>

                <!-- deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <input class="form-control" id="email" name="email" type="email"
                        placeholder="admin@example.com">
                </div>

                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/dashboard/homePortofolio" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
