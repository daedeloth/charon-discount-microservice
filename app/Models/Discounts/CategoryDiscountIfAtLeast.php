<?php

namespace App\Models\Discounts;

use App\Models\Category;
use App\Models\Order;

/*
 * This was originaly writteh for "If you buy two or more products of category "Tools" (id 1), you get a 20% discount "
 * on the cheapest product."
 * But I read the challenge wrong, so now this is here for no reason.
 */

/**
 * Class CategoryDiscountIfAtLeast
 *
 * This is plain silly!
 * If you buy more than $requireAmount (let's say 1000000000000000 items)
 * ONE of those items (THE CHEAPEST) has a $freePercentage % discount.
 *
 * @package App\Models\Discounts
 */
class CategoryDiscountIfAtLeast extends AbstractDiscount
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @var int
     */
    protected $requiredAmount;

    /**
     * @var float
     */
    protected $freePercentage;

    /**
     * CategoryNthFree constructor.
     * @param Category $category
     * @param $requiredAmount
     * @param $freePercentage
     */
    public function __construct(Category $category, $requiredAmount, $freePercentage)
    {
        parent::__construct(floor($freePercentage * 100) . '% discount cheapest ' . $category->getName() . ' when buying at least ' . $requiredAmount);

        $this->category = $category;
        $this->requiredAmount = $requiredAmount;
        $this->freePercentage = $freePercentage;
    }

    /**
     * @param Order $order
     * @return int
     */
    protected function getTotalOrderedAmount(Order $order)
    {
        $total = 0;
        foreach ($order->getOrderItems() as $orderItem) {
            $category = $orderItem->getProduct()->getCategory();
            if ($category->equals($this->category)) {
                $total += $orderItem->getQuantity();
            }
        }
        return $total;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function isApplicable(Order $order)
    {
        return $this->getTotalOrderedAmountFromCategory($order, $this->category) >= $this->requiredAmount;
    }

    /**
     * @param Order $order
     * @return float
     */
    public function calculateDiscount(Order $order): float
    {
        $items = $this->getCheapestItems($order);

        // just return the first.
        foreach ($items as $v) {
            return $this->round($v->getUnitPrice() * $this->freePercentage);
        }
        return 0;
    }
}