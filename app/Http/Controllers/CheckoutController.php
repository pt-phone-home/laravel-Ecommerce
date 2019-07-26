<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal')
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
        // dd($request);

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
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect()->route('thankyou.index')->with('success_message', 'Thank you! Your payment has been processed successfully');
        } catch (CardErrorException $e) {
            return redirect()->back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    private function getNumbers()
    {

        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $cartSubtotal = Cart::subtotal();
        $newSubtotal = (($cartSubtotal) - ($discount));
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal + $newTax;

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'cartSubtotal' => $cartSubtotal,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }

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