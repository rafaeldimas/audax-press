<?php

namespace Radial\Domain\TermMeta\Entity;

use Radial\Domain\TermMeta\Entity\Catalog\Provider;
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
