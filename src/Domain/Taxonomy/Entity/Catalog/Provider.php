<?php

namespace Radial\Domain\Taxonomy\Entity\Catalog;

use Core\Odin\Taxonomy;

/**
* Provider Taxonomy of Catalog
*/
class Provider
{
    protected $taxonomy;

    public function register()
    {
        $this->taxonomy = new Taxonomy('Fornecedor', 'catalog_provider', 'catalog', 'es');
        $this->customArguments();
    }

    protected function customArguments()
    {
        $this->taxonomy->set_arguments(array(
            'rewrite' => array(
                'slug' => 'catalogos',
                'with_front' => false
            ),
        ));
    }
}
