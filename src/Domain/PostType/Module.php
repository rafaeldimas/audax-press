<?php

namespace Radial\Domain\PostType;

use Radial\Domain\PostType\Config\DefaultConfig;
use Radial\Support\Module\ModuleAbstract;

/**
* PostType Module
*/
class Module extends ModuleAbstract
{
    protected $configClass = DefaultConfig::class;

    public function init()
    {
        foreach ($this->config()->getPostType() as $posttype) {
            $posttype->register();
        }
    }

    public function config()
    {
        return $this->getConfig();
    }
}
