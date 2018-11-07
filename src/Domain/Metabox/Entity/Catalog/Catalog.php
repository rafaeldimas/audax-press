<?php

namespace Radial\Domain\Metabox\Entity\Catalog;

use Radial\Support\Domain\Metabox\MetaboxAbstract;

class Catalog extends MetaboxAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setMetabox('catalog', 'Catálogo', 'catalog')->setFields()->registerFieldsInMetabox();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->pdf();

        return $this;
    }

    protected function pdf()
    {
        $this->setFieldUpload('catalog', 'pdf', 'PDF Catálogo', 'Selecione o PDF referente ao Catálogo');
    }
}
