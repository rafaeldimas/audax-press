<?php

namespace Radial\Domain\Taxonomy\Entity;

use Radial\Domain\Taxonomy\Entity\Product\Category;
use Radial\Domain\Taxonomy\Entity\Product\ProductLine;
use Radial\Domain\Taxonomy\Entity\Product\Tag;
use Radial\Support\Module\EntityAbstract;

class Product extends EntityAbstract
{
    protected $taxonomies = array(
        Category::class,
        ProductLine::class,
        Tag::class,
    );

    public function register()
    {
        foreach ($this->taxonomies as $taxonomy) {
            (new $taxonomy)->register();
        }
    }
}
