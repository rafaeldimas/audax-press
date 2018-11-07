<?php

namespace Radial\Domain\PostType\Entity;

class Unit extends PostTypeAbstract
{
    protected $name = 'Unidade';
    protected $slug = 'unit';

    protected $args = array(
        'menu_icon' => 'dashicons-admin-home',
        'taxonomias' => array('unit_category', 'unit_tag'),
        'has_archive' => 'unidades',
    );

    protected $labels = array();
}
