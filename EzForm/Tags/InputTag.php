<?php
namespace EzForm\Tags;

use EzForm\Attributes\FieldAttributes;

/**
 * This Class allows you to add input field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class InputTag extends FieldAttributes implements FieldInterface
{
    use TagsTrait;

    /**
     * @param string $id
     * @param string $labelName
     * @param string $type
     * @param string $name
     */
    public function __construct(string $labelName='', string $id='id_', string $type='text', string $name='field_')
    {
        $this->labelName = $labelName;
        $this->attributes = [
            'id'   => $id . self::$index++,
            'type' => $type,
            'name' => $name . self::$index,
        ];
    }
}