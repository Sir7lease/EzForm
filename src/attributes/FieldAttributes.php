<?php
namespace src\Attributes;

use src\Tags\FieldInterface;
use src\Tags\TagsTrait;

/**
 * Abstract class that share the function addAttr with all the class tag
 *
 * @author  Hammoumi Abdelaziz
 */
abstract class FieldAttributes implements FieldInterface
{
    use TagsTrait;

    /** @var int $index incremented each time that the function addField() is called */
    public static int $index = 0;

    public function addAttr(array $attributes=[]): self
    {
        foreach($attributes as $key => $value)
            $this->attributes[$key] = $value;

        return $this;
    }
}