<?php
namespace EzForm;

/**
 * This Class allows you to add fields (input, select...) in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class InputTag extends FieldAttributes implements FieldInterface
{
    /** @var int $index incremented each time that the function addField() is called */
    private static int $index = 0;

    /** @var string $labelName will contain the label name for each field added through each new instance of this class */
    public string $labelName;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
    public array $attributes = [];

    /**
     * @param string $labelName
     * @param string $type
     * @param string $name
     */
    public function __construct(string $labelName='', string $type='text', string $name='field_')
    {
        $this->labelName = $labelName;
        $this->attributes = [
            'type' => $type,
            'name' => $name . self::$index++,
        ];
    }
}