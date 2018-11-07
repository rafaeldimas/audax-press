<?php

namespace Radial\Domain\TermMeta\Entity\Product;

use Radial\Support\Domain\TermMeta\TermMetaAbstract;

/**
* ProductLine TermMeta of Product
*/
class ProductLine extends TermMetaAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setTermMeta('product_line', 'productline')->setFields()->registerFieldsInTaxonomies();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->customDescription();
        $this->images();

        return $this;
    }

    protected function customDescription()
    {
        $this->setFieldEditor('product_line', 'custom_description', 'Descrição Customizada');
    }

    protected function images()
    {
        $this->setFieldImages('product_line', 'images', 'Imagens Linha de Produto');
    }
}
