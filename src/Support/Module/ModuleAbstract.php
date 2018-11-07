<?php

namespace Radial\Support\Module;

use Radial\Support\Module\Contract\Module as ModuleContract;

/**
* Module Abstract
*/
abstract class ModuleAbstract implements ModuleContract
{
    protected $configClass;

    abstract public function init();
    abstract public function config();

    public function getConfig()
    {
        return (new $this->configClass)->init();
    }
}
