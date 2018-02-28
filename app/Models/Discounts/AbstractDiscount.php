<?php

namespace App\Models\Discounts;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;

/**
 * Class Discount
 * @package App\Models
 */
abstract class AbstractDiscount
{
    /**
     * @var string
     */
    protected $reason;

    /**
     * AbstractDiscount constructor.
     * @param string $reason
     */
    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public abstract function isApplicable(Order $order);

    /**
     * @param Order $order
     * @return float
     */
    public abstract function getDiscount(Order $order): float;

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     * @return AbstractDiscount
     */
    public function setReason(string $reason): AbstractDiscount
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * @param $amount
     * @return float
     */
    protected function round($amount)
    {
        // we are cheapstakes!
        // also all currencies we support have 2 digit precision.
        return floor($amount * 100) / 100;
    }


    /**
     * @param Order $order
     * @param Category $fCategory
     * @return int
     */
    protected function getTotalOrderedAmountFromCategory(Order $order, Category $fCategory)
    {
        $total = 0;
        foreach ($order->getOrderItems() as $orderItem) {
            $category = $orderItem->getProduct()->getCategory();
            if ($category->equals($fCategory)) {
                $total += $orderItem->getQuantity();
            }
        }
        return $this->round($total);
    }

    protected function getNthCheapestItems(Order $order, $amount)
    {
        $items = $this->getCheapestItems($order);

        // we now have the items sorted on price, so now let's give away free items.
        // not very performanty, but very easily; give one item away at a time.
        // need more performance? Pay actual money.
        $out = [];
        for ($i = 0; $i < $amount; $i ++) {
            if (isset($quantifiedItems[$i])) {
                $out [] = $items[$i]->getUnitPrice();
            }
        }
        return $out;
    }

    /**
     * @param Order $order
     * @return OrderItem[]
     */
    protected function getCheapestItems(Order $order)
    {
        // this is a very special situation
        // we don't know how many of which item has been bought,
        // we just know we need to give $freeItems away.

        // so we first need to sort the items on price.
        $items = $order->getOrderItems();

        usort($items, function(OrderItem $a, OrderItem $b) {
            return $b->getUnitPrice() - $a->getUnitPrice();
        });

        // add to a temporary array for easy access
        // this is probably a bit silly, but I'm sure this work and
        // i'm already at my 4th gin tonic.
        $quantifiedItems = [];
        foreach ($items as $v) {
            $quantity = $v->getQuantity();
            for ($i = 0; $i < $quantity; $i ++) {
                $quantifiedItems[] = $v;
            }
        }

        return $quantifiedItems;
    }
}