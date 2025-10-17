<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunny Care - Jasa Perawatan Kelinci</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
    <style>
        /* Custom CSS untuk Frontend */
        body {
            font-family: 'Figtree', sans-serif;
        }
        .navbar-brand img {
            height: 40px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
<a class="navbar-brand" href="{{ url('/') }}">
    <img src="{{ asset('storage/bg/logobunny.png') }}" alt="Logo Bunny Care" class="me-2">
    Bunny Care
</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/gallery') }}">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact') }}">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content') {{-- Ini adalah placeholder di mana konten halaman spesifik akan dimasukkan --}}
    </main>

    ...
<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <p>&copy; 2025 Bunny Care. All Rights Reserved.</p>
        <p>
            Email: <span id="footer-email">Loading...</span> |
            Phone: <span id="footer-phone">Loading...</span> |
            Instagram: <a href="#" target="_blank" class="text-white text-decoration-none" id="footer-instagram">Loading...</a>
        </p>
        <p>Alamat: <span id="footer-address">Loading...</span></p>
    </div>
</footer>

<script>
    // Update footer contact info (dilakukan di setiap halaman agar fleksibel)
    // Ini akan diinisialisasi ulang oleh script di halaman home/gallery/contact
    // Cukup biarkan placeholder "Loading..."
</script>

    </body>
</html>