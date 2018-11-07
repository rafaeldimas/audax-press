<?php

namespace Radial\Support\Module;
use Radial\Support\Core\ArrayObject;
use Radial\Support\Module\Contract\Config as ConfigContract;

/**
* Config Abstract
*/
abstract class ConfigAbstract extends ArrayObject implements ConfigContract
{
    abstract public function init();

    public function addEntity(EntityAbstract $entity)
    {
        return $this->set(false, $entity);
    }
}
