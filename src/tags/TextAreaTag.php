<?php
declare(strict_types=1);

namespace Aham\EzForm\Tags;

/**
 * This Class allows you to add textarea field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class TextAreaTag extends LabelTag implements FieldInterface
{
    use TagsTrait;

    public function __construct(string $labelName='', array $attributes=[], array $wraps=[])
    {
        self::$index++;

        if(!empty($labelName))
            $this->labelName = $labelName;

        $this->attributes = match((bool)$attributes) {
            true    => array_merge(['id'   => 'id_' . self::$index, 'name' => 'field_' . self::$index], $attributes),
            default => ['id'   => 'id_' . self::$index, 'name' => 'field_' . self::$index]
        };

        $this->wraps = $wraps;
    }
}