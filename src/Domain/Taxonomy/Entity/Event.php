<?php

namespace Radial\Domain\Taxonomy\Entity;

use Radial\Domain\Taxonomy\Entity\Event\Category;
use Radial\Domain\Taxonomy\Entity\Event\Tag;
use Radial\Support\Module\EntityAbstract;

class Event extends EntityAbstract
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
