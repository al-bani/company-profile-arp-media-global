@extends('Layout.layoutAdmin')

<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat FAQ</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('faq.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="3" required>{{ old('pertanyaan') }}</textarea>
                    @error('pertanyaan')
                        <div class="invalid-feedback">
                            {{ $message ?? '' }}
                        </div>
                    @enderror
                </div>

                @if ($role === 'superAdmin')
                <div class="mb-3">
                    <label for="id_perusahaan" class="form-label">Perusahaan</label>
                    <select class="form-control @error('id_perusahaan') is-invalid @enderror" id="id_perusahaan" name="id_perusahaan" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id_perusahaan }}" {{ old('id_perusahaan') == $perusahaan->id_perusahaan ? 'selected' : '' }}>{{ $perusahaan->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                    @error('id_perusahaan')
                        <div class="invalid-feedback">
                            {{ $message ?? '' }}
                        </div>
                    @enderror
                </div>
                @endif

                <div class="mb-3">
                    <label for="jawaban" class="form-label">Jawaban</label>
                    <textarea class="form-control @error('jawaban') is-invalid @enderror" id="jawaban" name="jawaban" rows="4" required>{{ old('jawaban') }}</textarea>
                    @error('jawaban')
                        <div class="invalid-feedback">
                            {{ $message ?? '' }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('faq.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>

