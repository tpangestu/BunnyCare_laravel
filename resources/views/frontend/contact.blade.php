@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Hubungi Kami</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if($contactInfo)
                        <p><strong>Email:</strong> <span id="contact-email">{{ $contactInfo->email ?? 'info@bunnycare.com' }}</span></p>
                        <p><strong>Nomor WA:</strong> <span id="contact-phone">{{ $contactInfo->phone_number ?? '+62 812 3456 7890' }}</span></p>
                        <p><strong>Instagram:</strong> <a href="https://instagram.com/{{ str_replace('@', '', $contactInfo->instagram ?? 'bunnycare') }}" target="_blank" class="text-decoration-none" id="contact-instagram">{{ $contactInfo->instagram ?? '@bunnycare' }}</a></p>
                        <p><strong>Alamat:</strong> <span id="contact-address">{{ $contactInfo->address ?? 'Jl. Kelinci No. 123, Depok, Indonesia' }}</span></p>
                    @else
                        <p>Informasi kontak belum tersedia.</p>
                    @endif
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header">
                    Lokasi Kami
                </div>
                <div class="card-body">
                    @if($contactInfo && $contactInfo->map_embed_code)
                        <div class="embed-responsive embed-responsive-16by9" style="height: 400px; width: 100%;">
                            {!! $contactInfo->map_embed_code !!}
                        </div>
                    @else
                        <p class="text-center">Peta lokasi belum tersedia.</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2673523533967!2d106.8209843147693!3d-6.360178395383569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed286b208945%3A0xc3f6a2e2d0a0d4c1!2sDepok%20Town%20Square!5e0!3m2!1sen!2sid!4v1625471410729!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update footer contact info from backend (if available)
    document.addEventListener('DOMContentLoaded', function() {
        @if($contactInfo)
            const footerEmail = document.getElementById('footer-email');
            const footerPhone = document.getElementById('footer-phone');
            const footerInstagram = document.getElementById('footer-instagram');
            const footerAddress = document.getElementById('footer-address');

            if (footerEmail) footerEmail.textContent = "{{ $contactInfo->email ?? 'N/A' }}";
            if (footerPhone) footerPhone.textContent = "{{ $contactInfo->phone_number ?? 'N/A' }}";
            if (footerInstagram) footerInstagram.textContent = "{{ $contactInfo->instagram ?? 'N/A' }}";
            if (footerInstagram) footerInstagram.href = "https://instagram.com/{{ str_replace('@', '', $contactInfo->instagram ?? '') }}";
            if (footerAddress) footerAddress.textContent = "{{ $contactInfo->address ?? 'N/A' }}";
        @endif
    });
</script>
@endsection