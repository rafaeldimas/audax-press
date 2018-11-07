<?php

namespace Radial\Domain\PostType\Entity;

class Product extends PostTypeAbstract
{
    protected $name = 'Produto';
    protected $slug = 'product';

    protected $args = array(
        'menu_icon' => 'dashicons-cart',
        'taxonomias' => array('productline', 'product_category', 'product_tag'),
        'rewrite' => array(
            'slug' => 'produtos/%productline%',
            'with_front' => false
        ),
        'has_archive' => 'produtos',
    );

    protected $labels = array();

    public function rewriteUrlPostType($post_link, $post)
    {
        if (is_object($post) && $post->post_type == $this->slug) {
            $terms = wp_get_object_terms($post->ID, 'productline');
            if ($terms) {
                return str_replace('%productline%', $terms[0]->slug, $post_link);
            }
        }
        return $post_link;
    }
}
