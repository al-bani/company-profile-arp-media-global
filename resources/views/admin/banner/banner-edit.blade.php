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
                           placeholder="Masukkan Judul">
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
                              placeholder="Masukan Deskripsi">{{ old('deskripsi', $banner->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Banner -->
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            @if($banner->foto)
                                <img src="{{ asset($banner->foto) }}"
                                     alt="Current Banner"
                                     class="img-fluid mb-3 rounded">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">Upload Foto (Format JPG atau PNG, MAX 5MB)</p>
                                    <input type="file"
                                           id="foto"
                                           name="foto"
                                           class="form-control @error('foto') is-invalid @enderror"
                                           accept="image/*"
                                           onchange="previewImage(event)">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <img id="preview"
                                 src="#"
                                 alt="Preview Banner"
                                 class="img-fluid mt-3 d-none rounded"
                                 style="max-height: 200px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <!-- Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="form-select @error('id_perusahaan') is-invalid @enderror"
                            name="id_perusahaan"
                            id="id_perusahaan">
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
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
