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
    private array $fields = [];
    private static int $i = 0;

    /**
     * Add a new field that will be added into the form by the FormBuilder Class
     * @param FieldInterface $field
     * @param string $fieldsetTarget default empty string
     * @return $this
     */
    public function addField(FieldInterface $field, string $fieldsetTarget=''): self
    {
        $fieldName = explode('\\',$field::class);
        if(!empty($fieldsetTarget))
            $this->fields["Fieldset_$fieldsetTarget"][array_pop($fieldName) .'_'. self::$i++] = $field;
        else
            $this->fields[array_pop($fieldName) .'_'. self::$i++] = $field;

        return $this;
    }

    public function addFieldset(string $legend): self
    {
        $this->fields["Fieldset_$legend"] = [];
        return $this;
    }

    /**
     * @return array
     */
    public function getFormFields(): array
    {
        return $this->fields;
    }

    /**
     * Return the options for the select field
     * @return string[]
     */
    public function getSelectOptions(string $key): array
    {
        return $this->fields[$key]->selectOptions;
    }
}