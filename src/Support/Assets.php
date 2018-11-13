<?php

namespace GrupoAudax\AudaxPress\Support;


use GrupoAudax\AudaxPress\Support\Assets\Scripts;
use GrupoAudax\AudaxPress\Support\Assets\Styles;

class Assets
{
    /**
     * @var Scripts
     */
    protected $scripts;

    /**
     * @var Styles
     */
    protected $styles;

    public function __construct(Scripts $scripts, Styles $styles)
    {
        $this->scripts = $scripts;
        $this->styles = $styles;
    }
}
