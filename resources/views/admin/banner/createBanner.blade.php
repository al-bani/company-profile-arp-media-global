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
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi"></textarea>,

                    <div class="mb-4 text-center">
                        <div class="card" style="max-width: 18rem; margin: auto;">
                            <div class="card-body">
                                <p class="card-text">Upload Foto (Format JPG atau PNG, MAX 5MB)</p>
                                <input type="file" id="foto" name="foto" class="form-control"
                                    accept="image/*" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="ms-1 form-select btn btn-secondary" aria-label="Default select example"
                            name="id_perusahaan" id="id_perusahaan">
                            @foreach ($perusahaans as $perusahaan)
                                @if (old('id_perusahaan') == $perusahaan->id_perusahaan)
                                    <option value="{{ $perusahaan->id_perusahaan }}" selected>
                                        {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                    </option>
                                @else
                                    <option value="{{ $perusahaan->id_perusahaan }}" selected>
                                        {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Logo -->
                    <!-- <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="/img/default.jpg" class="card-img-top border" alt="Logo Perusahaan"
                            style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Logo Partner</label>
                        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" onchange="previewImage(event)">
                        <div class="card-body">
                            <p class="card-text">Upload Logo Partner (Format JPG atau PNG, MAX 5MB)</p>
                            <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div> -->

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
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
