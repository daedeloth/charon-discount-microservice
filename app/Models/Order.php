<?php

namespace App\Models;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var float
     */
    protected $total;

    /**
     * @var OrderItem[]
     */
    protected $orderItems = [];

    /**
     * @param $id
     * @return $this
     */
    public function setCustomerId($id)
    {
        $this->customerId = $id;
        return $this;
    }

    /**
     * @param $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @param array $attributes
     */
    public function addOrderItems(array $attributes)
    {
        $item = new OrderItem();
        $this->orderItems[] = $item;
    }

    /**
     * @return OrderItem[]
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }
}