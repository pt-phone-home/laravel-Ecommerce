@extends('layouts.page-master')

@section('title')
    {{$product->name}} | E-Shop 
@endsection

@section('content')
<div>
    <div class="container mx-auto bg-gray-300 flex items-baseline pl-10 py-4">
        <a href="/">Home</a>
        <span class="px-2 text-sm"><i class="fal fa-chevron-right"></i></span>
        <a href="{{route('shop.index')}}"><span>Shop</span></a>
        <span class="px-2 text-sm"><i class="fal fa-chevron-right"></i></span>
        <span>{{$product->name}}</span>
    </div>
</div>
<div>
    <div class="container mx-auto flex flex-wrap">
        <div class="w-full md:w-1/2">
            <div class="px-10 py-10 flex justify-center items-center">
                <img src="{{$product->img}}" alt="" class="w-64 h-64 object-cover">
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <div class="flex flex-col items-start py-10 px-10">
                <h2 class="text-gray-900 text-xl text-gray-800">{{$product->name}}</h2>
                <div class="mt-6">
                    <p class="text-gray-700">{{$product->details}}</p>
                </div>
                <div class="mt-4">
                    <h2 class="font-bold text-3xl text-gray-800">{{$product->presentPrice()}}</h2>
                </div>
                <div class="mt-4">
                    <p class="text-gray-600">{{$product->description}}</p>
                </div>
                <div class="flex justify-center mt-4">
                    <form action="{{route('cart.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="name" value="{{$product->name}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <button type="submit" class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-2 uppercase tracking-wider font-bold w-30">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.might-also-like')
    
@endsection

@section('scripts')
    
@endsection