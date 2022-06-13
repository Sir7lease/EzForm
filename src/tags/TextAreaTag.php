<?php
namespace Aham\EzForm\Tags;

use Aham\EzForm\Attributes\FieldAttributes;

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
        self::$index++;

        $this->attributes = [
            'id'   => $id . self::$index,
            'name' => $name . self::$index,
        ];

        if(!empty($labelName))
            $this->labelName = $labelName;
        else
            $this->attributes['placeholder'] = 'Type_Something_Here';
    }
}