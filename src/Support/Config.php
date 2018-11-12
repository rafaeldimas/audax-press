<?php

namespace GrupoAudax\AudaxPress\Support;

use GrupoAudax\AudaxPress\Contract\Config as ConfigContract;
use Illuminate\Config\Repository;

class Config extends Repository implements ConfigContract
{
    /**
     * Config constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        parent::__construct($configs);
    }
}
