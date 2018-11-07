<?php

namespace Radial\Domain\TermMeta\Entity;

use Radial\Domain\TermMeta\Entity\Product\ProductLine;
use Radial\Support\Module\EntityAbstract;

class Product extends EntityAbstract
{
    protected $taxonomies = array(
        ProductLine::class,
    );

    public function register()
    {
        foreach ($this->taxonomies as $taxonomy) {
            (new $taxonomy)->register();
        }
    }
}
