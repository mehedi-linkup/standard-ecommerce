<?php

function calculateDiscount($price, $discount)
{
    return $price - ($price * ($discount) / 100);
}