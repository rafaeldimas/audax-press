<?php

namespace Radial\Domain\Taxonomy\Entity\Event;
use Core\Odin\Taxonomy;

/**
* Category Taxonomy of Event
*/
class Category
{
    public function register()
    {
        new Taxonomy('Categoria', 'event_category', 'event');
    }
}
