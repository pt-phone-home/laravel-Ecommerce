<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use Illuminate\Http\Request;
use Validator;




class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cartItems = Cart::content();
        $ids = $cartItems->pluck('id');
        $products = Product::findMany($ids);
        // dd($ids, $cartItems, $products);
        $mightAlsoLike = Product::mightAlsoLike()->get();

        $saveForLaterItems = Cart::instance('saveForLater')->content();
        $saveForLaterIds = $saveForLaterItems->pluck('id');
        $saveForLaterProducts = Product::findMany($saveForLaterIds);
        // dd($saveForLaterItems);
        return view('cart', compact('mightAlsoLike', 'cartItems', 'products', 'saveForLaterItems', 'saveForLaterProducts'));
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
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart');
        } else {
            $cartItem = Cart::add($request->id, $request->name, 1, $request->price)
                ->associate('App\Product');

            // Cart::associate($cartItem->rowId, \App\Product::class);

            return redirect()->route('cart.index')->with(
                'success_message',
                'Item was added to your cart',
            );
        }
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
        // return $request->all();

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5',
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5']));
            return response()->json(['success' => false], 400);
        }

        Cart::update($id, $request->quantity);

        session()->flash('success_message', 'Quantity updated');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect()->back()->with('success_message', 'Item has been removed');
    }

    public function switchToSaveForLater($id)
    {

        $item = Cart::instance('default')->get($id);

        Cart::instance('default')->remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item already saved for later');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        return redirect()->route('cart.index')->with('success_message', 'Item has been saved for later');
    }
}