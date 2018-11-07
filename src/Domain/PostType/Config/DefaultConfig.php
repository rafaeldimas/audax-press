<?php

namespace Radial\Domain\PostType\Config;

use Radial\Domain\PostType\Entity\Catalog;
use Radial\Domain\PostType\Entity\Event;
use Radial\Domain\PostType\Entity\Product;
use Radial\Domain\PostType\Entity\Service;
use Radial\Domain\PostType\Entity\Slider;
use Radial\Domain\PostType\Entity\Unit;
use Radial\Support\Module\ConfigAbstract;

class DefaultConfig extends ConfigAbstract
{
    protected $entities = array(
        Catalog::class,
        Event::class,
        Product::class,
        Slider::class,
        Unit::class,
        Service::class,
    );

    public function init()
    {
        foreach ($this->entities as $entity) {
            $this->addEntity(new $entity);
        }

        return $this;
    }

    public function getPostType()
    {
        return $this;
    }
}
