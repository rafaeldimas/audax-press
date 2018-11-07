<?php

namespace Radial\Domain\PostType\Entity;

class Service extends PostTypeAbstract
{
    protected $name = 'Serviço';
    protected $slug = 'service';

    protected $args = array(
        'menu_icon' => 'dashicons-admin-tools',
    );

    protected $labels = array();
}
