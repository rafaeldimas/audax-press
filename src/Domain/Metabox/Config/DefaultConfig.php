<?php

namespace Radial\Domain\Metabox\Config;

use Radial\Domain\Metabox\Entity\Catalog;
use Radial\Domain\Metabox\Entity\Event;
use Radial\Domain\Metabox\Entity\Product;
use Radial\Domain\Metabox\Entity\Slider;
use Radial\Domain\Metabox\Entity\Unit;
use Radial\Support\Module\ConfigAbstract;

class DefaultConfig extends ConfigAbstract
{
    protected $entities = array(
        Catalog::class,
        Event::class,
        Product::class,
        Slider::class,
        Unit::class,
    );

    public function init()
    {
        foreach ($this->entities as $entity) {
            $this->addEntity(new $entity);
        }

        return $this;
    }

    public function getMetabox()
    {
        return $this;
    }
}
