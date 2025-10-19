@extends('frontend.layouts.app')

@section('content')
<div class="hero-section d-flex align-items-center">
    <div class="container">
        <div class="hero-text text-white">
            <h1>Welcome to Bunny Care</h1>
            <p>Your trusted partner for rabbit care services</p>
        </div>
    </div>
</div>

<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-center mb-4">Katalog Pelayanan</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($groomingServices->first())
                <img src="{{ $groomingServices->first()->photo_url }}" class="card-img-top" alt="Grooming" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $groomingServices->first()->name }}</h5>
                    <p class="card-text text-muted">Harga: Rp{{ number_format($groomingServices->first()->price, 0, ',', '.') }}</p>
                    <p class="card-text">{{ $groomingServices->first()->description }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#groomingModal">
                        Isi Form Pemesanan
                    </button>
                </div>
                @else
                <div class="card-body">
                    <p class="text-muted">Tidak ada data grooming tersedia.</p>
                </div>
                @endif
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($clinicServices->first())
                <img src="{{ $clinicServices->first()->photo_url }}" class="card-img-top" alt="Bunny Clinic" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $clinicServices->first()->name }}</h5>
                    <p class="card-text text-muted">Harga: Rp{{ number_format($clinicServices->first()->price, 0, ',', '.') }}</p>
                    <p class="card-text">{{ $clinicServices->first()->description }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clinicModal">
                        Isi Form Pemesanan
                    </button>
                </div>
                @else
                <div class="card-body">
                    <p class="text-muted">Tidak ada data clinic tersedia.</p>
                </div>
                @endif
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($hotelServices->first())
                <img src="{{ $hotelServices->first()->photo_url }}" class="card-img-top" alt="Bunny Hotel" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotelServices->first()->name }}</h5>
                    <p class="card-text text-muted">Harga per hari: Rp{{ number_format(optional($hotelServices->first())->price ?? 0, 0, ',', '.') }}</p>
                    <p class="card-text">{{ $hotelServices->first()->description }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotelModal">
                        Isi Form Pemesanan
                    </button>
                </div>
                @else
                <div class="card-body">
                    <p class="text-muted">Tidak ada data hotel tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <hr class="my-5">

    <h2 class="text-center mb-4">Jam Operasional</h2>
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Senin - Jumat</td><td>09:00</td><td>17:00</td></tr>
                    <tr><td>Sabtu</td><td>10:00</td><td>15:00</td></tr>
                    <tr><td>Minggu</td><td colspan="2">Tutup</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="groomingModal" tabindex="-1" aria-labelledby="groomingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="groomingModalLabel">Form Pemesanan Grooming</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('booking.grooming') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="groomingName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="groomingName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="groomingPhone" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="groomingPhone" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="groomingDate" class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control" id="groomingDate" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="groomingProof" class="form-label">Upload Bukti Bayar</label>
                        <input type="file" class="form-control" id="groomingProof" name="proof_of_payment" accept="image/*" required>
                        <small class="form-text text-muted">
                            Nama bank: BCA<br>
                            Nomor rekening: 123456<br>
                            Atas nama: Pangestu
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="clinicModal" tabindex="-1" aria-labelledby="clinicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clinicModalLabel">Form Pemesanan Bunny Clinic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('booking.clinic') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="clinicName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="clinicName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="clinicPhone" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="clinicPhone" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="clinicDate" class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control" id="clinicDate" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="clinicProof" class="form-label">Upload Bukti Bayar</label>
                        <input type="file" class="form-control" id="clinicProof" name="proof_of_payment" accept="image/*" required>
                        <small class="form-text">
                            Nama bank: BCA<br>
                            Nomor rekening: 123456<br>
                            Atas nama: Pangestu
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hotelModal" tabindex="-1" aria-labelledby="hotelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hotelModalLabel">Form Pemesanan Bunny Hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('booking.hotel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="hotelName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="hotelName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="hotelPhone" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="hotelPhone" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="hotelStartDate" class="form-label">Tanggal Mulai Inap</label>
                        <input type="date" class="form-control" id="hotelStartDate" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="hotelEndDate" class="form-label">Tanggal Akhir Inap</label>
                        <input type="date" class="form-control" id="hotelEndDate" name="end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="hotelPrice" class="form-label">Total Harga (Rp)</label>
                        <input type="text" class="form-control" id="hotelPrice" readonly>
                        <small class="form-text text-muted">Harga akan dihitung otomatis.</small>
                    </div>
                    <div class="mb-3">
                        <label for="hotelProof" class="form-label">Upload Bukti Bayar</label>
                        <input type="file" class="form-control" id="hotelProof" name="proof_of_payment" accept="image/*" required>
                        <small class="form-text text-muted">
                            Nama bank: BCA<br>
                            Nomor rekening: 123456<br>
                            Atas nama: Pangestu
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Real-time price calculation for Bunny Hotel
    document.addEventListener('DOMContentLoaded', function() {
        const hotelStartDateInput = document.getElementById('hotelStartDate');
        const hotelEndDateInput = document.getElementById('hotelEndDate');
        const hotelPriceInput = document.getElementById('hotelPrice');
        const pricePerDay = {{ optional($hotelServices->first())->price ?? 50000 }}; // Define price per day from backend or fallback

        function calculateTotalPrice() {
            const startDate = new Date(hotelStartDateInput.value);
            const endDate = new Date(hotelEndDateInput.value);

            if (startDate && endDate && endDate >= startDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const totalPrice = diffDays * pricePerDay;
                hotelPriceInput.value = totalPrice.toLocaleString('id-ID'); // Format to IDR
            } else {
                hotelPriceInput.value = '0';
            }
        }

        hotelStartDateInput.addEventListener('change', calculateTotalPrice);
        hotelEndDateInput.addEventListener('change', calculateTotalPrice);

        // Set min date for end_date to be same as start_date
        hotelStartDateInput.addEventListener('change', function() {
            hotelEndDateInput.min = hotelStartDateInput.value;
            if (hotelEndDateInput.value < hotelStartDateInput.value) {
                hotelEndDateInput.value = hotelStartDateInput.value;
            }
        });

        // Initialize price on page load if dates are already set (e.g., from old input)
        calculateTotalPrice();
    });

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