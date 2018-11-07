<?php

namespace Radial\Domain\Metabox\Entity;

use Radial\Domain\Metabox\Entity\Product\Product as ProductMetabox;
use Radial\Support\Module\EntityAbstract;

class Product extends EntityAbstract
{
    protected $metabox = array(
        ProductMetabox::class,
    );

    public function register()
    {
        foreach ($this->metabox as $metabox) {
            (new $metabox)->register();
        }
    }
}
