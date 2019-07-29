@extends('layouts.page-master')

@section('title')
    Shopping Cart | Company Name
@endsection

@section('content')
@include('inc.messages')

<div class="mt-4">
    <div class="container mx-auto flex flex-col items-start py-8">
        @if (Cart::instance('default')->count() < 1)
            <h2 class="text-gray-900 text-3xl py-2">Your Cart is Empty</h2>
            <a href="{{route('shop.index')}}" class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-2 uppercase tracking-wider font-bold w-30 ">Continue Shopping</a>
    </div>

    <div class="container mx-auto flex justify-start py-8">
        @else
            <h2 class="text-gray-900 text-3xl">{{Cart::count()}} Item(s) in Your Cart</h2>
    </div>

</div>

    <div class="mt-4">
        <div class="container mx-auto flex w-full justify-center flex-wrap">
            @foreach ($cartItems as $item)
                <div class="py-4 px-4 flex  w-3/4 justify-around items-center border-t border-gray-900 ">
                    <div>
                        <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{ productImage($item->model->image) }}" alt="" class="h-24 w-32"></a>
                        {{-- <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{$products->find($item->id)->img}}" alt="" class="h-24"></a> --}}
                    </div>
                    <div>
                        <a href="{{route('shop.show', $item->model->slug)}}"><p>{{$item->model->name}}</p></a>
                        {{-- <a href="{{route('shop.show', $item->model->slug)}}"><p>{{$products->find($item->id)->name}}</p></a> --}}
                        <p class="text-gray-600 text-sm py-1 ">{{$item->model->details}}</p>
                        {{-- <p class="text-gray-600 text-sm py-1 ">{{$products->find($item->id)->details}}</p>  --}}
                    </div>
                    <div>
                        <form action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-xs">Remove</button>
                        </form>
                        {{-- <a href=""><p class="text-xs">Remove</p></a> --}}
                        <form action="{{route('cart.switchToSaveForLater', $item->rowId)}}" method="POST">
                            @csrf

                            <button type="submit" class="text-xs">Save for later</button>
                        </form>
                        {{-- <a href=""><p class="text-xs">Save for later</p></a> --}}
                    </div>
                    <div>
                        <select name="qty" id="" class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                @for ($i = 1; $i < 5 + 1; $i++)
                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div>
                        <p>{{$item->model->presentPrice()}}</p>
                        {{-- <p>{{$products->find($item->id)->presentPrice()}}</p> --}}
                    </div>
                    <div>
                        {{$item->subTotal()}}
                    </div>
                </div>
            @endforeach
            @endif
            @if (!session()->has('coupon'))
        <div class="flex flex-col mt-10 w-3/4">
            <h1 class="mb-2">Have a coupon code?</h1>
            <form action="{{ route('coupon.store') }}" method="POST" class="flex w-full items-baseline px-6 py-6 border border-gray-600">
                @csrf
                <div class="w-1/2">
                    <input type="text" class="border border-gray-300 w-full h-10 text-lg" name="coupon_code" id="coupon_code">
                </div>
                <div class="w-1/2 text-center">
                    <button class="btn">Apply</button>
                </div>
            </form>
        </div>
        @endif
        </div>

    </div>
    @if (Cart::content()->count() > 0)
<div class="mt-4">
    <div class="container mx-auto flex flex-wrap justify-center w-full">
        <div class="flex w-3/4 mt-10 py-4 bg-gray-300 px-4 mb-4">
            <div class="w-full sm:w-1/2">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur omnis ea repellat dignissimos error enim reprehenderit accusamus. Odio, voluptatibus in.</p>
            </div>
            <div class="flex flex-col items-end justify-between w-full sm:w-1/2">
                <div>
                    <p class="text-gray-600 text-sm">Subtotal: €{{ Cart::subTotal()}}</p>
                </div>
                @if (session()->get('coupon'))
                <div class="flex justify-between py-1 px-2 text-gray-600 w-full">
                    <p>Discount: {{ session()->get('coupon')['name'] }}</p>
                    <div>
                            <form action="{{ route('coupon.destroy') }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn-danger">Remove</button>
                            </form>
                        </div>
                    <div>{{ $discount }}</div>
                </div>
                @endif
                @if (session()->has('coupon'))
                <hr class="w-full border-b border-gray-400">
                <div class="flex justify-between py-1 px-2 text-gray-600">
                    <p>Total (including discount):</p> <div>{{ $newSubtotal }}</div>
                    {{-- <p>Total (including discount):</p> <div>{{ Cart::subTotal() }}</div> --}}
                </div>
                <div class="flex justify-between py-1 px-2 text-gray-600">
                    <p>Tax:</p> <div>{{ $newTax }}</div>
                </div>
                <div class="flex justify-between py-1 px-2">
                    <p>Total:</p> <div>{{ $newTotal }}</div>
                </div>
                @else
                <div class="flex justify-between py-1 px-2 text-gray-600">
                    <p>Tax:</p> <div>{{ Cart::Tax() }}</div>
                </div>

                <div class="flex justify-between py-1 px-2">
                    <p>Total:</p> <div>{{ Cart::total() }}</div>
                </div>
                @endif
                {{-- <div>
                    <p class="text-gray-600 text-sm">
                        Tax: €{{Cart::instance('default')->Tax()}}
                    </p>
                </div>
                <div>
                    <p class="text-gray-800">
                        Total: €{{Cart::instance('default')->total()}}
                    </p>
                </div> --}}

            </div>
        </div>
    </div>
    {{-- <div class="flex justify-between py-1 px-2 text-gray-600">
        <p>Subtotal:</p> <div>{{ Cart::subTotal() }}</div>
     </div> --}}




</div>
    @endif
    @if (Cart::count() > 0)
    <div class="my-6">
        <div class="container mx-auto flex justify-center">
            <div class="w-1/2 flex justify-between">
                <div>
                    <a href="{{route('shop.index')}}" class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-3 uppercase tracking-wider font-bold w-30 ">Continue Shopping</a>
                </div>
                <div>
                    <a href="{{ route('checkout.index') }}" class="bg-green-500 hover:bg-green-600 text-white border hover:border border-green-500 hover:border-green-600 px-4 py-3 uppercase tracking-wider font-bold w-30 ">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    @endif


   {{-- Saved for later Cart --}}
    @if (Cart::instance('saveForLater')->content()->count() > 0)
<div>
    <div class="container mx-auto">
        <h1> You have {{Cart::instance('saveForLater')->content()->count()}} Items saved for later</h1>
    </div>
    <div class="container mx-auto">
            @foreach ($saveForLaterItems as $item)
            <div class="py-4 px-4 flex  w-3/4 justify-around items-center border-t border-gray-900 ">
                <div>
                    <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{$item->model->img}}" alt="" class="h-24 object-cover w-12"></a>
                    {{-- <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{$saveForLaterProducts->find($item->id)->img}}" alt="" class="h-24"></a> --}}
                </div>
                <div>
                    <a href="{{route('shop.show', $item->model->slug)}}"><p>{{$item->model->name}}</p></a>
                    {{-- <a href="{{route('shop.show', $item->model->slug)}}"><p>{{$saveForLaterProducts->find($item->id)->name}}</p></a> --}}
                    <p class="text-gray-600 text-sm py-1 flex-1 ">{{$item->model->details}}</p>
                    {{-- <p class="text-gray-600 text-sm py-1 ">{{$saveForLaterProducts->find($item->id)->details}}</p>  --}}
                </div>
                <div>
                    <form action="{{route('saveForLater.destroy', $item->rowId)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-xs">Remove</button>
                    </form>
                    {{-- <a href=""><p class="text-xs">Remove</p></a> --}}
                    <form action="{{route('saveForLater.switchToCart', $item->rowId)}}" method="POST">
                        @csrf

                        <button type="submit" class="text-xs">Move to cart</button>
                    </form>
                    {{-- <a href=""><p class="text-xs">Save for later</p></a> --}}
                </div>
                <div>
                    <span>-</span>
                    {{$item->qty}}
                    <span>+</span>
                </div>
                <div>
                    <p>{{$item->model->presentPrice()}}</p>
                    {{-- <p>{{$saveForLaterProducts->find($item->id)->presentPrice()}}</p> --}}
                </div>
                <div>
                    {{$item->subTotal()}}
                </div>
            </div>
        @endforeach
    </div>
</div>
    @endif

    <div>
        @include('partials.might-also-like')
    </div>

@endsection

@section('scripts')
    <script>
       const classname = document.querySelectorAll('.quantity');


       Array.from(classname).forEach(function (element){
           element.addEventListener('change', function(){
               const id = element.getAttribute('data-id');
               const productQuantity = element.getAttribute('data-productQuantity');
               axios.patch(`/cart/${id}`, {
                   quantity: this.value,
                   productQuantity: productQuantity,
               })
               .then(function(response) {
                //    console.log(response);
                   window.location.href="{{ route('cart.index') }}";
               })
               .catch(function(error){
                   console.log(error);
                   window.location.href="{{ route('cart.index') }}";
               })
           })
       })
    </script>

    {{-- <script>
        const increase = document.querySelectorAll('.increase');
        const decrease = document.querySelectorAll('.decrease');
        const quantity = document.querySelectorAll('.quantity2');

       Array.from(increase).forEach(function(inc) {
           inc.addEventListener('click', increaseCount);

           Array.from(quantity).forEach(function (qty) {

            content = parseInt(qty.textContent);
            increaseCount(content);
        })
       })

       Array.from(decrease).forEach(function (dec) {
           dec.addEventListener('click', descreaseCount)
       });



       function increaseCount(param) {
        console.log(param);

        param ++;

        console.log(content);
       }




       function descreaseCount(qty) {
        console.log('Hello')
       }

    </script> --}}

@endsection
