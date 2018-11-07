<?php

namespace Radial\Domain\Taxonomy\Entity\Product;

use Core\Odin\Taxonomy;

/**
 * ProductLine Taxonomy of Product
 */
class ProductLine
{
    protected $taxonomy;

    public function register()
    {
        $this->taxonomy = new Taxonomy('Linha de Produto', 'productline', 'product');

        $this->customArguments();
    }

    protected function customArguments()
    {
        $this->taxonomy->set_arguments(array(
            'rewrite' => array(
                'slug' => 'produtos',
                'with_front' => false
            ),
        ));
    }
}
