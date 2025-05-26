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
            <form action="/dashboard/banner/{{$banner->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Banner -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Banner</label>
                    <input class="form-control @error('judul') is-invalid @enderror"
                           id="judul"
                           name="judul"
                           type="text"
                           value="{{ old('judul', $banner->judul) }}"
                           placeholder="Masukkan Judul" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Banner</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                              id="deskripsi"
                              name="deskripsi"
                              rows="4"
                              placeholder="Masukan Deskripsi" required>{{ old('deskripsi', $banner->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="form-select @error('id_perusahaan') is-invalid @enderror"
                            name="id_perusahaan"
                            id="id_perusahaan" required>
                        @foreach ($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id_perusahaan }}"
                                {{ old('id_perusahaan', $banner->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Banner -->
                <div class="mb-4 text-center">
                    <div class="card" style="max-width: 25rem; margin: auto;">
                        <img id="preview" src="{{ asset($banner->foto) }}" class="card-img-top" alt="Logo Perusahaan"
                            style="height: 13.5rem; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">Upload Banner</p>
                            <input type="file" id="logo" name="logo" class="form-control" accept="image/*"
                                onchange="previewImage(event)" required>
                        </div>
                    </div>
                </div>

                <!-- Perusahaan -->


                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/dashboard/banner" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layout>
