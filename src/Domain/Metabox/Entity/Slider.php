<?php

namespace Radial\Domain\Metabox\Entity;

use Radial\Domain\Metabox\Entity\Slider\Slider as SliderMetabox;
use Radial\Support\Module\EntityAbstract;

class Slider extends EntityAbstract
{
    protected $metabox = array(
        SliderMetabox::class,
    );

    public function register()
    {
        foreach ($this->metabox as $metabox) {
            (new $metabox)->register();
        }
    }
}
