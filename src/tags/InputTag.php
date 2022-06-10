<?php
namespace App\Tags;

use App\Attributes\FieldAttributes;

/**
 * This Class allows you to add input field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class InputTag extends FieldAttributes implements FieldInterface
{
    use TagsTrait;

    public function __construct(string $labelName='')
    {
        self::$index++;

        $this->attributes = [
          'id'   => 'id_' . self::$index,
          'type' => 'text',
          'name' => 'field_' . self::$index,
        ];

        if(!empty($labelName))
            $this->labelName = $labelName;
        else
            $this->attributes['placeholder'] = 'Type_Something_Here';
    }
}