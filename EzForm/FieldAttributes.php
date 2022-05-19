<?php
namespace EzForm;

abstract class FieldAttributes
{
    public function addAttr(array $attributes): self
    {
        foreach($attributes as $key => $value)
            $this->attributes[$key] = $value;

        return $this;
    }
}