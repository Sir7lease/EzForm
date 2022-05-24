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
    /** @var string $labelName will contain the label name for each field added through each new instance of this class */
    public string $labelName;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
    public array $attributes = [];

    /**
     * @param string $labelName
     * @param string $id
     * @param string $name
     */
    public function __construct(string $labelName='', string $id='id_', string $name='field_')
    {
        $this->labelName = $labelName;
        $this->attributes = [
            'id'   => $id . self::$index++,
            'name' => $name . self::$index++,
        ];
    }
}