<?php

namespace App\Models\Discounts;

use App\Models\Category;

/*
 * This was originaly writteh for "If you buy two or more products of category "Tools" (id 1), you get a 20% discount "
 * on the cheapest product."
 * But I read the challenge wrong, so now this is here for no reason.
 */

/**
 * Class CategoryNthFree
 * @package App\Models\Discounts
 */
class CategoryNthFree extends CategoryNthDiscount
{
    /**
     * PercentageOnTotal constructor.
     * @param Category $category
     * @param $requiredAmount
     * @param $freeAmount
     */
    public function __construct(Category $category, $requiredAmount, $freeAmount)
    {
        // 1 because 1 = 100% discount.
        parent::__construct($category, $requiredAmount, $freeAmount, 1);
    }
}