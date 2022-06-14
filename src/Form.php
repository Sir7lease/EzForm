<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\FieldInterface;

final class Form
{
    private array $formTagAttributes = [];

    private array $fields = [];

    private static int $index = 0;

    public function __construct(array $attr=[])
    {
        if(count($attr)>0)
            $this->formTagAttributes = $attr;
        else
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