@extends('company-profile.Layout.company')

@section('content')
    <div class="container py-5">

        {{-- Header Perusahaan --}}
        <div class="text-center mb-5">
            <div class="d-flex flex-column align-items-center gap-2">
                {{-- @if (!empty($perusahaans->logo))
                    <img src="{{ asset('images/upload/perusahaan/' . $perusahaans->logo) }}"
                        alt="{{ $perusahaans->nama_perusahaan }}" class="rounded-4 shadow-sm"
                        style="width: 120px; height: 120px; object-fit: cover;">
                @endif --}}
                <h2 class="fw-bold display-6 mb-0">{{ $perusahaans->nama_perusahaan }}</h2>
                <p class="text-muted mb-0">
                    <i class="bi bi-briefcase me-1"></i> Profil Perusahaan • Klasifikasi Baku Lapangan Usaha Indonesia (KBLI)
                </p>
            </div>
        </div>

        {{-- Ringkasan + Pencarian --}}
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h3 class="fw-bold mb-1">KBLI Perusahaan</h3>
                        <small class="text-muted">
                            Total: <span class="badge bg-secondary">{{ $kblis->count() }}</span>
                        </small>
                    </div>
                    <div class="w-100 w-md-auto" style="max-width: 380px;">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input id="kbliSearch" type="text" class="form-control"
                                placeholder="Cari KBLI (kode/judul/kategori/deskripsi)...">
                            <button id="kbliClear" class="btn btn-outline-secondary d-none" type="button">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Daftar KBLI (Accordion Card) --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if ($kblis->isEmpty())
                    <div class="alert alert-light border rounded-4 py-4 text-center">
                        <i class="bi bi-info-circle me-2"></i>
                        KBLI belum tersedia untuk perusahaan ini.
                    </div>
                @else
                    <div class="accordion" id="kbliAccordion">
                        @foreach ($kblis as $idx => $kbli)
                            @php
                                $itemId = 'kbliItem' . $kbli->id;
                                $headingId = 'heading' . $kbli->id;
                                $collapseId = 'collapse' . $kbli->id;
                            @endphp

                            <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 kbli-item"
                                data-kbli-search="{{ Str::lower($kbli->kode_kbli . ' ' . $kbli->judul . ' ' . $kbli->kategori . ' ' . strip_tags($kbli->deskripsi)) }}">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button collapsed rounded-4" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                        aria-expanded="false" aria-controls="{{ $collapseId }}">
                                        <div class="w-100">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <div class="d-flex align-items-center gap-3">
                                                    <span
                                                        class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                                                        <i class="bi bi-upc-scan me-1"></i>{{ $kbli->kode_kbli }}
                                                    </span>
                                                    <span class="fw-semibold">{{ $kbli->judul }}</span>
                                                </div>
                                                <span class="badge bg-dark-subtle text-dark-emphasis">
                                                    <i
                                                        class="bi bi-tags me-1"></i>{{ $kbli->kategori ?? 'Kategori Tidak Tersedia' }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="{{ $collapseId }}" class="accordion-collapse collapse"
                                    aria-labelledby="{{ $headingId }}" data-bs-parent="#kbliAccordion">
                                    <div class="accordion-body">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2">Deskripsi</h6>
                                                <p class="mb-0" style="text-align: justify">
                                                    {{ $kbli->deskripsi ?? '-' }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Hint UX --}}
                    <div class="text-center text-muted small mt-3">
                        <i class="bi bi-hand-index-thumb me-1"></i> Klik item untuk membuka rincian deskripsi KBLI.
                    </div>
                @endif

            </div>
        </div>

        {{-- Aksi Navigasi --}}
        <div class="text-center mt-5">
            <a href="/{{ $perusahaans->nama_perusahaan }}" class="btn btn-outline-primary px-4 py-2 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Homepage
            </a>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const input = document.getElementById('kbliSearch');
            const clearBtn = document.getElementById('kbliClear');
            const items = document.querySelectorAll('.kbli-item');

            function normalize(s) {
                return (s || '').toString().toLowerCase().trim();
            }

            function filter() {
                const q = normalize(input.value);
                let visibleCount = 0;

                items.forEach(el => {
                    const hay = normalize(el.getAttribute('data-kbli-search'));
                    const show = !q || hay.includes(q);
                    el.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });

                clearBtn.classList.toggle('d-none', !q);

                // Jika tidak ada yang cocok, tampilkan alert kecil
                if (!document.getElementById('kbliEmptyState')) {
                    const empty = document.createElement('div');
                    empty.id = 'kbliEmptyState';
                    empty.className = 'alert alert-light border rounded-4 py-3 text-center mt-3';
                    empty.innerHTML = '<i class="bi bi-search"></i> Tidak ada KBLI yang cocok dengan pencarian.';
                    empty.style.display = 'none';
                    document.querySelector('#kbliAccordion')?.after(empty);
                }
                document.getElementById('kbliEmptyState').style.display = (visibleCount === 0) ? '' : 'none';
            }

            input?.addEventListener('input', filter);
            clearBtn?.addEventListener('click', function() {
                input.value = '';
                filter();
                input.focus();
            });

            // Init
            filter();
        })();
    </script>
@endpush
