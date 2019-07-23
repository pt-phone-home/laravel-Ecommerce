<div class="bg-gray-300">
    <div class="container mx-auto flex justify-start py-4">
        <h2 class="text-xl text-gray-900">You might also like...</h2>
    </div>
    <div class="container mx-auto flex flex-wrap py-5">
        @foreach ($mightAlsoLike as $product )
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2 py-2 ">
            <div class="flex flex-col mx-1 pb-2 bg-gray-100">
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