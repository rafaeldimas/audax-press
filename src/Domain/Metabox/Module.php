<?php

namespace Radial\Domain\Metabox;

use Radial\Domain\Metabox\Config\DefaultConfig;
use Radial\Support\Module\ModuleAbstract;

/**
* Metabox Module
*/
class Module extends ModuleAbstract
{
    protected $configClass = DefaultConfig::class;

    public function init()
    {
        foreach ($this->config()->getMetabox() as $metabox) {
            $metabox->register();
        }
    }

    public function config()
    {
        return $this->getConfig();
    }
}
