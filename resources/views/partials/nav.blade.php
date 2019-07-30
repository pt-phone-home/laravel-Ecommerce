<div class="w-1/2 flex justify-around items-baseline">
    <a href="/"><h5 class="text-2xl font-bold tracking-widest">E-Commerce</h5></a>
    <a href="{{route('shop.index')}}" class="uppercase {{ Route::current()->getName() === 'shop.index'? 'font-bold': '' }}">Shop</a>
    <a href="#" class="uppercase">About</a>
    <a href="#" class="uppercase">Blog</a>
</div>
<div class="w-1/3">
<div class="flex justify-around">
    @guest
    <a href="{{ route('register') }}" class="uppercase" >Sign Up</a>
    <a href="{{ route('login') }}" class="uppercase" >Login</a>
    @else
    <a href="{{ route('users.edit') }}" class="uppercase">My Account</a>
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
        <span class="bg-green-600 px-2 ml-1 py-1 rounded-full">{{Cart::instance('default')->count()}}</span>
        @endif
    </a>
</div>
</div>
