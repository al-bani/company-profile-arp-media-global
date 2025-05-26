<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Akun Admin</h1>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">Create Akun</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/akunAdmin" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="admin@example.com" required>
                    </div>

                    <div class="col-md-6">
                        <label for="nama_admin" class="form-label fw-semibold">Nama Admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin"
                            placeholder="Nama Lengkap Admin" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="col-md-6">
                        <label for="no_telepon" class="form-label fw-semibold">No Telepon</label>
                        <input type="tel" class="form-control" id="no_telepon" name="no_telepon" placeholder="081234567890" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="perusahaan" class="form-label fw-semibold">Perusahaan</label>
                        <select class="id_perusahaan form-select" aria-label="Default select example"
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
                </div>

                <div class="mb-3 text-end">
                    <a href="/dashboard/akunAdmin" class="btn btn-secondary me-3 px-4">Kembali</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</x-layout>
