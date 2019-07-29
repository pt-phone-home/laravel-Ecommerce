@extends('layouts.page-master')

@section('title')
    Search | E-Shop
@endsection

@section('content')
<div>
    <div class="container mx-auto bg-gray-300 flex justify-between items-baseline pl-10 py-4">
        <div class="w-1/3">
            <a href="/">Home</a>
            <span class="px-2 text-sm"><i class="fal fa-chevron-right"></i></span>
            <span>Search</span>
        </div>
        <div class="w-1/3">
            @include('partials.search')
        </div>
    </div>
</div>
@include('inc.messages')
<div>
    <div class="container mx-auto flex flex-col flex-wrap">
        <div>
            <h1 class="text-gray-900 text-3xl">Search Results</h1>
            <p> {{ $products->total() }} result(s) for {{ request()->input('query') }}</p>
        </div>

        <div class="flex justify-center">
            <table>
                <thead>
                    <tr class="flex justify-between px-2 py-2 text-lg text-gray-700 bg-gray-100 my-1 ">
                        <td class="w-1/4">
                            Name
                        </td>
                        <td class="w-1/4">
                            Details
                        </td>
                        <td class="w-1/2">
                            Description
                        </td>
                        <td class="w-1/5">
                            Price
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="flex justify-between border-b border-gray-200 px-2 py-2 items-center text-gray-600 bg-gray-100 hover:bg-gray-300 my-1 self-center">
                            <td class="w-1/4"><a href="{{ route('shop.show', $product->slug) }}" class="hover:underline">{{ $product->name }}</a> </td>
                            <td class="w-1/4">{{ $product->details }}</td>
                            <td class="w-1/2">{!! str_limit($product->description, 80) !!}</td>
                            <td class="w-1/5 text-center">{{ $product->presentPrice() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full my-5">
                {{-- {{ $products->links() }} --}}
                {{ $products->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('scripts')

@endsection
