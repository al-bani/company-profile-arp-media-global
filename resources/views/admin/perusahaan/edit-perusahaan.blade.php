<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Perusahaan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Perusahaan</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/perusahaan/{{ $perusahaan -> id }}" method="post">
                @method('put')
                @csrf

                <div class="mb-3">
                    <label for="logo">logo</label>
                    <input class="form-control" id="logo" name="logo" placeholder="Masukan Logo" value="{{ old('logo', $perusahaan->logo) }}">
                </div>
                <div class="mb-3">
                    <label for="nib">NIB</label>
                    <input class="form-control" id="nib" name="nib" placeholder="Masukan NIB" value="{{ old('nib', $perusahaan->nib) }}">
                </div>
                <div class="mb-3">
                    <label for="notaris">Notaris</label>
                    <input class="form-control" id="notaris" name="notaris" type="text" placeholder="Masukan notaris" value="{{ old('notaris', $perusahaan->notaris) }}">
                </div>
                <div class="mb-3">
                    <label for="npwp">NPWP</label>
                    <input class="form-control" id="npwp" name="npwp" type="number" placeholder="Masukan NPWP" value="{{ old('npwp', $perusahaan->npwp) }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $perusahaan->deskripsi) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $perusahaan->alamat) }}</textarea>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" value="{{ old('email', $perusahaan->email) }}">
                    </div>
                    <div class="col">
                        <label for="no_telpon">No Telp</label>
                        <input class="form-control" id="no_telpon" name="no_telpon" type="number" placeholder="Masukan No Telpon" value="{{ old('no_telpon', $perusahaan->no_telpon) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="instagram">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Username" aria-label="Username" value="{{ old('instagram', $perusahaan->instagram) }}">
                        </div>
                    </div>
                    <div class="col">
                        <label for="facebook">Facebook</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2">@</span>
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Username" aria-label="Username" value="{{ old('facebook', $perusahaan->facebook) }}">
                        </div>
                    </div>
                    <div class="col">
                        <label for="tiktok">Tiktok</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">@</span>
                            <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Username" aria-label="Username" value="{{ old('tiktok', $perusahaan->tiktok) }}">
                        </div>
                    </div>
                    <div class="col">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon4">@</span>
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Username" aria-label="Username" value="{{ old('twitter', $perusahaan->twitter) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="moto">Moto</label>
                    <input class="form-control" id="moto" name="moto" type="text" value="{{ old('moto', $perusahaan->moto) }}">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="visi">Visi</label>
                        <input class="form-control" id="visi" name="visi" type="text" value="{{ old('visi', $perusahaan->visi) }}">
                    </div>
                    <div class="col">
                        <label for="misi">Misi</label>
                        <input class="form-control" id="misi" name="misi" type="text" value="{{ old('misi', $perusahaan->misi) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="ms-1 form-select btn btn-primary" id="status" name="status">
                        <option value="anak" {{ old('status', $perusahaan->status) == 'anak' ? 'selected' : '' }}>Anak</option>
                        <option value="perusahaan" {{ old('status', $perusahaan->status) == 'perusahaan' ? 'selected' : '' }}>Induk</option>
                    </select>
                </div>

                <div class="mb-3 text-center">
                    <a href="/dashboard/perusahaan" class="btn btn-secondary me-2">Kembali</a>
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
