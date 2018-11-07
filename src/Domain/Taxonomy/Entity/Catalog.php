<?php

namespace Radial\Domain\Taxonomy\Entity;

use Radial\Domain\Taxonomy\Entity\Catalog\Provider;
use Radial\Support\Module\EntityAbstract;

class Catalog extends EntityAbstract
{
    protected $taxonomies = array(
        Provider::class,
    );

    public function register()
    {
        foreach ($this->taxonomies as $taxonomy) {
            (new $taxonomy)->register();
        }
    }
}
