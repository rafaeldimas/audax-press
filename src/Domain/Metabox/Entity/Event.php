<?php

namespace Radial\Domain\Metabox\Entity;

use Radial\Domain\Metabox\Entity\Event\Event as EventMetabox;
use Radial\Support\Module\EntityAbstract;

class Event extends EntityAbstract
{
    protected $metabox = array(
        EventMetabox::class,
    );

    public function register()
    {
        foreach ($this->metabox as $metabox) {
            (new $metabox)->register();
        }
    }
}
