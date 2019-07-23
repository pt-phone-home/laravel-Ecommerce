<?php

namespace App\Http\Controllers;

use App\Product;

class IndexPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();

        return view('index', compact('products'));
    }

    public function thankYou()
    {
        if (!session()->has('success_message')) {
            return redirect()->route('index');
        }
        return view('thankyou');
    }
}