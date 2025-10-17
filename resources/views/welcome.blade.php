<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')

    </head>
    <body class="antialiased">
    <div class="container mt-5">
        <h1 class="text-primary">Halo Bootstrap 5!</h1>
        <button class="btn btn-success">Tombol Contoh</button>
        <div class="alert alert-info mt-3" role="alert">
            Ini adalah alert Bootstrap.
        </div>
    </div>
</body>
</html>
