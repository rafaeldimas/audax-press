<?php

namespace Radial\Support\Domain\Traits;

/**
 * Trait Fields
 * @package Radial\Support\Domain\Traits
 */
trait Fields
{
    /**
     * @var array
     */
    protected $fields = array();

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param string $type
     * @param array $args
     * @return $this
     */
    protected function setField($object, $id, $label, $description = '', $type = 'text', array $args = array())
    {
        $defaults = array(
            'id' => $this->objects[$object]->id . '_' . $id,
            'label' => $label,
            'type' => $type,
            'description' => $description,
        );

        $field = array_merge_recursive($defaults, $args);

        $this->fields[$object][] = $field;

        return $this;
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param array $options
     * @param $type
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldWithOptions($object, $id, $label, array $options, $type, $description = '', array $args = array())
    {
        $options = array('options' => $options);
        $args = array_merge_recursive($options, $args);
        return $this->setField($object, $id, $label, $description, $type, $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldText($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'text', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldTextArea($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'textarea', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldInput($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'input', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldCheckbox($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'checkbox', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldEditor($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'editor', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldImage($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'image', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldImages($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'image_plupload', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldUpload($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'upload', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldColor($object, $id, $label, $description = '', array $args = array())
    {
        return $this->setField($object, $id, $label, $description, 'color', $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @return Fields
     */
    protected function setFieldTitle($object, $id, $label)
    {
        return $this->setField($object, $id, $label, '', 'title');
    }

    /**
     * @param $object
     * @param $id
     * @return Fields
     */
    protected function setFieldSeparator($object, $id)
    {
        return $this->setField($object, $id, '', '', 'separator');
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param array $options
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldSelect($object, $id, $label, array $options, $description = '', array $args = array())
    {
        return $this->setFieldWithOptions($object, $id, $label, $options, 'select', $description, $args);
    }

    /**
     * @param $object
     * @param $id
     * @param $label
     * @param array $options
     * @param string $description
     * @param array $args
     * @return Fields
     */
    protected function setFieldRadio($object, $id, $label, array $options, $description = '', array $args = array())
    {
        return $this->setFieldWithOptions($object, $id, $label, $options, 'radio', $description, $args);
    }
}
