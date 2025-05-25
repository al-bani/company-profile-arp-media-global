<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Edit Partner</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Partner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('partner.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <!-- ID Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan" class="form-label">ID Perusahaan</label>
                    <input class="form-control" id="id_perusahaan" name="id_perusahaan" type="text"
                           value="{{ $partner->id_perusahaan }}" readonly>
                </div>

                <!-- Nama Partner -->
                <div class="mb-3">
                    <label for="nama_partner" class="form-label">Nama Partner</label>
                    <input class="form-control @error('nama_partner') is-invalid @enderror"
                           id="nama_partner"
                           name="nama_partner"
                           type="text"
                           value="{{ old('nama_partner', $partner->nama_partner) }}"
                           placeholder="Masukkan nama partner">
                    @error('nama_partner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           type="email"
                           value="{{ old('email', $partner->email) }}"
                           placeholder="partner@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto -->
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="{{ asset($partner->foto ?? '/img/default.jpg') }}"
                             class="card-img-top border"
                             alt="Logo Partner"
                             style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Logo Partner</label>
                        <input type="file"
                               class="form-control @error('foto') is-invalid @enderror"
                               id="foto"
                               name="foto"
                               accept="image/*"
                               onchange="previewImage(event)">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-center mt-4">
                    <a href="{{ route('partner.index') }}" class="btn btn-secondary me-2">Kembali</a>
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
