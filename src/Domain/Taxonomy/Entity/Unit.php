<?php

namespace Radial\Domain\Taxonomy\Entity;

use Radial\Domain\Taxonomy\Entity\Unit\Category;
use Radial\Domain\Taxonomy\Entity\Unit\Tag;
use Radial\Support\Module\EntityAbstract;

class Unit extends EntityAbstract
{
    protected $taxonomies = array(
        Category::class,
        Tag::class,
    );

    public function register()
    {
        foreach ($this->taxonomies as $taxonomy) {
            (new $taxonomy)->register();
        }
    }
}
