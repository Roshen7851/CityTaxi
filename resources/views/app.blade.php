<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/18602b848e.js" crossorigin="anonymous"></script>

        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUbPrIOwCEjuGyJBucwbsl9tXiWBKNHX8&libraries=places"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased dark:bg-slate-800">
        @inertia
    </body>
</html>
