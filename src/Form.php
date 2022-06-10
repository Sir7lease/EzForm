<?php

namespace App;

use App\Attributes\FieldAttributes;
use App\Tags\FieldInterface;
use App\Tags\TagsTrait;

final class Form
{
    private array $formTagAttributes = [];

    private array $fields = [];

    private static int $index = 0;

    public function __construct()
    {
        $this->formTagAttributes = [
          'action' => '',
          'method' => 'GET',
        ];
    }

    /**
     * Add a new field that will be added into the form by the FormBuilder Class
     * @param FieldInterface[]|array $field
     */
    public function addField(FieldInterface|array $field, string $fieldsetTarget=''): self
    {
        if(is_array($field)){
            foreach ($field as $fieldsetName => $fields) {
                foreach ($fields as $key => $objectField) {
                    self::$index++;
                    $fieldName = explode('\\', $objectField::class);
                    $this->fields["Fieldset_$fieldsetName"][array_pop($fieldName) . '_' . self::$index] = $objectField;
                }
            }
        } else {
            self::$index++;
            $fieldName = explode('\\',$field::class);
            $this->fields[array_pop($fieldName) .'_'. self::$index] = $field;
        }

        return $this;
    }

    public function getFormTagAttributes(): array
    {
        return $this->formTagAttributes;
    }

    public function getFormFields(): array
    {
        return $this->fields;
    }

}