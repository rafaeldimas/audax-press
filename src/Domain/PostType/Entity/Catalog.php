<?php

namespace Radial\Domain\PostType\Entity;

class Catalog extends PostTypeAbstract
{
    protected $name = 'Catálogo';
    protected $slug = 'catalog';

    protected $args = array(
        'menu_icon' => 'dashicons-list-view',
        'taxonomias' => array('catalog_provider'),
        'rewrite' => array(
            'slug' => 'catalogos/%catalog_provider%',
            'with_front' => false
        ),
        'has_archive' => 'catalogos',
    );

    protected $labels = array();

    public function rewriteUrlPostType($post_link, $post)
    {
        if (is_object($post) && $post->post_type == $this->slug) {
            $terms = wp_get_object_terms($post->ID, 'catalog_provider');
            if ($terms) {
                return str_replace('%catalog_provider%', $terms[0]->slug, $post_link);
            }
        }
        return $post_link;
    }
}
