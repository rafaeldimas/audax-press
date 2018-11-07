<?php

namespace Radial\Support\Domain\Metabox;

use Core\Odin\Metabox;
use Radial\Support\Domain\Traits\Fields;

/**
* Class MetaboxAbstract
*/
abstract class MetaboxAbstract
{
    use Fields;

    /**
     * @var array
     */
    protected $objects = array();

    /**
     * @return mixed
     */
    abstract public function register();

    /**
     * @return self
     */
    abstract public function setFields();

    /**
     * @param $id
     * @param $title
     * @param $postType
     * @return $this
     */
    protected function setMetabox($id, $title, $postType)
    {
        $this->objects[$id] = new Metabox($id, $title, $postType);
        return $this;
    }

    /**
     * Register fields added in metabox
     */
    protected function registerFieldsInMetabox()
    {
        foreach ($this->getFields() as $object => $field) {
            $this->objects[$object]->set_fields($field);
        }
    }
}
