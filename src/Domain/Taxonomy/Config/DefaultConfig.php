<?php

namespace Radial\Domain\Taxonomy\Config;

use Radial\Domain\Taxonomy\Entity\Catalog;
use Radial\Domain\Taxonomy\Entity\Event;
use Radial\Domain\Taxonomy\Entity\Product;
use Radial\Domain\Taxonomy\Entity\Slider;
use Radial\Domain\Taxonomy\Entity\Unit;
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

    public function getTaxonomy()
    {
        return $this;
    }
}
