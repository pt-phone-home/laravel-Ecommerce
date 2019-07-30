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
</head>
<body>
    {{-- Navigation --}}
    <div class="bg-transparent pt-10">
        <div class="container mx-auto flex justify-between items-baseline text-gray-100">
            @include('partials.nav')
        </div>
    </div>
    @yield('content')


    @yield('scripts')

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
