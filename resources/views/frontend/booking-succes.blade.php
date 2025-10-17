@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg mx-auto" style="max-width: 700px;">
        <div class="card-header bg-primary text-white text-center py-3">
            <h3>Pemesanan {{ $bookingTypeLabel }} Berhasil!</h3>
            <p class="mb-0">Terima kasih telah melakukan pemesanan di Bunny Care.</p>
        </div>
        <div class="card-body p-4">
            <h5 class="card-title text-center mb-4">Detail Pemesanan Anda</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Kode Booking:</strong>
                </div>
                <div class="col-md-6">
                    <span class="badge bg-secondary fs-6">{{ $bookingCode }}</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Nama Pemesan:</strong>
                </div>
                <div class="col-md-6">
                    {{ $booking->name }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Nomor HP:</strong>
                </div>
                <div class="col-md-6">
                    {{ $booking->phone_number }}
                </div>
            </div>

            @if($bookingTypeLabel === 'Grooming' || $bookingTypeLabel === 'Bunny Clinic')
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Booking:</strong>
                </div>
                <div class="col-md-6">
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}
                </div>
            </div>
            @elseif($bookingTypeLabel === 'Bunny Hotel')
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Mulai Inap:</strong>
                </div>
                <div class="col-md-6">
                    {{ \Carbon\Carbon::parse($booking->start_date)->format('d F Y') }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Akhir Inap:</strong>
                </div>
                <div class="col-md-6">
                    {{ \Carbon\Carbon::parse($booking->end_date)->format('d F Y') }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Total Harga:</strong>
                </div>
                <div class="col-md-6">
                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                </div>
            </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Bukti Pembayaran:</strong>
                </div>
                <div class="col-md-6">
                    @if($booking->proof_of_payment)
                        <img src="{{ asset('storage/' . $booking->proof_of_payment) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 150px;">
                    @else
                        Tidak ada bukti pembayaran.
                    @endif
                </div>
            </div>

            <p class="text-center text-muted">Status pemesanan Anda saat ini: <span class="fw-bold text-primary">{{ ucfirst($booking->status) }}</span>. Admin akan segera melakukan konfirmasi.</p>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Update footer contact info from backend (if available) - sama seperti script di halaman lain
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($contactInfo)) // Menggunakan isset karena tidak semua route mengirim contactInfo
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