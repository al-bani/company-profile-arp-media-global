<x-layout>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Portofolio</h6>
        </div>
        <div class="card-body">

            <form action="/dashboard/portofolio" method="post">
                @csrf

                <div class="mb-3">
                    <label for="Nama_Perusahaan">Nama Project</label>
                    <input class="form-control" id="nama_project" name="nama_project" placeholder="Nama Project" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi Project</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="mb-2">
                    <label for="deskripsi">Team</label>
                    <input class="form-control" id="team" name="team" rows="3" required></input>
                </div>

                <div class="mb-3">
                    <label for="tempat">Tempat</label>
                    <input type="form-control" id="tempat" name="tempat" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <div class="me-2 w-100">
                        <label for="exampleFormControlInput1" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                            placeholder="Masukan Jam Mulai" name="jam_mulai" id="jam_mulai"
                            value="{{ old('jam_mulai') }}">
                        @error('jam_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="ms-2 w-100">
                        <label for="exampleFormControlInput1" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                            placeholder="Masukan Jam Selesai" name="jam_selesai" id="jam_selesai"
                            value="{{ old('jam_selesai') }}">
                        @error('jam_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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


                {{-- <label for="timeline">Timeline</label>
                <div id="input-container" class="timeline">
                    <div class="mb-3">
                        <input type="text" name="fields[]" class="form-control" placeholder="Masukkan sesuatu">
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-field">+ Tambah Field</button> --}}

                <div class="mb-3 text-center">
                    <a href="/dashboard/portofolio" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const maxFields = 5;
        const container = document.getElementById('input-container');

        document.getElementById('add-field').addEventListener('click', function() {
            const currentFields = container.querySelectorAll('input[name="fields[]"]').length;

            if (currentFields < maxFields) {
                const newField = document.createElement('div');
                newField.classList.add('mb-3');
                newField.innerHTML =
                    `<input type="text" name="fields[]" class="form-control" placeholder="Masukkan sesuatu">`;
                container.appendChild(newField);
            } else {
                alert("Maksimal hanya 5 field yang boleh ditambahkan.");
            }
        });
    </script>
</x-layout>
