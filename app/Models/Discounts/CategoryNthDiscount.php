<?php

namespace App\Models\Discounts;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;

/**
 * Class CategoryNthDiscount
 * @package App\Models\Discounts
 */
class CategoryNthDiscount extends AbstractDiscount
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @var float
     */
    protected $requiredAmount;

    /**
     * @var float
     */
    protected $freeAmount;

    /**
     * @var float
     */
    protected $discountPercentage;

    /**
     * PercentageOnTotal constructor.
     * @param Category $category
     * @param $requiredAmount
     * @param $freeAmount
     * @param $discountPercentage
     */
    public function __construct(Category $category, $requiredAmount, $freeAmount, $discountPercentage)
    {
        parent::__construct($requiredAmount . 'th item free on all ' . $category->getName());

        $this->category = $category;
        $this->requiredAmount = $requiredAmount;
        $this->freeAmount = $freeAmount;
        $this->discountPercentage = $discountPercentage;
    }


    /**
     * @param Order $order
     * @return float
     */
    public function getDiscount(Order $order): float
    {
        $discount = 0;
        foreach ($this->getNthCheapestItems($order, $this->requiredAmount) as $v) {
            $discount += $v * $this->discountPercentage;
        }

        return $discount;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function isApplicable(Order $order)
    {
        $total = $this->getTotalOrderedAmountFromCategory($order, $this->category);

        if ($total >= $this->requiredAmount) {
            return true;
        }

        return false;
    }
}