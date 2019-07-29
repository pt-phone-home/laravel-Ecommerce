<form action="{{ route('search') }}" method="GET" >
    @csrf
    <i class="far fa-search mr-2 text-gray-600 text-lg"></i>
    <input type="search" name="query" value="{{ request()->input('query') }}" class="w-4/5 px-2 py-1 rounded-lg text-gray-500" placeholder="Search for product">
</form>
