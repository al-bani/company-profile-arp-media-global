<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Perusahaan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Perusahaan</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/perusahaan/{{ $perusahaan->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="mb-4 text-center">
                    <div class="card" style="max-width: 18rem; margin: auto;">
                        <img id="preview_logo_utama"
                            src="{{ $perusahaan->logo_utama ? asset('images/upload/logo/primary/'.$perusahaan->logo_utama) : '/images/default.jpg' }}"
                            class="card-img-top" alt="Logo Perusahaan" style="height: 13.5rem; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">Upload Logo Utama (MAX 5MB)</p>
                            <input type="file" id="logo_utama" name="logo_utama" class="form-control"
                                accept="image/*" onchange="previewSelectedImage(this, 'preview_logo_utama')">
                        </div>
                    </div>
                </div>

                <div class="mb-4 text-center">
                    <div class="card" style="max-width: 18rem; margin: auto;">
                        <img id="preview_logo_website"
                            src="{{ $perusahaan->logo_website ? asset('images/upload/logo/website/'.$perusahaan->logo_website) : '/images/default.jpg' }}"
                            class="card-img-top" alt="Logo Website" style="height: 13.5rem; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">Upload Logo Website (MAX 5MB)</p>
                            <input type="file" id="logo_website" name="logo_website" class="form-control"
                                accept="image/*" onchange="previewSelectedImage(this, 'preview_logo_website')">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                        placeholder="Masukkan Nama Perusahaan"
                        value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" required>
                </div>
                <div class="mb-3">
                    <label for="nib">NIB</label>
                    <input class="form-control" id="nib" name="nib" placeholder="Masukan NIB"
                        value="{{ old('nib', $perusahaan->nib) }}" required>
                </div>
                <div class="mb-3">
                    <label for="notaris">Notaris</label>
                    <input class="form-control" id="notaris" name="notaris" type="text"
                        placeholder="Masukan notaris" value="{{ old('notaris', $perusahaan->notaris) }}" required>
                </div>
                <div class="mb-3">
                    <label for="npwp">NPWP</label>
                    <input class="form-control" id="npwp" name="npwp" type="text" placeholder="Masukan NPWP"
                        value="{{ old('npwp', $perusahaan->npwp) }}" required>
                </div>


                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $perusahaan->deskripsi) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                    <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="3" required>{{ old('alamat_perusahaan', $perusahaan->alamat_perusahaan) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat_kantor">Alamat Perusahaan</label>
                    <textarea class="form-control" id="alamat_kantor" name="alamat_kantor" rows="3" required>{{ old('alamat_kantor', $perusahaan->alamat_kantor) }}</textarea>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email"
                            placeholder="name@example.com" value="{{ old('email', $perusahaan->email) }}" required>
                    </div>
                    <div class="col">
                        <label for="no_telpon">No Telp</label>
                        <input class="form-control" id="no_telpon" name="no_telpon" type="number"
                            placeholder="Masukan No Telpon" value="{{ old('no_telpon', $perusahaan->no_telpon) }}"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="instagram">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" id="instagram" name="instagram"
                                placeholder="Username" aria-label="Username"
                                value="{{ old('instagram', $perusahaan->instagram) }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="facebook">Facebook</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2">@</span>
                            <input type="text" class="form-control" id="facebook" name="facebook"
                                placeholder="Username" aria-label="Username"
                                value="{{ old('facebook', $perusahaan->facebook) }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="tiktok">Tiktok</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">@</span>
                            <input type="text" class="form-control" id="tiktok" name="tiktok"
                                placeholder="Username" aria-label="Username"
                                value="{{ old('tiktok', $perusahaan->tiktok) }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon4">@</span>
                            <input type="text" class="form-control" id="twitter" name="twitter"
                                placeholder="Username" aria-label="Username"
                                value="{{ old('twitter', $perusahaan->twitter) }}" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="moto">Moto</label>
                    <input class="form-control" id="moto" name="moto" type="text"
                        value="{{ old('moto', $perusahaan->moto) }}" required>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="visi">Visi</label>
                        <input class="form-control" id="visi" name="visi" type="text"
                            value="{{ old('visi', $perusahaan->visi) }}" required>
                    </div>
                    <div class="col">
                        <label for="misi">Misi</label>
                        <input class="form-control" id="misi" name="misi" type="text"
                            value="{{ old('misi', $perusahaan->misi) }}" required>
                    </div>
                </div>
                @if ($role === 'superAdmin')
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="ms-1 form-select btn btn-primary" id="status" name="status" required>
                            <option value="anak"
                                {{ old('status', $perusahaan->status) == 'anak' ? 'selected' : '' }}>Anak</option>
                            <option value="induk"
                                {{ old('status', $perusahaan->status) == 'induk' ? 'selected' : '' }}>Induk
                            </option>
                        </select>
                    </div>
                @endif
                <div class="mb-3 text-center">
                    <a href="/dashboard/perusahaan" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewSelectedImage(input, previewId) {
            const file = input.files[0];
            if (file) {
                const maxSize = 5 * 1024 * 1024; // 5MB dalam bytes

                if (file.size > maxSize) {
                    alert("Ukuran file tidak boleh lebih dari 5MB!");
                    input.value = ''; // Reset input file
                    return false;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layout>
