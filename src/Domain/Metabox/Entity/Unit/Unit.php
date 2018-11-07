<?php

namespace Radial\Domain\Metabox\Entity\Unit;

use Radial\Support\Domain\Metabox\MetaboxAbstract;

class Unit extends MetaboxAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setMetabox('unit_order', 'Ordem', 'unit')
            ->setMetabox('unit_contact', 'Contato', 'unit')
            ->setMetabox('unit_address', 'Endereço', 'unit')
            ->setFields()->registerFieldsInMetabox();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->order();

        // Contact Unit
        $this->email();
        $this->tel();
        $this->cel();

        // Address Unit
        $this->street();
        $this->number();
        $this->cep();
        $this->city();
        $this->district();
        $this->state();

        return $this;
    }

    protected function order()
    {
        $this->setFieldInput(
            'unit_order',
            'order',
            'Ordem',
            'Informe a ordem de exibição Unidade.',
            array(
                'add_column' => true,
                'attributes' => array(
                    'type' => 'number',
                    'class' => 'regular-text',
                )
            )
        );
    }

    protected function email()
    {
        $this->setFieldInput(
            'unit_contact',
            'email',
            'E-mail',
            'Informe o e-mail de contato da Unidade.',
            array(
                'attributes' => array(
                    'type' => 'email',
                    'class' => 'regular-text',
                )
            )
        );
    }

    protected function tel()
    {
        $this->setFieldInput(
            'unit_contact',
            'tel',
            'Telefone',
            'Informe o telefone de contato da Unidade.',
            array(
                'attributes' => array(
                    'type' => 'tel',
                    'class' => 'regular-text',
                )
            )
        );
    }

    protected function cel()
    {
        $this->setFieldInput(
            'unit_contact',
            'cel',
            'Celular',
            'Informe o celular de contato da Unidade.',
            array(
                'attributes' => array(
                    'type' => 'tel',
                    'class' => 'regular-text',
                )
            )
        );
    }

    protected function street()
    {
        $this->setFieldText('unit_address', 'street', 'Rua', 'Informe a rua da Unidade.');
    }

    protected function number()
    {
        $this->setFieldText('unit_address', 'number', 'Numero', 'Informe o numero da Unidade.');
    }

    protected function cep()
    {
        $this->setFieldText('unit_address', 'cep', 'Cep', 'Informe o cep da Unidade.');
    }

    protected function city()
    {
        $this->setFieldText('unit_address', 'city', 'Cidade', 'Informe o cidade da Unidade.');
    }

    protected function district()
    {
        $this->setFieldText('unit_address', 'district', 'Bairro', 'Informe o bairro da Unidade.');
    }

    protected function state()
    {
        $this->setFieldText('unit_address', 'state', 'Estado', 'Informe o estado da Unidade.');
    }
}
