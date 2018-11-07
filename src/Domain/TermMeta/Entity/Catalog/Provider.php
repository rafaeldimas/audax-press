<?php

namespace Radial\Domain\TermMeta\Entity\Catalog;

use Radial\Support\Domain\TermMeta\TermMetaAbstract;

/**
* Provider TermMeta of Product
*/
class Provider extends TermMetaAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setTermMeta('provider', 'catalog_provider')->setFields()->registerFieldsInTaxonomies();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->order();
        $this->receiveCatalogByEmail();
        $this->viewOnCatalogPage();
        $this->isGold();
        $this->url();
        $this->logo();

        return $this;
    }

    private function order()
    {
        $this->setFieldInput(
            'provider',
            'order',
            'Ordem',
            'Informe a ordem de exibição dos Fornecedores.',
            array(
                'add_column' => true,
                'attributes' => array(
                    'type' => 'number',
                    'class' => 'regular-text',
                )
            )
        );
    }

    private function logo()
    {
        $this->setFieldImage('provider', 'logo', 'Logo');
    }

    private function url()
    {
        $this->setFieldText('provider', 'url', 'Url');
    }

    private function isGold()
    {
        $this->setFieldSelect(
            'provider',
            'is_gold',
            'Fornecedor gold?',
            array(
                'yes' => 'Sim',
                'no' => 'Não',
            ),
            '',
            array(
                'default' => 'no',
            )
        );
    }

    private function receiveCatalogByEmail()
    {
        $this->setFieldSelect(
            'provider',
            'receive_catalog_by_email',
            'Receber catalogo por e-mail?',
            array(
                'yes' => 'Sim',
                'no' => 'Não',
            ),
            '',
            array(
                'default' => 'no',
            )
        );
    }

    private function viewOnCatalogPage()
    {
        $this->setFieldSelect(
            'provider',
            'view_on_catalog_page',
            'Exibir na página de Catálogo?',
            array(
                'yes' => 'Sim',
                'no' => 'Não',
            ),
            '',
            array(
                'default' => 'yes',
            )
        );
    }
}
