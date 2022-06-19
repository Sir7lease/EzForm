<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\FieldInterface;
use Aham\EzForm\Tags\FieldsetTag;

final class Form
{
    private array $formTagAttributes = [];

    private array $fields = [];

    private static int $iField = 0;
    private static int $iFieldset = 0;

    public function __construct(array $formTagAttributes=[])
    {
        $this->formTagAttributes = [
          'action' => '',
          'method' => 'GET',
        ];
        if(count($formTagAttributes) > 0)
            foreach($formTagAttributes as $key => $value)
                $this->formTagAttributes[$key] = $value;
    }

    public function addField(FieldInterface $field, string $fieldsetTarget=''): self
    {
        self::$iField++;
        $fieldName = explode('\\',$field::class);
        $this->fields[array_pop($fieldName) .'_'. self::$iField] = $field;

        return $this;
    }

    /**
     * @param string $legend
     * @param FieldInterface[] $fields
     * @return $this
     */
    public function addFieldset(string $legend, array $fields): self
    {
        foreach ($fields as $objectField) {
            self::$iField++;
            $fieldName = explode('\\', $objectField::class);
            $fieldsetField[array_pop($fieldName) . '_' . self::$iField] = $objectField;
        }
        $keyFieldset = 'Fieldset_' . ++self::$iFieldset;
        $this->fields[$keyFieldset] = new FieldsetTag($legend, $fieldsetField);
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