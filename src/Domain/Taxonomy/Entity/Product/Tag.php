<?php

namespace Radial\Domain\Taxonomy\Entity\Product;
use Core\Odin\Taxonomy;

/**
* Tag Taxonomy of Product
*/
class Tag
{
    public function register()
    {
        new Taxonomy('Tag', 'product_tag', 'product');
    }
}
