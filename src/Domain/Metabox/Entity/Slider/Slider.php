<?php

namespace Radial\Domain\Metabox\Entity\Slider;

use Radial\Support\Domain\Metabox\MetaboxAbstract;

class Slider extends MetaboxAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setMetabox('slider', 'Slider', 'slider')->setFields()->registerFieldsInMetabox();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->order();
        $this->subTitle();
        $this->buttonLabel();
        $this->buttonUrl();
        $this->image();

        return $this;
    }

    protected function order()
    {
        $this->setFieldInput(
            'slider',
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

    protected function subTitle()
    {
        $this->setFieldTextArea('slider', 'subtitle', 'Subtítulo do Slider', 'Informe o subtítulo do slider.');
    }

    protected function buttonLabel()
    {
        $this->setFieldText('slider', 'button_label', 'Texto do Botão', 'Informe o texto do botão.');
    }

    protected function buttonUrl()
    {
        $this->setFieldText('slider', 'button_url', 'Url do Botão', 'Informe a url do botão.');
    }

    protected function image()
    {
        $this->setFieldImage('slider', 'image', 'Imagem do Slider', 'Selecione a imagem do slider.');
    }
}
