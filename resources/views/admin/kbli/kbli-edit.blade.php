@extends('Layout.layoutAdmin')

<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit KBLI</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/dashboard/kbli/{{ $kbli->id }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Perusahaan (hanya untuk superAdmin) --}}
                @if($role === 'superAdmin')
                    <div class="mb-3">
                        <label for="id_perusahaan" class="form-label">Perusahaan</label>
                        <select name="id_perusahaan" id="id_perusahaan" class="form-select @error('id_perusahaan') is-invalid @enderror" required>
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}" {{ old('id_perusahaan', $kbli->id_perusahaan) == $perusahaan->id ? 'selected' : '' }}>
                                    {{ $perusahaan->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_perusahaan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                {{-- Kode KBLI --}}
                <div class="mb-3">
                    <label for="kode_kbli" class="form-label">Kode KBLI</label>
                    <input type="text" name="kode_kbli" id="kode_kbli" class="form-control @error('kode_kbli') is-invalid @enderror"
                        placeholder="Masukkan kode KBLI (contoh: 6201)" value="{{ old('kode_kbli', $kbli->kode_kbli) }}" required>
                    <small class="form-text text-muted">Format: 4 digit angka (contoh: 6201, 6202, dll)</small>
                    @error('kode_kbli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul KBLI</label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                        placeholder="Masukkan judul KBLI" value="{{ old('judul', $kbli->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-bold">
                        Kategori KBLI
                    </label>
                    <div class="position-relative">
                        <select class="form-select custom-select @error('kategori') is-invalid @enderror" name="kategori" id="kategori" required
                                style="background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 16px 12px; padding-right: 2.5rem;">
                            <option value="" class="text-muted">Pilih Kategori KBLI</option>
                            <option value="A" class="kategori-option" data-icon="🌾" {{ old('kategori', $kbli->kategori) == 'A' ? 'selected' : '' }}>A - Pertanian, Kehutanan dan Perikanan</option>
                            <option value="B" class="kategori-option" data-icon="⛏️" {{ old('kategori', $kbli->kategori) == 'B' ? 'selected' : '' }}>B - Pertambangan dan Penggalian</option>
                            <option value="C" class="kategori-option" data-icon="🏭" {{ old('kategori', $kbli->kategori) == 'C' ? 'selected' : '' }}>C - Industri Pengolahan</option>
                            <option value="D" class="kategori-option" data-icon="⚡" {{ old('kategori', $kbli->kategori) == 'D' ? 'selected' : '' }}>D - Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin</option>
                            <option value="E" class="kategori-option" data-icon="💧" {{ old('kategori', $kbli->kategori) == 'E' ? 'selected' : '' }}>E - Pengadaan Air, Pengelolaan Sampah, Limbah dan Daur Ulang</option>
                            <option value="F" class="kategori-option" data-icon="🏗️" {{ old('kategori', $kbli->kategori) == 'F' ? 'selected' : '' }}>F - Konstruksi</option>
                            <option value="G" class="kategori-option" data-icon="🛒" {{ old('kategori', $kbli->kategori) == 'G' ? 'selected' : '' }}>G - Perdagangan Besar dan Eceran; Reparasi dan Perawatan Mobil dan Sepeda Motor</option>
                            <option value="H" class="kategori-option" data-icon="🚚" {{ old('kategori', $kbli->kategori) == 'H' ? 'selected' : '' }}>H - Transportasi dan Pergudangan</option>
                            <option value="I" class="kategori-option" data-icon="🏨" {{ old('kategori', $kbli->kategori) == 'I' ? 'selected' : '' }}>I - Penyediaan Akomodasi dan Penyediaan Makan Minum</option>
                            <option value="J" class="kategori-option" data-icon="📡" {{ old('kategori', $kbli->kategori) == 'J' ? 'selected' : '' }}>J - Informasi dan Komunikasi</option>
                            <option value="K" class="kategori-option" data-icon="💰" {{ old('kategori', $kbli->kategori) == 'K' ? 'selected' : '' }}>K - Jasa Keuangan dan Asuransi</option>
                            <option value="L" class="kategori-option" data-icon="🏢" {{ old('kategori', $kbli->kategori) == 'L' ? 'selected' : '' }}>L - Real Estate</option>
                            <option value="M" class="kategori-option" data-icon="👨‍💼" {{ old('kategori', $kbli->kategori) == 'M' ? 'selected' : '' }}>M - Jasa Profesional, Ilmiah dan Teknis</option>
                            <option value="N" class="kategori-option" data-icon="📋" {{ old('kategori', $kbli->kategori) == 'N' ? 'selected' : '' }}>N - Jasa Administrasi dan Dukungan Kantor</option>
                            <option value="O" class="kategori-option" data-icon="🏛️" {{ old('kategori', $kbli->kategori) == 'O' ? 'selected' : '' }}>O - Administrasi Pemerintahan, Pertahanan dan Jaminan Sosial Wajib</option>
                            <option value="P" class="kategori-option" data-icon="🎓" {{ old('kategori', $kbli->kategori) == 'P' ? 'selected' : '' }}>P - Jasa Pendidikan</option>
                            <option value="Q" class="kategori-option" data-icon="🏥" {{ old('kategori', $kbli->kategori) == 'Q' ? 'selected' : '' }}>Q - Jasa Kesehatan dan Kegiatan Sosial</option>
                            <option value="R" class="kategori-option" data-icon="🎭" {{ old('kategori', $kbli->kategori) == 'R' ? 'selected' : '' }}>R - Kesenian, Hiburan dan Rekreasi</option>
                            <option value="S" class="kategori-option" data-icon="🔧" {{ old('kategori', $kbli->kategori) == 'S' ? 'selected' : '' }}>S - Kegiatan Jasa Lainnya</option>
                            <option value="T" class="kategori-option" data-icon="🏠" {{ old('kategori', $kbli->kategori) == 'T' ? 'selected' : '' }}>T - Jasa Perumahan dan Makanan</option>
                            <option value="U" class="kategori-option" data-icon="🌍" {{ old('kategori', $kbli->kategori) == 'U' ? 'selected' : '' }}>U - Jasa Organisasi Internasional dan Badan Ekstra-teritorial Lainnya</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Masukkan deskripsi detail tentang KBLI ini" required>{{ old('deskripsi', $kbli->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-center">
                    <a href="/dashboard/kbli" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="ml-2 btn btn-primary px-4">Update KBLI</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Validasi format kode KBLI
        document.getElementById('kode_kbli').addEventListener('input', function(e) {
            let value = e.target.value;
            // Hanya izinkan angka
            value = value.replace(/[^0-9]/g, '');
            // Batasi maksimal 4 digit
            if (value.length > 4) {
                value = value.substring(0, 4);
            }
            e.target.value = value;
        });

        // Auto-select kategori berdasarkan kode KBLI
        document.getElementById('kode_kbli').addEventListener('blur', function(e) {
            const kode = e.target.value;
            if (kode.length === 4) {
                const kategoriSelect = document.getElementById('kategori');
                const firstDigit = kode.charAt(0);

                // Mapping digit pertama ke kategori
                const kategoriMapping = {
                    '1': 'A', '2': 'B', '3': 'C', '4': 'D', '5': 'E',
                    '6': 'F', '7': 'G', '8': 'H', '9': 'I'
                };

                if (kategoriMapping[firstDigit]) {
                    kategoriSelect.value = kategoriMapping[firstDigit];
                }
            }
        });
    </script>
</x-layout>
