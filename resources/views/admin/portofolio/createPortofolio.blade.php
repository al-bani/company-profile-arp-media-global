<x-layout>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Portofolio</h6>
        </div>
        <div class="card-body">

            <form action="/dashboard/portofolio" method="post" enctype="multipart/form-data">
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


                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Dokumentasi</h5>
                    </div>
                    <div class="card-body">
                        <div id="input-container-image" class="image-group mb-3">
                            <div class="mb-2">
                                <label>Judul Foto</label>
                                <input class="form-control" type="text" name="foto[0][judul_foto]" class="form-control"
                                    placeholder="Masukkan Judul Foto">
                            </div>
                            <div>
                                <label>Foto</label>
                                <input type="file" name="foto[0][foto]" class="form-control" placeholder="foto" accept="image/*" >
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mt-2" id="add-field-image">+ Tambah Field</button>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div id="input-container" class="timeline-group mb-3">
                            <div class="mb-2">
                                <label>Tanggal/Tahun</label>
                                <input class="date" type="date" name="timeline[0][tanggal]" class="form-control"
                                    placeholder="Masukkan tanggal/tahun">
                            </div>
                            <div>
                                <label>Deskripsi</label>
                                <textarea type="text" name="timeline[0][deskripsi]" class="form-control" placeholder="Masukkan deskripsi">
                                </textarea>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mt-2" id="add-field">+ Tambah Field</button>
                    </div>
                </div>


                <div class="mb-3 text-center">
                    <a href="/dashboard/portofolio" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.getElementById('add-field');
                const container = document.getElementById('input-container');
                const maxFields = 5;
                let timelineIndex = 1; // dimulai dari 1 karena field pertama sudah ada di HTML

                button.addEventListener('click', function() {
                    const currentFields = container.querySelectorAll('.timeline-group').length;

                    if (currentFields < maxFields) {
                        const newGroup = document.createElement('div');
                        newGroup.classList.add('timeline-group', 'mb-3');
                        newGroup.innerHTML = `
                    <hr class="my-4 border-2">
                    <div class="mb-2">
                        <label>Tanggal/Tahun</label>
                        <input class="date form-control" type="date" name="timeline[${timelineIndex}][tanggal]" placeholder="Masukkan tanggal/tahun">
                    </div>
                    <div>
                        <label>Deskripsi</label>
                        <textarea name="timeline[${timelineIndex}][deskripsi]" class="form-control" placeholder="Masukkan deskripsi"></textarea>
                    </div>
                `;
                        container.appendChild(newGroup);
                        timelineIndex++;
                    } else {
                        alert("Maksimal hanya 5 field yang boleh ditambahkan.");
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.getElementById('add-field-image');
                const container = document.getElementById('input-container-image');
                const maxFields = 3;
                let timelineIndex = 1; // dimulai dari 1 karena field pertama sudah ada di HTML

                button.addEventListener('click', function() {
                    const currentFields = container.querySelectorAll('.image-group').length;

                    if (currentFields < maxFields) {
                        const newGroup = document.createElement('div');
                        newGroup.classList.add('image-group', 'mb-3');
                        newGroup.innerHTML = `
                    <hr class="my-4 border-2">
                    <div class="mb-2">
                        <label>Judul Foto</label>
                        <input class=" form-control" name="foto[${timelineIndex}][judul_foto]" placeholder="Masukkan tanggal/tahun">
                    </div>
                    <div>
                        <label>Foto</label>
                        <input type="file" name="foto[${timelineIndex}][foto]" class="form-control" placeholder="Masukkan Foto">
                    </div>
                `;
                        container.appendChild(newGroup);
                        timelineIndex++;
                    } else {
                        alert("Maksimal hanya 3 field yang boleh ditambahkan.");
                    }
                });
            });
        </script>
    @endpush


</x-layout>
