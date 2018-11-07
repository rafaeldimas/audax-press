<?php

namespace Radial\Domain\Taxonomy\Entity;

use Radial\Domain\Taxonomy\Entity\Slider\Category;
use Radial\Domain\Taxonomy\Entity\Slider\Tag;
use Radial\Support\Module\EntityAbstract;

class Slider extends EntityAbstract
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
