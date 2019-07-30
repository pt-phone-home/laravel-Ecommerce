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
            <span>My Profile</span>
        </div>
        {{-- <div class="w-1/3">
            @include('partials.search')
        </div> --}}
    </div>
</div>
<div class="w-full flex bg-gray-100 h-screen fixed mt-2">
    <div class="w-25r bg-gray-200 h-full overflow-scroll px-5 py-5 mr-2">
        <div class="h-full w-full flex flex-col">
            <div class="py-1 px-1 flex items-baseline">
                <i class="fas fa-chevron-right text-sm mr-2 text-gray-800 {{ Route::current()->getName() === 'users.edit' ? 'inline-block' : 'hidden' }}"></i>
                <a href="" class="text-gray-800 hover:text-gray-700 {{ Route::current()->getName() === 'users.edit' ? 'font-bold' : ' ' }}">My Profile</a>
            </div>
            <div class="py-1 px-1 flex items-baseline">
                <i class="fas fa-chevron-right text-sm mr-2 text-gray-800 {{ Route::current()->getName() === 'users.orders' ? 'inline-block' : 'hidden' }}"></i>
                <a href="{{ route('orders.index') }}" class="text-gray-800 hover:text-gray-700 {{ Route::current()->getName() === 'users.orders' ? 'font-bold': ' ' }}">My Orders</a>
            </div>

        </div>
    </div>

    <div class="overflow-scroll bg-gray-200 px-5 py-5 w-full h-full">
        <div class="bg-gray-200 flex flex-col">
            <div>
                @include('inc.messages')
            </div>
            <div>
                <h1 class="text-gray-700 text-2xl font-bold">My Profile </h1>
            </div>
            <div>
            <form class="w-full p-6" method="POST" action="{{ route('users.update', auth()->user()) }}">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-wrap mb-6">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                            Name
                        </label>

                        <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-600 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('name') ? ' border-red-500' : '' }}" name="name" value="{{ old('name', $user->name) }}" required autofocus>

                        @if ($errors->has('name'))
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            E-Mail Address
                        </label>

                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-600 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email', $user->email) }}" required>

                        @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" >

                        @if ($errors->has('password'))
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                    <div class="mb-6">
                        <p class="text-gray-600 text-sm">Leave password blank to keep current password</p>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" >
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-gray-800 hover:bg-gray-700">
                            {{ __('Update Profile') }}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

@endsection
