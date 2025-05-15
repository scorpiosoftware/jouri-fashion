<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ENV('APP_NAME') }}</title>
    <link rel="icon" href="{{ URL::to('media/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    
    <div class="">
      
 
            <x-home.navbar :categories="$categories" :carousel="$carousel"  />
            <x-home.speed-dial />
            <x-home.carousel :carousel="$carousel" />

            @foreach ($productViews as $view)
                <br>
                <livewire:product-group :view="$view" :title="$view->name">
            @endforeach
            <br>
            <x-home.brands :brands="$brands" />
            <br>
            <br>
            <x-home.footer :carousel="$carousel"/>
    </div>
    </div>
    <x-section.scripts />
    @livewireScripts
</body>

</html>
