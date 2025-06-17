<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Akun Admin</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Akun</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/akunAdmin/{{$admin->id}}" method="POST">
                @csrf
                @method('put')

                <!-- Id Perusahaan -->
                <div class="mb-3">
                    <label for="id_perusahaan">ID Perusahaan</label>
                    <select class="id_perusahaan form-select" aria-label="Default select example" name="id_perusahaan" id="id_perusahaan" required>
                        @foreach ($perusahaans as $perusahaan)
                            @if (old('id_perusahaan', $admin->id_perusahaan) == $perusahaan->id_perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}" selected>
                                    {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                </option>
                            @else
                                <option value="{{ $perusahaan->id_perusahaan }}">
                                    {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Nama Admin -->
                <div class="mb-3">
                    <label for="nama_admin">Nama Admin</label>
                    <input class="form-control" id="nama_admin" name="nama_admin" type="text" value="{{ $admin->nama_admin }}" placeholder="Nama Lengkap Admin" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" value="{{ $admin->email }}" placeholder="admin@example.com" required>
                </div>

                <!-- No Telepon -->
                <div class="mb-3">
                    <label for="no_telepon">No Telepon</label>
                    <input class="form-control" id="no_telepon" name="no_telepon" type="tel" value="{{ $admin->no_telepon }}" placeholder="081234567890" required>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="ms-1 form-select btn btn-primary" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="aktif" {{ $admin->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ $admin->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="role">Status</label>
                    <select class="ms-1 form-select btn btn-primary" id="role" name="role" required>
                        <option value="">Pilih Status</option>
                        <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superAdmin" {{ $admin->role == 'superAdmin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="mb-3 text-center">
                    <a href="/dashboard/akunAdmin" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
