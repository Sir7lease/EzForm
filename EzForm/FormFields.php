<?php
namespace EzForm;

use EzForm\Tags\FieldInterface;

/**
 * This Class allows you to add fields (input, select...) in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class FormFields
{
    private static int $i = 0;
    private array $fields = [];

    /**
     * Add a new field that will be added into the form by the FormBuilder Class
     * @param FieldInterface $field
     * @return $this
     */
    public function addField(FieldInterface $field): self
    {
        $fieldName = explode('\\',$field::class);
        $this->fields[array_pop($fieldName) .'_'. self::$i++] = $field;
        return $this;
    }

    /**
     * @return array
     */
    public function getFormFields(): array
    {
        return $this->fields;
    }
}