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
    protected $product;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var float
     */
    protected $unitPrice;

    /**
     * @var float
     */
    protected $total;

    /**
     * @param $id
     */
    public function setProductId($id)
    {
        // this could be a singleton, but it is not.
        $productService = new ProductService();
        $this->product = $productService->getFromId($id);

        if (!$this->product) {
            abort(404, 'Product not found.');
        }
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
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

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }
}