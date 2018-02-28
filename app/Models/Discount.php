<?php

namespace App\Models;

/**
 * Class Discount
 * @package App\Models
 */
class Discount
{
    /**
     * @param Order $order
     * @return bool
     */
    public function isApplicable(Order $order)
    {
        return false;
    }
}