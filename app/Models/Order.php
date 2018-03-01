<?php

namespace App\Models;

use App\Services\CustomerService;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    /**
     * @var Customer
     */
    protected $customer;

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
        // Singeltones could be used, yes! Or a smarter "service" factory.
        $customerService = new CustomerService();
        $customer = $customerService->getFromId($id);
        if (!$customer) {
            abort(404, 'Customer not found');
        }

        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
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
     * @param array $items
     */
    public function addOrderItems(array $items)
    {
        foreach ($items as $v) {
            $this->orderItems[] = $v;
        }
    }

    /**
     * @return OrderItem[]
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @toto this could probably be calculated from the items.
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}