<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Partner</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nama Partner -->
                <div class="mb-3">
                    <label for="nama_partner" class="form-label">Nama Partner</label>
                    <input class="form-control" id="nama_partner" name="nama_partner" type="text" placeholder="Masukkan nama partner">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="partner@example.com">
                </div>

                <!-- Logo -->
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input class="form-control" id="logo" name="logo" type="file" accept="image/*">
                </div>

                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/homePartner" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
