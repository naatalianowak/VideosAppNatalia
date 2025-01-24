<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Videos App')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto">
        <header>
            <nav class="bg-blue-500 p-4">
                <ul class="flex space-x-4">
                    <li><a href="/" class="text-white">Inicio</a></li>
                    <li><a href="/videos" class="text-white">Videos</a></li>
                    <li><a href="/contact" class="text-white">Contacto</a></li>
                </ul>
            </nav>
        </header>

        <main class="mt-6">
            @yield('content')
        </main>

        <!-- Pie de página -->
        <footer class="bg-gray-800 text-white text-center p-4 mt-6">
            <p>&copy; {{ date('Y') }} VideosApp. Todos los derechos reservados.</p>
        </footer>
    </div>

</body>
</html>
