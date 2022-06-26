<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\FieldInterface;
use Aham\EzForm\Tags\FieldsetTag;
use Aham\EzForm\Templates\Template;

final class Form extends Template
{
    private static int $iField = 0;

    private array $formTagAttributes = [];

    protected array $fields = [];

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

    /**
     * @param string $legend
     * @param FieldInterface[] $fields
     * @return $this
     */
    public function addFieldset(string $legend, array $fields): self
    {
        $iFieldset = 1;
        foreach ($fields as $objectField) {
            $uniqIdField = uniqid();
            $objectField->setId("id_$uniqIdField");
            $objectField->setName("name_$uniqIdField");
            $objectField->setFieldType();
            $fieldName = explode('\\', $objectField::class);
            $fieldsetField[$iFieldset++] = $objectField;
        }
        $this->fields[++self::$iField] = new FieldsetTag($legend, $fieldsetField);

        return $this;
    }

    public function addField(FieldInterface $field, string $fieldsetTarget=''): self
    {
        $uniqIdField = uniqid();
        $field->setId("id_$uniqIdField");
        $field->setName("name_$uniqIdField");
        $field->setFieldType();
        $fieldName = explode('\\', $field::class);
        $this->fields[++self::$iField] = $field;

        return $this;
    }

    public function removeFieldset(string $nameFieldset, bool $deleteFieldsInside=true): self
    {
        if($deleteFieldsInside) {
            unset($this->fields[$nameFieldset]);
        } else {
            $fieldSaved = $this->fields[$nameFieldset]->getFieldset();
            unset($this->fields[$nameFieldset]);
            $this->fields = array_merge($fieldSaved, $this->fields);
        }
        return $this;
    }

    public function removeField(string $nameField): self
    {
        foreach($this->fields as $kf => $vf){
            if(!str_contains($kf, 'Fieldset_')) {
                foreach ($vf->getFieldset() as $kff => $vff) {
                    if ($kff === $nameField)
                        $vf->removeField($nameField);
                }
            } elseif($kf===$nameField) {
                unset($this->fields[$kf]);
            }
        }
        return $this;
    }

    public function getFormTagAttributes(): array
    {
        return $this->formTagAttributes;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

}