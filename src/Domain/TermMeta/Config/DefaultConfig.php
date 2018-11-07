<?php

namespace Radial\Domain\TermMeta\Config;

use Radial\Domain\TermMeta\Entity\Catalog;
use Radial\Domain\TermMeta\Entity\Product;
use Radial\Support\Module\ConfigAbstract;

class DefaultConfig extends ConfigAbstract
{
    protected $entities = array(
        Catalog::class,
        Product::class,
    );

    public function init()
    {
        foreach ($this->entities as $entity) {
            $this->addEntity(new $entity);
        }

        return $this;
    }

    public function getTermMeta()
    {
        return $this;
    }
}
