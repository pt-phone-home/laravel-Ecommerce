@extends('layouts.page-master')

@section('title')
    Thank You | E-commerce Site
@endsection

@section('content')
    @include('inc.messages')
    <div class="">
        <div class="flex justify-center items-center h-64">
            <div class="flex flex-col items-center w-1/3">
                <div class="py-2">
                    <h1 class="text-xl text-gray-900">Thank you for your order</h1>
                </div>
                <div class="py-2">
                    <p>A confirmation email has been sent</p>
                </div>
                <div>
                    <a href="{{ route('index') }}"><button class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-gray-100 border hover:border border-gray-900 hover:border-gray-100 px-4 py-2 uppercase tracking-wider font-bold w-30 ">Home</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
