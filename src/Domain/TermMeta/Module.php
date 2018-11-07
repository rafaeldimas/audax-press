<?php

namespace Radial\Domain\TermMeta;

use Radial\Domain\TermMeta\Config\DefaultConfig;
use Radial\Support\Module\ModuleAbstract;

/**
* TermMeta Module
*/
class Module extends ModuleAbstract
{
    protected $configClass = DefaultConfig::class;

    public function init()
    {
        foreach ($this->config()->getTermMeta() as $termmeta) {
            $termmeta->register();
        }
    }

    public function config()
    {
        return $this->getConfig();
    }
}
