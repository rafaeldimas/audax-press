<?php

namespace Radial\Domain\Metabox\Entity;

use Radial\Domain\Metabox\Entity\Catalog\Catalog as CatalogMetabox;
use Radial\Support\Module\EntityAbstract;

class Catalog extends EntityAbstract
{
    protected $metabox = array(
        CatalogMetabox::class,
    );

    public function register()
    {
        foreach ($this->metabox as $metabox) {
            (new $metabox)->register();
        }
    }
}
