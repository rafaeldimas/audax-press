<?php

namespace Radial\Domain\Metabox\Entity\Product;

use Radial\Support\Domain\Metabox\MetaboxAbstract;

class Product extends MetaboxAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setMetabox('product', 'Produto', 'product')->setFields()->registerFieldsInMetabox();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->price();

        return $this;
    }

    protected function price()
    {
        $this->setFieldInput(
            'product',
            'price',
            'Preço',
            'Preço do produto, valor mínimo: 0.01',
            array(
                'attributes' => array(
                    'type' => 'number',
                    'required' => 'required',
                    'class' => 'regular-text',
                    'min' => '0.00',
                )
            )
        );
    }
}
