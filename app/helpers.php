<?php

// function presentPrice($price)
// {
//     return money_format('€%.2i', $price);
// }

function productImage($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('image/not-found.png');
}