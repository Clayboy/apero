<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Est-ce qu'on peut boire l'apéro ?
    </title>
    {{-- <link rel="stylesheet" href="css/app.css"> --}}
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjXbP3AID2ENE0u4JVsQzY05MEx0zYHQ8&sensor=false"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="wall-{{rand(1,5)}}">
    <div id="app" class="h-screen flex flex-col">
        <div class="flex-grow">
            @yield('content')
        </div>

        <footer class="w-full md:flex md:items-center justify-between">
            <div class="disclaimer text-xs text-white px-4 py-1 md:mx-4 md:rounded-t" style="background:rgba(0,0,0,0.7);">
                L'abus d'alcool est dangereux pour la santé, à consommer avec modération
            </div>
            <div class="credits text-xs text-white px-4 py-1 md:mx-4 md:rounded-t text-right" style="background:rgba(0,0,0,0.7);">
                &copy; {{date('Y')}} <a href="https://bantoni.fr">Bruno ANTONI</a>
            </div>
        </footer>
    </div>

    @yield('scripts')

</body>
</html>
