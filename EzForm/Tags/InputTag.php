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
    /** @var string $labelName will contain the label name for each field added through each new instance of this class */
    public string $labelName;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
    public array $attributes = [];

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