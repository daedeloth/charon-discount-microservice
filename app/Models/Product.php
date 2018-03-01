<?php

namespace App\Models;
use App\Services\CategoryService;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{

    /*
     * "id": "A101",
     * "description": "Screwdriver",
     * "category": "1",
     * "price": "9.75"
     */

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var float
     */
    protected $price;

    public function __construct($attributes = [])
    {
        // Again, singleton is probably a good idea.
        $categoryService = new CategoryService();

        $this->id = $attributes['id'];
        $this->description = $attributes['description'];
        $this->category = $categoryService->getFromId($attributes['category']);
        if (!$this->category) {
            abort(404, 'Category not found');
        }

        $this->price = $attributes['price'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Product
     */
    public function setId(string $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function setCategory(Category $category): Product
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }
}