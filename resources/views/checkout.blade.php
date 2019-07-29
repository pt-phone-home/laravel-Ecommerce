@extends('layouts.page-master')

@section('title')
    Checkout | E-commerce Site
@endsection

@section('extra-css')
<style>
    .StripeElement {
        box-sizing: border-box;

        height: 40px;
        width: 35rem;

        padding: 10px 12px;

        border: 1px solid #f7fafc;;
        border-radius: 0px;
        background-color: white;
      }

      .StripeElement--focus {
        /* box-shadow: 0 1px 3px 0 #cfd7df; */
      }

      .StripeElement--invalid {
        border-color: #fa755a;
      }

      .StripeElement--webkit-autofill {
        /* background-color: #fefde5 !important; */
      }
</style>
@endsection

@section('content')
    <div>
        <div class="container mx-auto flex justify-start pl-4 border-b border-t border-gray-900 px-4 my-4 text-4xl">
            Checkout
        </div>
    </div>
    @include('inc.messages')
    <div>
        <div class="container mx-auto flex flex-wrap-reverse">
            <div class="w-full md:w-1/2 px-2 py-2">
                <form action="{{ route('checkout.store') }}" method="POST"  class="flex flex-col pr-6" id="payment-form">
                    @csrf
                    <div>
                        <h3 class="text-lg mb-4">Biling Details</h3>
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="text-sm text-gray-600">Email Address:</label>
                        @if (auth()->user())
                        <input type="email" name="email" class="border text-gray-600 pl-2 border-gray-400 w-full" value="{{ auth()->user()->email }}" readonly>
                        @else
                        <input type="email" name="email" class="border border-gray-400 w-full" value="{{ old('email') }}" required>
                        @endif
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="name" class="text-sm text-gray-600">Full Name:</label>
                        <input type="text" name="name" class="border border-gray-400 w-full" value="{{ old('name') }}"  required>
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="address" class="text-sm text-gray-600">Address:</label>
                        <input type="text" name="address" class="border border-gray-400 w-full" value="{{ old('address') }}"  id="address" required>
                    </div>
                    <div class="flex justify-start mt-4">
                        <div class="w-2/5">
                            <label for="city" class="text-sm text-gray-600">City:</label>
                            <input type="text" name="city" class="border border-gray-400 w-full" id="city" value="{{ old('city') }}"  required>
                        </div>
                        <div class="w-2/5 ml-auto">
                            <label for="province" class="text-sm text-gray-600">Province:</label>
                            <input type="text" name="province" class="border border-gray-400 w-full" id="province" value="{{ old('province') }}" required>
                        </div>
                    </div>
                    <div class="flex justify-start mt-4">
                        <div class="w-2/5">
                            <label for="postcode" class="text-sm text-gray-600">Postcode:</label>
                            <input type="text" name="postalcode" class="border border-gray-400 w-full" id="postalcode" value="{{ old('postcode') }}"  required>
                        </div>
                        <div class="w-2/5 ml-auto">
                            <label for="phone" class="text-sm text-gray-600">Phone:</label>
                            <input type="phone" name="phone" class="border border-gray-400 w-full" value="{{ old('phone') }}"  required>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg mb-4">Payments Details</h3>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="nameoncard" class="text-sm text-gray-600">Name on card:</label>
                        <input type="text" name="nameoncard" class="border border-gray-400 w-full" id="name_on_card" value="{{ old('nameoncard') }}"  required>
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="card-element" class="text-sm text-gray-600">
                        Credit or debit card
                        </label>
                        <div id="card-element" class="border border-gray-400 h-6 w-full">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="mt-4 w-full">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white border hover:border border-green-500 hover:border-green-600 px-4 py-3 uppercase tracking-wider font-bold w-30 " id="complete-order">Process Payment</button>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-1/2 px-2 py-2">
                <div class="flex flex-col">
                    <h1>Your Order</h1>
                    @foreach (Cart::instance('default')->content() as $item)
                    <div class="flex justify-between items-center border-b py-2 px-2 border-gray-900">
                        <div>
                            <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{ productImage($item->model->image) }}" alt="" class="h-12"></a>
                            {{-- <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{$products->find($item->id)->img}}" alt="" class="h-24"></a> --}}
                        </div>
                        <div>
                            <a href="{{route('shop.show', $item->model->slug)}}"><p>{{$item->model->name}}</p></a>
                            {{-- <a href="{{route('shop.show', $item->model->slug)}}"><p>{{$products->find($item->id)->name}}</p></a> --}}
                            <p class="text-gray-600 text-sm py-1 ">{{$item->model->details}}</p>
                            {{-- <p class="text-gray-600 text-sm py-1 ">{{$products->find($item->id)->details}}</p>  --}}
                            <p>{{$item->model->presentPrice()}}</p>
                        </div>
                        <div class="border border-gray-900 px-2 py-1">
                            {{$item->qty}}
                        </div>
                        <div>
                            {{$item->subTotal()}}
                        </div>
                    </div>
                        @endforeach
                    <div class="flex flex-col mt-8 bg-gray-200 px-2">
                        <div class="flex justify-between py-1 px-2 text-gray-600">
                           <p>Subtotal:</p> <div>{{ Cart::subTotal() }}</div>
                        </div>
                        @if (session()->get('coupon'))
                        <div class="flex justify-between py-1 px-2 text-gray-600">
                            <p>Discount: {{ session()->get('coupon')['name'] }}</p>
                            <div>
                                     <form action="{{ route('coupon.destroy') }}" method="POST">
                                     @csrf
                                     @method("DELETE")
                                     <button type="submit" class="btn-danger">Remove</button>
                                     </form>
                                </div>
                            <div>{{ $discount }}</div>
                        </div>
                        @endif
                        @if (session()->has('coupon'))
                        <hr class="w-full border-b border-gray-400">
                        <div class="flex justify-between py-1 px-2 text-gray-600">
                           <p>Total (including discount):</p> <div>{{ $newSubtotal }}</div>
                        </div>
                        <div class="flex justify-between py-1 px-2 text-gray-600">
                           <p>Tax:</p> <div>{{ $newTax }}</div>
                        </div>
                        <div class="flex justify-between py-1 px-2">
                           <p>Total:</p> <div>{{ $newTotal }}</div>
                        </div>
                        @else
                        <div class="flex justify-between py-1 px-2 text-gray-600">
                           <p>Tax:</p> <div>{{ Cart::Tax() }}</div>
                        </div>

                        <div class="flex justify-between py-1 px-2">
                           <p>Total:</p> <div>{{ Cart::total() }}</div>
                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3"></script>
    <script>
        // Create a Stripe client.
    var stripe = Stripe('pk_test_V3j3INZxixok45PJnAvD2x3Z');

// Create an instance of Elements.
    var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

// Create an instance of the card Element.
    var card = elements.create('card', {
        style: style,
        hidePostalCode: true,
    });

// Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

// Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

// Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    // disable submit button to prevent repeated clicks
    document.getElementById('complete-order').disabled = true;
    document.getElementById('complete-order').className += 'cursor-not-allowed';

    var options = {
        name: document.getElementById('name_on_card').value,
        address_line1: document.getElementById('address').value,
        address_city: document.getElementById('city').value,
        address_state: document.getElementById('province').value,
        address_zip: document.getElementById('postalcode').value,
    };

    stripe.createToken(card, options).then(function(result) {
        if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        document.getElementById('complete-order').disabled = false;
        document.getElementById('complete-order').className -= 'cursor-not-allowed';
        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
    });
    });

// Submit the form with the token ID.
    function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }

    </script>
@endsection
