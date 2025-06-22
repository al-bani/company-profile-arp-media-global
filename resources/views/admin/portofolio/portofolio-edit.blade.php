<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Portofolio</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Portofolio</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/portofolio/{{ $portofolio->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_project">Nama Project</label>
                    <input class="form-control @error('nama_project') is-invalid @enderror" id="nama_project"
                        name="nama_project" value="{{ old('nama_project', $portofolio->nama_project) }}"
                        placeholder="Nama Project" required>
                    @error('nama_project')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi">Deskripsi Project</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
                        required>{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status_project">Status Project</label>
                    <select class="ms-1 form-select btn btn-primary" id="status_project" name="status_project" required>
                        <option value="">Pilih Status</option>
                        <option value="ongoing"
                            {{ old('status_project', $portofolio->status_project) == 'ongoing' ? 'selected' : '' }}>
                            Sedang Berjalan</option>
                        <option value="done"
                            {{ old('status_project', $portofolio->status_project) == 'done' ? 'selected' : '' }}>Selesai
                        </option>
                    </select>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Team</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <label>Nama Team</label>
                                    <input type="text" name="nama_team" class="form-control"
                                        placeholder="Masukkan Nama Team"
                                        value="{{ $portofolio->teams->first() ? $portofolio->teams->first()->team : '' }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="team-container" class="team-group mb-3">
                            @if($portofolio->teams->count() > 0)
                                @foreach ($portofolio->teams as $index => $teamMember)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-grow-1">
                                            <label>Anggota</label>
                                            <input type="text" name="team[{{ $index }}][anggota]"
                                                class="form-control" value="{{ $teamMember->anggota }}"
                                                placeholder="Masukkan Nama Anggota" required>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-grow-1">
                                        <label>Anggota</label>
                                        <input type="text" name="team[0][anggota]"
                                            class="form-control" value=""
                                            placeholder="Masukkan Nama Anggota" required>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" id="add-team-field">Tambah Anggota</button>
                            <button type="button" class="btn btn-danger ml-2" id="remove-team-field">Hapus
                                Anggota</button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tempat">Lokasi Kegiatan</label>
                    <div class="d-flex gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_lokasi" id="offline"
                                value="offline"
                                {{ !in_array($portofolio->tempat, ['website', 'online_meeting', 'desain']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="offline">
                                Offline
                            </label>
                        </div>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="radio" name="jenis_lokasi" id="online"
                                value="online"
                                {{ in_array($portofolio->tempat, ['website', 'online_meeting', 'desain']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="online">
                                Online
                            </label>
                        </div>
                    </div>

                    <div id="offline-field"
                        style="{{ in_array($portofolio->tempat, ['website', 'online_meeting', 'desain']) ? 'display: none;' : '' }}">
                        <input type="text" id="tempat" name="tempat_offline" class="form-control"
                            value="{{ !in_array($portofolio->tempat, ['website', 'online_meeting', 'desain']) ? $portofolio->tempat : '' }}"
                            placeholder="Masukkan lokasi kegiatan" required>
                    </div>

                    <div id="online-field"
                        style="{{ !in_array($portofolio->tempat, ['website', 'online_meeting', 'desain']) ? 'display: none;' : '' }}">
                        <select class="form-select" name="tempat" id="jenis_online" required>
                            <option value="">Pilih jenis kegiatan online</option>
                            <option value="website" {{ $portofolio->tempat == 'website' ? 'selected' : '' }}>Website
                            </option>
                            <option value="online_meeting"
                                {{ $portofolio->tempat == 'online_meeting' ? 'selected' : '' }}>Online Meeting</option>
                            <option value="desain" {{ $portofolio->tempat == 'desain' ? 'selected' : '' }}>Desain
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                        value="{{ old('tanggal', $portofolio->tanggal) }}" required>
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <div class="me-2 w-100">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                            name="jam_mulai" id="jam_mulai"
                            value="{{ old('jam_mulai', explode('-', $portofolio->waktu)[0] ?? '') }}" required>
                        @error('jam_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="ms-2 w-100">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                            name="jam_selesai" id="jam_selesai"
                            value="{{ old('jam_selesai', explode('-', $portofolio->waktu)[1] ?? '') }}" required>
                        @error('jam_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="id_perusahaan">Perusahaan</label>
                    <select class="ms-1 form-select btn btn-secondary" name="id_perusahaan" id="id_perusahaan"
                        required>
                        @foreach ($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id_perusahaan }}"
                                {{ old('id_perusahaan', $portofolio->id_perusahaan) == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                {{ $perusahaan->id_perusahaan . ' - ' . $perusahaan->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Dokumentasi</h5>
                    </div>
                    <div class="card-body">
                        <div id="input-container-image" class="image-group mb-3">
                            @foreach ($portofolio->portofolio_foto as $index => $foto)
                                <div class="image-item">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <img id="preview-{{ $index }}"
                                                src="{{ asset('images/upload/portofolio/' . $foto->foto) }}"
                                                class="card-img-top border" alt="Preview Foto"
                                                style="height: 10rem; width: 10rem; object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <div class="mb-2">
                                                <label>Judul Foto</label>
                                                <input class="form-control" type="text"
                                                    name="foto[{{ $index }}][judul_foto]"
                                                    value="{{ $foto->judul_foto }}"
                                                    placeholder="Masukkan Judul Foto" required>
                                            </div>
                                            <div>
                                                <label>Foto</label>
                                                <input type="file" name="foto[{{ $index }}][foto]"
                                                    class="form-control" accept="image/*"
                                                    onchange="previewImage(this, 'preview-{{ $index }}')" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" id="add-field-image">Tambah
                                Dokumentasi</button>
                            <button type="button" class="btn btn-danger ml-2" id="remove-field-image">Hapus
                                Dokumentasi</button>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div id="timeline-container" class="timeline-group mb-3">
                            @foreach ($portofolio->portofolio_timeline as $index => $timeline)
                                <div class="timeline-item">
                                    <div class="mb-2">
                                        <label>Tanggal/Tahun</label>
                                        <input class="form-control" type="date"
                                            name="timeline[{{ $index }}][tanggal]"
                                            value="{{ $timeline->tanggal }}" required>
                                    </div>
                                    <div>
                                        <label>Deskripsi</label>
                                        <textarea name="timeline[{{ $index }}][deskripsi]" class="form-control" required>{{ $timeline->deskripsi }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" id="add-timeline-field">Tambah
                                Timeline</button>
                            <button type="button" class="btn btn-danger ml-2" id="remove-timeline-field">Hapus
                                Timeline</button>
                        </div>
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
            function previewImage(input, previewId) {
                const preview = document.getElementById(previewId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk menambah dan menghapus field team
                const teamButton = document.getElementById('add-team-field');
                const removeTeamButton = document.getElementById('remove-team-field');
                const teamContainer = document.getElementById('team-container');
                let teamIndex = {{ $portofolio->teams->count() > 0 ? $portofolio->teams->count() : 0 }};

                teamButton.addEventListener('click', function() {
                    const newGroup = document.createElement('div');
                    newGroup.classList.add('d-flex', 'align-items-center', 'mb-3');
                    newGroup.innerHTML = `
                        <div class="flex-grow-1">
                            <label>Anggota</label>
                            <input type="text" name="team[${teamIndex}][anggota]" class="form-control" placeholder="Masukkan Nama Anggota" required>
                        </div>
                    `;
                    teamContainer.appendChild(newGroup);
                    teamIndex++;
                });

                removeTeamButton.addEventListener('click', function() {
                    const fields = teamContainer.querySelectorAll('.d-flex');
                    if (fields.length > 1) {
                        teamContainer.removeChild(fields[fields.length - 1]);
                        teamIndex--;
                    } else {
                        // Jika hanya tersisa 1 field, kosongkan isinya
                        const lastField = fields[0];
                        const input = lastField.querySelector('input');
                        if (input) {
                            input.value = '';
                        }
                    }
                });

                // Fungsi untuk menambah dan menghapus field timeline
                const timelineButton = document.getElementById('add-timeline-field');
                const removeTimelineButton = document.getElementById('remove-timeline-field');
                const timelineContainer = document.getElementById('timeline-container');
                let timelineIndex = {{ count($portofolio->portofolio_timeline) }};

                timelineButton.addEventListener('click', function() {
                    const newGroup = document.createElement('div');
                    newGroup.classList.add('timeline-item', 'mb-3');
                    newGroup.innerHTML = `
                        <hr class="my-4 border-2">
                        <div class="mb-2">
                            <label>Tanggal/Tahun</label>
                            <input class="form-control" type="date" name="timeline[${timelineIndex}][tanggal]" required>
                        </div>
                        <div>
                            <label>Deskripsi</label>
                            <textarea name="timeline[${timelineIndex}][deskripsi]" class="form-control" required></textarea>
                        </div>
                    `;
                    timelineContainer.appendChild(newGroup);
                    timelineIndex++;
                });

                removeTimelineButton.addEventListener('click', function() {
                    const fields = timelineContainer.querySelectorAll('.timeline-item');
                    if (fields.length > 1) {
                        timelineContainer.removeChild(fields[fields.length - 1]);
                        timelineIndex--;
                    }
                });

                // Fungsi untuk menambah dan menghapus field dokumentasi
                const imageButton = document.getElementById('add-field-image');
                const removeImageButton = document.getElementById('remove-field-image');
                const imageContainer = document.getElementById('input-container-image');
                let imageIndex = {{ count($portofolio->portofolio_foto) }};

                imageButton.addEventListener('click', function() {
                    const newGroup = document.createElement('div');
                    newGroup.classList.add('image-item', 'mb-3');
                    newGroup.innerHTML = `
                        <hr class="my-4 border-2">
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <img id="preview-${imageIndex}" src="/images/default.jpg" class="card-img-top border" alt="Preview Foto"
                                    style="height: 10rem; width: 10rem; object-fit: cover;">
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label>Judul Foto</label>
                                    <input class="form-control" name="foto[${imageIndex}][judul_foto]" placeholder="Masukkan Judul Foto" required>
                                </div>
                                <div>
                                    <label>Foto</label>
                                    <input type="file" name="foto[${imageIndex}][foto]" class="form-control" accept="image/*" onchange="previewImage(this, 'preview-${imageIndex}')" required>
                                </div>
                            </div>
                        </div>
                    `;
                    imageContainer.appendChild(newGroup);
                    imageIndex++;
                });

                removeImageButton.addEventListener('click', function() {
                    const fields = imageContainer.querySelectorAll('.image-item');
                    if (fields.length > 1) {
                        imageContainer.removeChild(fields[fields.length - 1]);
                        imageIndex--;
                    }
                });

                // Fungsi untuk menangani perubahan jenis lokasi
                const offlineRadio = document.getElementById('offline');
                const onlineRadio = document.getElementById('online');
                const offlineField = document.getElementById('offline-field');
                const onlineField = document.getElementById('online-field');
                const tempatInput = document.getElementById('tempat');
                const jenisOnlineSelect = document.getElementById('jenis_online');

                function updateFields() {
                    if (offlineRadio.checked) {
                        offlineField.style.display = 'block';
                        onlineField.style.display = 'none';
                        tempatInput.required = true;
                        jenisOnlineSelect.required = false;
                    } else {
                        offlineField.style.display = 'none';
                        onlineField.style.display = 'block';
                        tempatInput.required = false;
                        jenisOnlineSelect.required = true;
                    }
                }

                offlineRadio.addEventListener('change', updateFields);
                onlineRadio.addEventListener('change', updateFields);

                // Inisialisasi awal
                updateFields();
            });
        </script>
    @endpush
</x-layout>
