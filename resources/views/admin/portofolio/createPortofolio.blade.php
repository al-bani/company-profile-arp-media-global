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

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Team</h5>
                    </div>
                    <div class="card-body">
                        <div id="team-container" class="team-group mb-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <label>Anggota</label>
                                    <input type="text" name="team[0][anggota]" class="form-control" placeholder="Masukkan Nama Anggota">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" id="add-team-field">Tambah Anggota</button>
                            <button type="button" class="btn btn-danger ml-2" id="remove-team-field">Hapus Anggota</button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tempat">Lokasi Kegiatan</label>
                    <div class="d-flex gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_lokasi" id="offline" value="offline" checked>
                            <label class="form-check-label" for="offline">
                                Offline
                            </label>
                        </div>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="radio" name="jenis_lokasi" id="online" value="online">
                            <label class="form-check-label" for="online">
                                Online
                            </label>
                        </div>
                    </div>

                    <div id="offline-field">
                        <input type="text" id="tempat" name="tempat" class="form-control" placeholder="Masukkan lokasi kegiatan" required>
                    </div>

                    <div id="online-field" style="display: none;">
                        <select class="form-select" name="jenis_online" id="jenis_online">
                            <option value="">Pilih jenis kegiatan online</option>
                            <option value="website">Website</option>
                            <option value="online_meeting">Online Meeting</option>
                            <option value="desain">Desain</option>
                        </select>
                    </div>
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
                            <div class="image-item">
                                <div class="row align-items-center mb-3">
                                    <div class="col-auto">
                                        <img id="preview-0" src="/images/default.jpg" class="card-img-top border" alt="Preview Foto"
                                            style="height: 10rem; width: 10rem; object-fit: cover;">
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <label>Judul Foto</label>
                                            <input class="form-control" type="text" name="foto[0][judul_foto]" placeholder="Masukkan Judul Foto">
                                        </div>
                                        <div>
                                            <label>Foto</label>
                                            <input type="file" name="foto[0][foto]" class="form-control" placeholder="foto" accept="image/*" onchange="previewImage(this, 'preview-0')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" id="add-field-image">Tambah Dokumentasi</button>
                            <button type="button" class="btn btn-danger ml-2" id="remove-field-image">Hapus Dokumentasi</button>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div id="timeline-container" class="timeline-group mb-3">
                            <div class="timeline-item">
                                <div class="mb-2">
                                    <label>Tanggal/Tahun</label>
                                    <input class="form-control" type="date" name="timeline[0][tanggal]" placeholder="Masukkan tanggal/tahun">
                                </div>
                                <div>
                                    <label>Deskripsi</label>
                                    <textarea name="timeline[0][deskripsi]" class="form-control" placeholder="Masukkan deskripsi"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" id="add-timeline-field">Tambah Timeline</button>
                            <button type="button" class="btn btn-danger ml-2" id="remove-timeline-field">Hapus Timeline</button>
                        </div>
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
                let teamIndex = 1;

                teamButton.addEventListener('click', function() {
                    const newGroup = document.createElement('div');
                    newGroup.classList.add('d-flex', 'align-items-center', 'mb-3');
                    newGroup.innerHTML = `
                        <div class="flex-grow-1">
                            <label>Anggota</label>
                            <input type="text" name="team[${teamIndex}][anggota]" class="form-control" placeholder="Masukkan Nama Anggota">
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
                    }
                });

                // Fungsi untuk menambah dan menghapus field timeline
                const timelineButton = document.getElementById('add-timeline-field');
                const removeTimelineButton = document.getElementById('remove-timeline-field');
                const timelineContainer = document.getElementById('timeline-container');
                let timelineIndex = 1;

                timelineButton.addEventListener('click', function() {
                    const newGroup = document.createElement('div');
                    newGroup.classList.add('timeline-item', 'mb-3');
                    newGroup.innerHTML = `
                        <hr class="my-4 border-2">
                        <div class="mb-2">
                            <label>Tanggal/Tahun</label>
                            <input class="form-control" type="date" name="timeline[${timelineIndex}][tanggal]" placeholder="Masukkan tanggal/tahun">
                        </div>
                        <div>
                            <label>Deskripsi</label>
                            <textarea name="timeline[${timelineIndex}][deskripsi]" class="form-control" placeholder="Masukkan deskripsi"></textarea>
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
                let imageIndex = 1;

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
                                    <input class="form-control" name="foto[${imageIndex}][judul_foto]" placeholder="Masukkan Judul Foto">
                                </div>
                                <div>
                                    <label>Foto</label>
                                    <input type="file" name="foto[${imageIndex}][foto]" class="form-control" placeholder="Masukkan Foto" accept="image/*" onchange="previewImage(this, 'preview-${imageIndex}')">
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
