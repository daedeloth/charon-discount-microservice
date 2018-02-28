<?php

namespace App\Models\Discounts;
use App\Models\Order;

/**
 * Class PercentageOnTotal
 * @package App\Models\Discounts
 */
class PercentageOnTotal extends AbstractDiscount
{
    /**
     * @var float
     */
    protected $requiredTotal;

    /**
     * @var float
     */
    protected $percentageDiscount;

    /**
     * PercentageOnTotal constructor.
     * @param $requiredTotal
     * @param $percentageDiscount
     */
    public function __construct($requiredTotal, $percentageDiscount)
    {
        parent::__construct(($percentageDiscount * 100) . '% discount for our most loyal members (> €' . $requiredTotal . ')');

        $this->requiredTotal = $requiredTotal;
        $this->percentageDiscount = $percentageDiscount;
    }


    /**
     * @param Order $order
     * @return float
     */
    public function calculateDiscount(Order $order): float
    {
        return $this->round($order->getTotal() * $this->percentageDiscount);
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function isApplicable(Order $order)
    {
        $total = $order->getCustomer()->getRevenue();

        // should the order be added to the revenue?
        // I'm going to guess not.
        if ($total > $this->requiredTotal) {
            return true;
        }
        return false;
    }
}