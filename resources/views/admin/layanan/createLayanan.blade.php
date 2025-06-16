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
            @php $role = $role ?? 'admin'; @endphp
            <form action="/dashboard/layanan" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Nama Layanan -->
                <div class="mb-3">
                    <label for="nama_admin">Nama Layanan</label>
                    <input class="form-control" id="nama_layanan" name="nama_layanan" type="text"
                        placeholder="Nama Layanan">
                </div>

                <!-- deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" rows=4></textarea>
                </div>

                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                        name="id_perusahaan" id="id_perusahaan">
                        @foreach ($perusahaans as $perusahaan)
                            @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}" {{ old('id_perusahaan') == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="/images/default.jpg" class="card-img-top border" alt="Logo Perusahaan"
                            style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Foto Layanan</label>
                        <input class="form-control" id="foto" name="foto" type="file" accept="image/*"
                            onchange="validateFileSize(this)" required>
                    </div>
                </div>


                <div class="mb-3 text-center">
                    <a href="/dashboard/homeLayanan" class="btn btn-secondary me-2">Kembali</a>
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
