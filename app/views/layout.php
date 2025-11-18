<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncias Ciudadanas</title>
    <link rel="icon" href="<?php echo BASE_URL; ?>public/img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-800 p-4 text-white">
        <div class="container mx-auto">
            <a href="<?php echo BASE_URL; ?>" class="font-bold text-xl">Municipalidad</a>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        <?php echo $content; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo BASE_URL; ?>public/js/app.js"></script>
</body>

</html>