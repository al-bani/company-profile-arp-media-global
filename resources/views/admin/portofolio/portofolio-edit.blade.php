<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Portofolio</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Portofolio</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/portofolio/{{ $portofolio->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_project">Nama Project</label>
                    <input class="form-control @error('nama_project') is-invalid @enderror"
                           id="nama_project"
                           name="nama_project"
                           value="{{ old('nama_project', $portofolio->nama_project) }}"
                           placeholder="Nama Project" required>
                    @error('nama_project')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi">Deskripsi Project</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                              id="deskripsi"
                              name="deskripsi"
                              rows="3"
                              required>{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="team">Team</label>
                    <input class="form-control @error('team') is-invalid @enderror"
                           id="team"
                           name="team"
                           value="{{ old('team', $portofolio->team) }}"
                           required>
                    @error('team')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tempat">Tempat</label>
                    <input type="text"
                           id="tempat"
                           name="tempat"
                           class="form-control @error('tempat') is-invalid @enderror"
                           value="{{ old('tempat', $portofolio->tempat) }}"
                           required>
                    @error('tempat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                    <input type="date"
                           name="tanggal"
                           id="tanggal"
                           class="form-control @error('tanggal') is-invalid @enderror"
                           value="{{ old('tanggal', $portofolio->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <div class="me-2 w-100">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time"
                               class="form-control @error('jam_mulai') is-invalid @enderror"
                               name="jam_mulai"
                               id="jam_mulai"
                               value="{{ old('jam_mulai', explode('-', $portofolio->waktu)[0] ?? '') }}" required>
                        @error('jam_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="ms-2 w-100">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time"
                               class="form-control @error('jam_selesai') is-invalid @enderror"
                               name="jam_selesai"
                               id="jam_selesai"
                               value="{{ old('jam_selesai', explode('-', $portofolio->waktu)[1] ?? '') }}" required>
                        @error('jam_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="form-select @error('id_perusahaan') is-invalid @enderror"
                            name="id_perusahaan"
                            id="id_perusahaan" required>
                        @foreach ($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id_perusahaan }}"
                                {{ old('id_perusahaan', $portofolio->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Dokumentasi</h5>
                    </div>
                    <div class="card-body">
                        <div id="input-container-image" class="image-group mb-3">
                            @foreach($portofolio->portofolio_foto as $index => $foto)
                            <div class="mb-3">
                                <div class="mb-2">
                                    <label>Judul Foto</label>
                                    <input class="form-control"
                                           type="text"
                                           name="foto[{{ $index }}][judul_foto]"
                                           value="{{ $foto->judul_foto }}"
                                           placeholder="Masukkan Judul Foto" required>
                                </div>
                                <div>
                                    <label>Foto</label>
                                    <input type="file"
                                           name="foto[{{ $index }}][foto]"
                                           class="form-control"
                                           accept="image/*" required>
                                    @if($foto->foto)
                                        <img src="{{ asset($foto->foto) }}"
                                             alt="Current Photo"
                                             class="img-fluid mt-2"
                                             style="max-height: 100px;">
                                    @endif
                                </div>
                            </div>
                            @endforeach
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
                            @foreach($portofolio->portofolio_timeline as $index => $timeline)
                            <div class="mb-3">
                                <div class="mb-2">
                                    <label>Tanggal/Tahun</label>
                                    <input class="form-control"
                                           type="date"
                                           name="timeline[{{ $index }}][tanggal]"
                                           value="{{ $timeline->tanggal }}" required>
                                </div>
                                <div>
                                    <label>Deskripsi</label>
                                    <textarea class="form-control"
                                              name="timeline[{{ $index }}][deskripsi]" required>{{ $timeline->deskripsi }}</textarea>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-field">+ Tambah Field</button>
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <a href="/dashboard/portofolio" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                let timelineIndex = {{ count($portofolio->portofolio_timeline) }};

                button.addEventListener('click', function() {
                    const currentFields = container.querySelectorAll('.timeline-group').length;

                    if (currentFields < maxFields) {
                        const newGroup = document.createElement('div');
                        newGroup.classList.add('timeline-group', 'mb-3');
                        newGroup.innerHTML = `
                            <hr class="my-4 border-2">
                            <div class="mb-2">
                                <label>Tanggal/Tahun</label>
                                <input class="form-control" type="date" name="timeline[${timelineIndex}][tanggal]">
                            </div>
                            <div>
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="timeline[${timelineIndex}][deskripsi]"></textarea>
                            </div>
                        `;
                        container.appendChild(newGroup);
                        timelineIndex++;
                    } else {
                        alert("Maksimal hanya 5 field yang boleh ditambahkan.");
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const button = document.getElementById('add-field-image');
                const container = document.getElementById('input-container-image');
                const maxFields = 3;
                let imageIndex = {{ count($portofolio->portofolio_foto) }};

                button.addEventListener('click', function() {
                    const currentFields = container.querySelectorAll('.image-group').length;

                    if (currentFields < maxFields) {
                        const newGroup = document.createElement('div');
                        newGroup.classList.add('image-group', 'mb-3');
                        newGroup.innerHTML = `
                            <hr class="my-4 border-2">
                            <div class="mb-2">
                                <label>Judul Foto</label>
                                <input class="form-control" name="foto[${imageIndex}][judul_foto]" placeholder="Masukkan Judul Foto" required>
                            </div>
                            <div>
                                <label>Foto</label>
                                <input type="file" name="foto[${imageIndex}][foto]" class="form-control" accept="image/*" required>
                            </div>
                        `;
                        container.appendChild(newGroup);
                        imageIndex++;
                    } else {
                        alert("Maksimal hanya 3 field yang boleh ditambahkan.");
                    }
                });
            });
        </script>
    @endpush
</x-layout>
