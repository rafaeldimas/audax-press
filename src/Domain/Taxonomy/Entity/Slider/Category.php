<?php

namespace Radial\Domain\Taxonomy\Entity\Slider;
use Core\Odin\Taxonomy;

/**
* Category Taxonomy of Slider
*/
class Category
{
    public function register()
    {
        new Taxonomy('Categoria', 'slider_category', 'slider');
    }
}
