<?php

namespace App\Models;
use App\Services\ProductService;

/**
 * Class OrderItem
 * @package App\Models
 */
class OrderItem extends Model
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var float
     */
    private $total;

    public function setProductId($id)
    {
        // this could be a singleton
        $productService = new ProductService();
        $this->product = $productService->getFromId($id);
    }

    /**
     * @param $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setUnitPrice($price)
    {
        $this->unitPrice = $price;
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
}