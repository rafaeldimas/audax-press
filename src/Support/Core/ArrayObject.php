<?php

namespace GrupoAudax\AudaxPress\Support\Core;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

/**
* ArrayObject
*/
class ArrayObject implements ArrayAccess, IteratorAggregate
{
    protected $data = array();

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function get($key = false, $default = false)
    {
        if (!$key) {
            return $this->data;
        }

        if ($this->has($key)) {
            return $this->data[$key];
        }

        return $default;
    }

    public function set($key = false, $value)
    {
        if (is_array($key)) {
            $this->data = $key;
        }

        if ($key === false) {
            $this->data[] = $value;
            return $this;
        }

        $this->data[$key] = $value;
        return $this;
    }

    public function uns($key)
    {
        if ($this->has($key)) {
            unset($this->data[$key]);
        }

        return $this;
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
        return $this;
    }

    public function offsetUnset($offset)
    {
        $this->uns($offset);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}
