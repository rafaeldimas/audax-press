<?php

namespace Audax\AudaxPress\Contract;

/**
 * Interface ServiceProvider
 *
 * @package Audax\AudaxPress\Contract
 *
 * @property $bindings
 * @property $singletons
 */
interface ServiceProvider
{
    /**
     * @return mixed
     */
    public function register();

    /**
     * @return mixed
     */
    public function boot();
}
