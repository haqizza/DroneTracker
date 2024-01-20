<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script> -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    @vite('resources/css/app.css')
    <script src="{{ asset('build/assets/app.50483fe4.js') }}"></script>
    <script src="https://kit.fontawesome.com/7750908ac9.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('js/flight-indicators-js/css/flight-indicators.css') }}">
    <link rel="stylesheet" href="{{ asset('js/center-leafet/L.Control.MapCenterCoord.min.css') }}">
    <script src="{{ asset('js/center-leafet/L.Control.MapCenterCoord.min.js') }}"></script>
    <script src="{{ asset('js/flight-indicators-js/js/flight-indicators.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/js/gauge/gauge.min.js"></script>
    <title>Tracker</title>
</head>

<body class="bg-[#393E46] text-[#eeeeee]">
    {{-- @include('template.loader') --}}
    <div class="flex h-[100vh]">
        @yield('content')
    </div>
    <script>
        // window.addEventListener('load', () => {
        //     const loader = document.querySelector('.loader');
        //     loader.classList.add('loader-hidden');
        // })
    </script>
</body>

</html>
