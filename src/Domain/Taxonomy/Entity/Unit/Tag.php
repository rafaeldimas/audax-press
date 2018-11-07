<?php

namespace Radial\Domain\Taxonomy\Entity\Unit;

use Core\Odin\Taxonomy;

/**
* Tag Taxonomy of Unit
*/
class Tag
{
    public function register()
    {
        new Taxonomy('Tag', 'unit_tag', 'unit');
    }
}
