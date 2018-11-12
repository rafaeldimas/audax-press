<?php

namespace GrupoAudax\AudaxPress\Contract;

/**
 * Interface ServiceProvider
 *
 * @package GrupoAudax\AudaxPress\Contract
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
