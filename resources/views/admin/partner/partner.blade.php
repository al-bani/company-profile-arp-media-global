<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Partner</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Data Partner</h6>
        </div>
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
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="/img/default.jpg" class="card-img-top border" alt="Logo Perusahaan"
                            style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Logo</label>
                        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" onchange="previewImage(event)">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/dashboard/homePartner" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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
