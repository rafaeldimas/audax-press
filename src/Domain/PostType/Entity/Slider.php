<?php

namespace Radial\Domain\PostType\Entity;

class Slider extends PostTypeAbstract
{
    protected $name = 'Slider';
    protected $slug = 'slider';

    protected $args = array(
        'menu_icon' => 'dashicons-tickets-alt',
    );

    protected $labels = array();
}
