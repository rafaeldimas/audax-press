<?php

namespace Radial\Domain\Taxonomy\Entity\Product;
use Core\Odin\Taxonomy;

/**
* Category Taxonomy of Product
*/
class Category
{
    public function register()
    {
        new Taxonomy('Categoria', 'product_category', 'product');
    }
}
