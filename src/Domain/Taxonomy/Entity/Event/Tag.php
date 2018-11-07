<?php

namespace Radial\Domain\Taxonomy\Entity\Event;
use Core\Odin\Taxonomy;

/**
* Tag Taxonomy of Event
*/
class Tag
{
    public function register()
    {
        new Taxonomy('Tag', 'event_tag', 'event');
    }
}
