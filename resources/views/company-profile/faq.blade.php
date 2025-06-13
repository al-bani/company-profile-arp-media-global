@extends('company-profile.Layout.company')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold mb-1 text-center">Pertanyaan Yang Sering Ditanyakan</h1>
        <p class="text-muted mb-4 text-center">Jawaban atas pertanyaan yang sering ditanyakan</p>

        <h4 class="fw-bold mb-3">Getting started</h4>

        <div class="accordion faq-accordion" id="faqAccordion">

            @php
                $faqs = [
                    [
                        'q' => 'How do I install MetaMask?',
                        'a' =>
                            'Visit https://metamask.io/download and choose the appropriate browser or device. Follow the installation steps.',
                    ],
                    [
                        'q' =>
                            'I’m a MetaMask Extension user on Chrome. Can I use the same wallet in MetaMask App on mobile?',
                        'a' => 'Yes, import your wallet on mobile using your seed phrase.',
                    ],
                    [
                        'q' => 'Do I need cryptocurrency to use MetaMask?',
                        'a' =>
                            'No, but to interact with most decentralized applications, you will need some ETH or other tokens.',
                    ],
                    [
                        'q' => 'How do I add crypto to MetaMask? How do I get funds (digital currency) into MetaMask?',
                        'a' => 'You can buy crypto through MetaMask or transfer from another wallet or exchange.',
                    ],
                    [
                        'q' =>
                            'How do I transfer my existing ETH and tokens to MetaMask? How do I send ETH and tokens?',
                        'a' =>
                            'Use your MetaMask address to receive tokens. To send, open MetaMask and use the "Send" option.',
                    ],
                ];
            @endphp

            @foreach ($faqs as $index => $faq)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed shadow-none px-0 py-3 bg-transparent" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                            aria-controls="collapse{{ $index }}">
                            <span class="me-auto">{{ $faq['q'] }}</span>
                            <span class="icon">+</span>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body ps-0 pt-0 pb-3 text-muted">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

