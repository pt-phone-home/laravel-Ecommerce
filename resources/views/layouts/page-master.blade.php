<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="https://kit.fontawesome.com/de93c2514e.js"></script>
    <title>@yield('title')</title>
    @yield('extra-css')
</head>
<body id="app">
    {{-- Navigation --}}
    <div class="bg-gray-800 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-baseline py-10 text-gray-100">
                @include('partials.nav')
        </div>
    </div>
    @yield('content')


    @yield('scripts')

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
