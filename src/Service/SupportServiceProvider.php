<?php

namespace GrupoAudax\AudaxPress\Service;

use GrupoAudax\AudaxPress\Support\Assets;
use GrupoAudax\AudaxPress\Support\Optimize;
use GrupoAudax\AudaxPress\Support\Path;
use GrupoAudax\AudaxPress\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public $bindings = [];

    public $singletons = [
        Path::class => Path::class,
        Assets::class => Assets::class,
        Assets\Scripts::class => Assets\Scripts::class,
        Assets\Styles::class => Assets\Styles::class,
        Optimize::class => Optimize::class,
    ];

    /**
     * @return mixed
     */
    public function register()
    {
        // TODO: Implement service() method.
    }

    /**
     * @return mixed
     */
    public function boot()
    {
        // TODO: Implement boot() method.
    }
}
