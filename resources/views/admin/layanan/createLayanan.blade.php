<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Layanan Perusahaan</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Data Layanan</h6>
        </div>
        <div class="card-body">
            <form action="dashboard/layanan" method="post">
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

                {{-- layanan --}}
                <div class="mb-3">
                    <label for="logo">Deskripsi</label>
                    <input class="form-control" id="logo" name="logo" type="email" placeholder="admin@example.com">
                </div>

                {{-- <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="/img/default.jpg" class="card-img-top border" alt="Logo Perusahaan"
                            style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Logo</label>
                        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" onchange="previewImage(event)">
                    </div>
                </div> --}}


                <div class="mb-3 text-center">
                    <a href="/homeLayanan" class="btn btn-secondary me-2">Kembali</a>
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
