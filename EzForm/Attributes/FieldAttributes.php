<?php
namespace EzForm\Attributes;

/**
 * Abstract class that share the function addAttr with all the class tag
 *
 * @author  Hammoumi Abdelaziz
 */
abstract class FieldAttributes
{
    /** @var int $index incremented each time that the function addField() is called */
    public static int $index = 0;

    /**
     * @param array $attributes
     * @return self $this
     */
    public function addAttr(array $attributes=[]): self
    {
        foreach($attributes as $key => $value)
            $this->attributes[$key] = $value;

        return $this;
    }
}