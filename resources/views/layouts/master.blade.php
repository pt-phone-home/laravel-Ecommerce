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
            <div class="w-1/2 flex justify-around items-baseline">
                <a href="/"><h5 class="text-2xl font-bold tracking-widest">E-Commerce</h5></a>
                <a href="{{route('shop.index')}}" class="uppercase {{ Route::current()->getName() === 'shop.index'? 'font-bold': '' }}">Shop</a>
                <a href="#" class="uppercase">About</a>
                <a href="#" class="uppercase">Blog</a>
            </div>
            <div class="w-1/3 flex justify-around items-baseline">
                @guest
                <a href="{{ route('register') }}" class="uppercase" >Sign Up</a>
                <a href="{{ route('login') }}" class="uppercase" >Login</a>
                @else
                <a href="{{ route('logout') }}"
                               class="uppercase"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                @endguest
                <a href="{{route('cart.index')}}" class="uppercase {{ Route::current()->getName() === 'cart.index'? 'font-bold': '' }}">Cart
                @if (Cart::instance('default')->count() > 0)
                    <span class="bg-green-600 px-2 ml-1 py-1 rounded-full">
                        {{Cart::instance('default')->count()}}</span>
                @endif
                </a>
            </div>
        </div>
    </div>
    @yield('content')


    @yield('scripts')

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
