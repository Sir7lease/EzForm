<?php
namespace EzForm\Tags;

use EzForm\Attributes\FieldAttributes;

/**
 * This Class allows you to add textarea field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class TextAreaTag extends FieldAttributes implements FieldInterface
{
    use TagsTrait;

    public function __construct(string $labelName='', string $id='id_', string $name='field_')
    {
        $this->labelName = $labelName;
        $this->attributes = [
            'id'   => $id . self::$index++,
            'name' => $name . self::$index++,
        ];
    }
}