<?php

namespace Radial\Domain\Taxonomy\Entity\Unit;

use Core\Odin\Taxonomy;

/**
* Category Taxonomy of Unit
*/
class Category
{
    public function register()
    {
        new Taxonomy('Categoria', 'unit_category', 'unit');
    }
}
