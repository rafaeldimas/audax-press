<?php

namespace Audax\AudaxPress\Support;

use Audax\AudaxPress\Application;
use Audax\AudaxPress\Contract\ServiceProvider as ServiceProviderContract;

abstract class ServiceProvider implements ServiceProviderContract
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
