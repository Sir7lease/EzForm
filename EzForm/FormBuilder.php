<?php
namespace EzForm;

class FormBuilder
{
    public function __construct(
        private FormTag $formTag,
        private FormFields $formFields
    ){}

    public function buildForm(): string
    {
        $attributesForm='';
        $fields ='';
        foreach($this->formTag->getFormTagAttributes() as $name => $value)
            $attributesForm .= " $name='$value'";
        $openForm = "<form $attributesForm>";


        foreach ($this->formFields->getFormFields() as $fieldTagIndex => $attr) {
            $attributesField = '';
            // Getting the name class used to create the field
            $fieldTag = explode('_', $fieldTagIndex);

            // assemble all the attributes of the array into one string
            foreach ($attr->attributes as $name => $value)
                $attributesField .= " $name='$value'";

            $fields .= $this->buildTagField($fieldTag[0], $attributesField);
        }
        return $openForm . $fields . "</form>";

    }

    public function buildTagField(string $fieldTag, string $attributesField): string
    {
        if ($fieldTag==='InputTag') {
            return "<input $attributesField>";
        }
    }
}