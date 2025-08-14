@extends('company-profile.Layout.company')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold mb-1 text-center">Pertanyaan Yang Sering Ditanyakan</h1>
        <p class="text-muted mb-4 text-center">Jawaban atas pertanyaan yang sering ditanyakan</p>

        <h4 class="fw-bold mb-3">Daftar Pertanyaan</h4>

        <div class="accordion faq-accordion" id="faqAccordion">

            @foreach ($faqs as $index => $faq)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed shadow-none px-0 py-3 bg-transparent" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                            aria-controls="collapse{{ $index }}">
                            <span class="me-auto">{{ $faq->pertanyaan }}</span>
                            <span class="icon">+</span>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body ps-0 pt-0 pb-3 text-muted">
                            {{ $faq->jawaban }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

