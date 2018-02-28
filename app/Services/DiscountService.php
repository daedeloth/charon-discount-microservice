<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Discounts\AbstractDiscount;
use App\Models\Discounts\CategoryDiscountIfAtLeast;
use App\Models\Discounts\CategoryNthDiscount;
use App\Models\Discounts\CategoryNthFree;
use App\Models\Discounts\PercentageOnTotal;

/**
 * Class DiscountService
 * @package App\Services
 */
class DiscountService
{
    /**
     * @return AbstractDiscount[]
     */
    public static function getAll()
    {
        $categoryService = new CategoryService();

        $out = [];

        /** @var Category $switchCategory */
        $switchCategory = $categoryService->getFromId(2);

        /**
         * @var Category $toolCategory
         */
        $toolCategory = $categoryService->getFromId(1);

        $out[] = new PercentageOnTotal(1000, 0.1);
        $out[] = new CategoryNthFree($switchCategory, 5, 1.0);
        $out[] = new CategoryDiscountIfAtLeast($toolCategory, 2, .2);

        return $out;
    }
}