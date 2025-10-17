@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Galeri Kami</h2>
    @if($galleryPhotos->isEmpty())
        <p class="text-center">Belum ada foto di galeri saat ini.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($galleryPhotos as $photo)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $photo->photo_url }}" class="card-img-top" alt="{{ $photo->caption ?? 'Gallery Photo' }}" style="height: 250px; object-fit: cover;">
                    @if($photo->caption)
                    <div class="card-body">
                        <p class="card-text text-center">{{ $photo->caption }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif
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