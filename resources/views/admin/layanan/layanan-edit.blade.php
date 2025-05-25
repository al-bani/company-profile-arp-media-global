<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Layanan Perusahaan</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Layanan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">ID Perusahaan</label>
                    <input class="form-control" id="id_perusahaan" name="id_perusahaan" type="text" value="{{ $layanan->id_perusahaan }}" readonly>
                </div>

                <!-- Nama Layanan -->
                <div class="mb-3">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input class="form-control @error('nama_layanan') is-invalid @enderror"
                           id="nama_layanan"
                           name="nama_layanan"
                           type="text"
                           value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                           placeholder="Nama Layanan">
                    @error('nama_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                              id="deskripsi"
                              name="deskripsi"
                              rows="4">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="{{ asset($layanan->foto ?? '/img/default.jpg') }}"
                             class="card-img-top border"
                             alt="Foto Layanan"
                             style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Foto Layanan</label>
                        <input class="form-control @error('foto') is-invalid @enderror"
                               id="foto"
                               name="foto"
                               type="file"
                               accept="image/*"
                               onchange="previewImage(event)">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-center mt-4">
                    <a href="{{ route('layanan.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
