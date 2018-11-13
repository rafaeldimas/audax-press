<?php

namespace GrupoAudax\AudaxPress\Support;

use GrupoAudax\AudaxPress\Application;
use GrupoAudax\AudaxPress\Contract\Support\ServiceProvider as ServiceProviderContract;

abstract class ServiceProvider implements ServiceProviderContract
{
    /**
     * @var Application 
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
