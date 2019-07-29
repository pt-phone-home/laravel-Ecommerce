<?php

// function presentPrice($price)
// {
//     return money_format('€%.2i', $price);
// }

function productImage($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('image/not-found.png');
}

function getNumbers()
{

    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $cartSubtotal = Cart::instance('default')->subTotal();
    $newSubtotal = (($cartSubtotal) - ($discount));
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal + $newTax;

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'cartSubtotal' => $cartSubtotal,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}