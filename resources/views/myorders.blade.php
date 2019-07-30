@php
use Carbon\Carbon;
@endphp
@extends('layouts.page-master')

@section('title')
   My Profile | {{ auth()->user()->name }}
@endsection

@section('content')
<div class="bg-gray-300">
    <div class="container mx-auto bg-gray-300 flex justify-between items-baseline pl-10 py-4">
        <div class="w-1/3">
            <a href="/">Home</a>
            <span class="px-2 text-sm"><i class="fal fa-chevron-right"></i></span>
            <span>My Orders</span>
        </div>
        {{-- <div class="w-1/3">
            @include('partials.search')
        </div> --}}
    </div>
</div>
<div class="w-full flex bg-gray-100 h-screen fixed mt-2">
    <div class="w-25r bg-gray-200 overflow-scroll px-5 py-5 mr-2">
        <div class="h-full w-full flex flex-col">
            <div class="py-1 px-1 flex items-baseline">
                <i class="fas fa-chevron-right text-sm mr-2 text-gray-800 {{ Route::current()->getName() === 'users.edit' ? 'inline-block' : 'hidden' }}"></i>
                <a href="{{ route('users.edit') }}" class="text-gray-800 hover:text-gray-700 {{ Route::current()->getName() === 'users.edit' ? 'font-bold' : ' ' }}">My Profile</a>
            </div>
            <div class="py-1 px-1 flex items-baseline">
                <i class="fas fa-chevron-right text-sm mr-2 text-gray-800 {{ Route::current()->getName() === 'orders.index' ? 'inline-block' : 'hidden' }}"></i>
                <a href="{{ route('orders.index') }}" class="text-gray-800 hover:text-gray-700 {{ Route::current()->getName() === 'orders.index' ? 'font-bold': ' ' }}">My Orders</a>
            </div>

        </div>
    </div>

    <div class="overflow-scroll bg-gray-200 px-5 py-5 w-full py-1 h-auto">
        <div class="bg-gray-200 flex flex-col">
            <div>
                @include('inc.messages')
            </div>
            <div>
                <h1 class="text-gray-700 text-2xl font-bold">My Orders </h1>
            </div>
            <div class="flex flex-wrap">
                @forelse ($orders as $order)
                <div class="w-full md:w-1/3 px-2 py-2 my-1 border border-gray-500">
                    <div class="flex flex-col">
                       <div>
                           {{ $order->id }}
                       </div>
                       <div>
                           <a href="{{ route('orders.show', $order->id) }}">Order Details</a>
                       </div>
                       <div>
                           €{{ $order->billing_total }}
                       </div>
                       @foreach ($order->products as $product)
                               <div>{{ $product->name }}</div>
                               <div class="h-32 w-32"><img src="{{ productImage($product->image) }}" alt="" class="w-full w-full object-cover"></div>
                       @endforeach

                    </div>
                </div>
                @empty
                    <div>
                        <h1>You don't have any orders yet</h1>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

@endsection
