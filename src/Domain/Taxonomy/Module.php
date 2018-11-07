<?php

namespace Radial\Domain\Taxonomy;

use Radial\Domain\Taxonomy\Config\DefaultConfig;
use Radial\Support\Module\ModuleAbstract;

/**
* Taxonomy Module
*/
class Module extends ModuleAbstract
{
    protected $configClass = DefaultConfig::class;

    public function init()
    {
        foreach ($this->config()->getTaxonomy() as $taxonomy) {
            $taxonomy->register();
        }
    }

    public function config()
    {
        return $this->getConfig();
    }
}
