@extends('layouts.page-master')

@section('title')
    Shop
@endsection

@section('content')
<div>
    <div class="container mx-auto bg-gray-300 flex items-baseline pl-10 py-4">
        <a href="/">Home</a>
        <span class="px-2 text-sm"><i class="fal fa-chevron-right"></i></span>
        <span>Shop</span>
    </div>
</div>
<div class="mt-4 pt-10">
    <div class="container mx-auto flex flex-wrap ">
        <div class="w-full md:w-1/4 bg-green-100 sticky top-0 ">
            <div class="flex justify-center py-2">
                <h2 class="text-lg">Categories</h2>
            </div>
            <div class="flex flex-col pl-4 justify-around">
                @foreach ($categories as $category)
                    <li class="{{ request()->category == $category->slug ? 'font-bold' : '' }} list-none"><a href="{{ route('shop.index', ['category' => $category->slug])  }}" class="py-1">{{ $category->name }}</a></li>
                @endforeach
            </div>
            <div class="flex flex-col pl-4 justify-around">

            </div>
        </div>
        <div class="w-full md:w-3/4 flex flex-wrap  bg-blue-100 h-screen">
            <div class="w-full py-2 flex justify-between">
                <h2 class="px-4 text-xl capitalize">{{ $categoryName }}</h2>
                <div>
                    <p class="inline-block">Price</p>
                    <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'Low_High' ]) }}" class="px-1 text-gray-600 hover:text-gray-900">Low to High</a>
                    <span class="px-1">|</span>
                    <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'High_Low' ]) }}" class="px-1 text-gray-600 hover:text-gray-900">High to Low</a>
                </div>
            </div>
            @forelse ($products as $product)
            <div class="w-full sm:w-1/2 lg:w-1/3 px-1 py-1 px-4 mb-2">
                <div class="flex flex-col">
                    <a href="{{route('shop.show', ['slug' => $product->slug])}}">
                        <div class="flex justify-center w-full mb-1">
                            <img src="{{  productImage($product->image) }}" alt="" class="rounded w-full h-64 sm:h-32 md:h-48 object-cover">
                        </div>
                    </a>
                    <a href="{{route('shop.show', ['slug' => $product->slug])}}">
                        <div class="mb-1 text-center">
                            <h3 class="text-xl">{{$product->name}}</h3>
                        </div>
                    </a>
                    <div class="text-center">
                        <p class="italic font-hairline text-lg">{{$product->presentPrice()}}</p>
                    </div>
                </div>
            </div>
            @empty
                <div class="self-start items-start w-full sm:w-1/2 lg:w-1/3 px-1 py-1 px-4 mb-2">
                    <h3>No Items Founds</h3>
                </div>
            @endforelse

            <div class="w-full">
                    {{-- {{ $products->links() }} --}}
                    {{ $products->appends(request()->input())->links() }}
            </div>


        </div>

    </div>
</div>

@endsection

@section('scripts')

@endsection
