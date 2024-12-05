<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Aquí puedes incluir tus archivos CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Agregar Bootstrap CSS y JS -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Aquí se incluye el menú lateral -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Menú superior aquí -->
        </nav>
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Menú lateral aquí -->
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Aquí puedes incluir tus scripts JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
