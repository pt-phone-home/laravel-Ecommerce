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
    <div class="bg-transparent">
        <div class="container mx-auto flex justify-between pt-10 text-gray-100">
            <div class="w-1/3">
                <a href="/"><h5 class="text-2xl font-bold tracking-widest">Laravel E-Commerce</h5></a>
            </div>
            <div class="w-1/3">
                <div class="flex justify-around">
                    <a href="{{route('shop.index')}}" class="uppercase">Shop</a>
                    <a href="#" class="uppercase">About</a>
                    <a href="#" class="uppercase">Blog</a>
                    <a href="{{route('cart.index')}}" class="uppercase">Cart 
                    @if (Cart::instance('default')->count() > 0)
                        <span class="bg-green-600 px-2 ml-1 py-1 rounded-full">
                            {{Cart::instance('default')->count()}}</span>
                    @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    @yield('content')


    @yield('scripts')
    
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>