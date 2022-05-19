<?php
namespace EzForm;

/**
 * Abstract class that share the function addAttr with all the class tag
 *
 * @author  Hammoumi Abdelaziz
 */
abstract class FieldAttributes
{
    /**
     * @param array $attributes
     * @return self $this
     */
    public function addAttr(array $attributes): self
    {
        foreach($attributes as $key => $value)
            $this->attributes[$key] = $value;

        return $this;
    }
}