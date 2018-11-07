<?php

namespace Radial\Domain\Metabox\Entity\Event;

use Radial\Support\Domain\Metabox\MetaboxAbstract;

class Event extends MetaboxAbstract
{
    /**
     * @return mixed
     */
    public function register()
    {
        $this->setMetabox('event', 'Evento', 'event')->setFields()->registerFieldsInMetabox();
    }

    /**
     * @return self
     */
    public function setFields()
    {
        $this->date();

        return $this;
    }

    protected function date()
    {
        $this->setFieldInput(
            'event',
            'date',
            'Data do Evento',
            'Informe a data do Evento no seguinte formato: ' . date('d/m/Y'),
            array(
                'attributes' => array(
                    'type' => 'date',
                    'required' => 'required',
                    'class' => 'regular-text',
                )
            )
        );
    }
}
