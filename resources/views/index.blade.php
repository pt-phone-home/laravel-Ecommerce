@extends('layouts.master')

@section('title', 'E-commerce Store | Home')

@section('content')
<div class="bg-gray-800 hero-bg -mt-20">
    <div class="container mx-auto pt-20">
        <div class="flex flex-wrap justify-center py-20">
            <div class="w-full md:w-1/2">
                <div class="flex flex-col items-end mt-20 mb-12">
                    <h1 class="text-gray-100 text-4xl capitalize">Welcome to your online store</h1>
                    <div class="mt-5">
                        <p class="text-gray-100 text-xl">We offer a great range of products and competitive prices</p>
                    </div>
                    <div class="flex justify-end w-2/3 mt-10">
                        <div class="mx-4">
                            <button class="bg-transparent hover:bg-gray-100 text-gray-100 hover:text-gray-800 border hover:border border-gray-100 hover:border-gray-100 px-4 py-2 uppercase text-sm tracking-wider font-light w-30 ">Blog</button>
                        </div>
                        <div class="mx-4">
                            <button class="bg-transparent hover:bg-gray-100 text-gray-100 hover:text-gray-800 border hover:border border-gray-100 hover:border-gray-100 px-4 py-2 uppercase text-sm tracking-wider font-light w-30 ">Product Reviews</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex justify-center items-center mt-20">
                    <i class="fal fa-phone-laptop text-10xl text-gray-100"></i>
                </div>
            </div>

        </div>
    </div>
</div>
<div>
    <div class="container mx-auto flex flex-col items-center">
        <h1 class="mt-4 mb-2 text-gray-900 capitalize text-4xl">Gadgets Online</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut consequuntur quaerat animi blanditiis. Labore sit, excepturi soluta molestias unde fugiat?</p>
    </div>
</div>
<div class="mt-10 mb-4">
    <div class="container mx-auto flex justify-center">
        <div class="w-3/4 flex justify-center">
            <div class="mx-4">
                <button class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-2 uppercase tracking-wider font-bold w-30 ">featured</button>
            </div>
            <div class="mx-4">
                <button class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-2 uppercase tracking-wider font-bold w-30 ">On sale</button>
            </div>
        </div>
    </div>
</div>
<div class="mt-10 mb-4">
    <div class="container mx-auto w-70p flex justify-center flex-wrap">
        @foreach ($products as $product)
        <div class="w-full sm:w-1/2 lg:w-1/3 px-1 py-1 px-4 mb-2">
            <div class="flex flex-col">
                <a href="{{route('shop.show', $product->slug)}}">
                    <div class="flex justify-center w-full mb-1">
                        <img src="{{$product->img}}" alt="" class="rounded w-full h-64 sm:h-32 md:h-48 object-cover">
                    </div>
                </a>
                <a href="{{route('shop.show', $product->slug)}}">
                    <div class="mb-1 text-center">
                        <h3 class="text-xl">{{$product->name}}</h3>
                    </div>
                </a>
                <div class="text-center">
                    <p class="italic font-hairline text-lg">{{$product->presentPrice()}}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<div class="mt-5 mb-4">
        <div class="container mx-auto flex justify-center">
            <div class="">
            <a href="{{route('shop.index')}}"><button class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-2 uppercase tracking-wider font-bold w-30 ">View more products</button></a>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection