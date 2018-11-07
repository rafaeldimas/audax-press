<?php

namespace Radial\Domain\PostType\Entity;

class Event extends PostTypeAbstract
{
    protected $name = 'Evento';
    protected $slug = 'event';

    protected $args = array(
        'menu_icon' => 'dashicons-calendar-alt',
    );

    protected $labels = array();
}
