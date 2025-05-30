<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Banner</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Data Banner</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/banner" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nama Partner -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Banner</label>
                    <input class="form-control" id="judul" name="judul" type="text"
                        placeholder="Masukkan Judul">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Foto</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi"></textarea>
                </div>
                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                        name="id_perusahaan" id="id_perusahaan">
                        @foreach ($perusahaans as $perusahaan)
                            @if ($role === 'superAdmin' || $perusahaan->id_perusahaan == Auth::user()->id_perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}" {{ old('id_perusahaan', $banner->id_perusahaan ?? '') == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                    <div class="mb-4 text-center">
                        <div class="card" style="max-width: 25rem; margin: auto;">
                            <img id="preview" src="/images/default.jpg" class="card-img-top" alt="Logo Perusahaan"
                                style="height: 13.5rem; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">Upload Banner</p>
                                <input type="file" id="foto" name="foto" class="form-control" accept="image/*"
                                    onchange="previewImage(event)" required>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mb-3 text-center">
                        <a href="/dashboard/banner" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layout>
