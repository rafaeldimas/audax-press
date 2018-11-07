<?php

namespace Radial\Support\Domain\TermMeta;

use Core\Odin\TermMeta;
use Radial\Support\Domain\Traits\Fields;

/**
* Class TermMetaAbstract
*/
abstract class TermMetaAbstract
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
     * @param $taxonamy
     * @return $this
     */
    protected function setTermMeta($id, $taxonamy)
    {
        $this->objects[$id] = new TermMeta($id, $taxonamy);
        return $this;
    }

    /**
     * Register fields added in taxonomies
     */
    protected function registerFieldsInTaxonomies()
    {
        foreach ($this->getFields() as $object => $field) {
            $this->objects[$object]->set_fields($field);
        }
    }
}
