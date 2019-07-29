<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mockery\CountValidator\Exception;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tax = config('cart.tax') / 100;
        // $discount = session()->get('coupon')['discount'] ?? 0;
        // $cartSubtotal = Cart::subtotal();
        // $newSubtotal = (($cartSubtotal) - ($discount));
        // $newTax = $newSubtotal * $tax;
        // $newTotal = $newSubtotal + $newTax;


        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        $cart = Cart::instance('default')->content();
        return view('checkout')->with([
            'cart' => $cart,
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return redirect()->back()->withErrors('Sorry, one of the items in your cart is no longer avaialable');
        }

        $contents = Cart::instance('default')->content()->map(function ($item) {
            return $item->model->slug . ',' . $item->qty;
        })->values()->toJson();

        try {

            $charge = Stripe::charges()->create([
                'amount' => Cart::instance('default')->total(),
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                ],
            ]);

            $order = $this->addToOrdersTable($request, null);

            Mail::to($request->email)->send(new OrderPlaced($order));

            // Decrease quantities of all items in cart

            $this->decreaseQuantities();

            Cart::instance('default')->destroy();
            session()->forget('coupon');



            return redirect()->route('thankyou.index')->with('success_message', 'Thank you! Your payment has been processed successfully');
        } catch (CardErrorException $e) {
            $this->addToOrdersTable($request, $e->getMessage());
            return redirect()->back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTable($request, $error)
    {
        // Insert into Orders Table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->nameoncard,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into Order_Product Table
        foreach (Cart::instance('default')->content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }

            return false;
        }
    }


    // private function getNumbers()
    // {

    //     $tax = config('cart.tax') / 100;
    //     $discount = session()->get('coupon')['discount'] ?? 0;
    //     $code = session()->get('coupon')['name'] ?? null;
    //     $cartSubtotal = Cart::subtotal();
    //     $newSubtotal = (($cartSubtotal) - ($discount));
    //     if ($newSubtotal < 0) {
    //         $newSubtotal = 0;
    //     }
    //     $newTax = $newSubtotal * $tax;
    //     $newTotal = $newSubtotal + $newTax;

    //     return collect([
    //         'tax' => $tax,
    //         'discount' => $discount,
    //         'code' => $code,
    //         'cartSubtotal' => $cartSubtotal,
    //         'newSubtotal' => $newSubtotal,
    //         'newTax' => $newTax,
    //         'newTotal' => $newTotal,
    //     ]);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}