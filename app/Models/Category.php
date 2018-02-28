<?php

namespace App\Models;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    public function __construct($data)
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function setId(int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function equals(Category $category)
    {
        return $this->id == $category->getId();
    }
}