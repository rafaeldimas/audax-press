<?php

namespace Radial\Domain\Taxonomy\Entity\Slider;
use Core\Odin\Taxonomy;

/**
* Tag Taxonomy of Slider
*/
class Tag
{
    public function register()
    {
        new Taxonomy('Tag', 'slider_tag', 'slider');
    }
}
