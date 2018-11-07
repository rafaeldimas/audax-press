<?php

namespace Radial\Domain\Metabox\Entity;

use Radial\Domain\Metabox\Entity\Unit\Unit as UnitMetabox;
use Radial\Support\Module\EntityAbstract;

class Unit extends EntityAbstract
{
    protected $metabox = array(
        UnitMetabox::class,
    );

    public function register()
    {
        foreach ($this->metabox as $metabox) {
            (new $metabox)->register();
        }
    }
}
