<?php
namespace EzForm;

/**
 * This Class allows you to add fields (input, select...) in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class FormFields
{
    private static int $i = 0;
    private array $fields = [];

    public function addField(FieldInterface $field): self
    {
        $fieldName = explode('\\',$field::class);
        $this->fields[array_pop($fieldName) .'_'. self::$i++] = $field;
        return $this;
    }

    public function getFormFields(): array
    {
        return $this->fields;
    }
}