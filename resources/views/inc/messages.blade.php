<div>
    <div class="container mx-auto flex justify-center">
        @if (session()->has('success_message'))
            <div class="bg-green-300 w-1/2 px-4 py-4">
                {{session()->get('success_message')}}
            </div>
        @endif
        @if ($errors->count() > 0)
            <ul class="bg-red-500 text-gray-100 px-4 py-4">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
