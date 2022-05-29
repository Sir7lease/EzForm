<?php
namespace EzForm\Tags;

use EzForm\Attributes\FieldAttributes;

/**
 * This Class allows you to add select field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class SelectTag extends FieldAttributes implements FieldInterface
{
    use TagsTrait;

    /** @var string[] $selectOptions contains the options list for the select field */
    public array $selectOptions = [];

    public function __construct(string $labelName='', string $id='id_', string $name='field_')
    {
        $this->labelName = $labelName;
        $this->attributes = [
            'id'   => $id . self::$index++,
            'name' => $name . self::$index++,
        ];
        $this->selectOptions = [
            'noValue' => 'No Value',
        ];
    }

    public function addOptions(array $options): self
    {
        $this->selectOptions = $options;
        return $this;
    }

}