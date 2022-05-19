<?php
namespace EzForm;

/**
 * This Class will build the form with the form tag and all the fields created
 * with all their attributes
 *
 * @author  Hammoumi Abdelaziz
 */
class FormBuilder
{
    /**
     * @param FormTag $formTag
     * @param FormFields $formFields
     */
    public function __construct(
        private FormTag $formTag,
        private FormFields $formFields
    ){}

    /**
     * The actual function that goes through all the arrays and return the form built.
     * @return string
     */
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

            $fields .= $this->buildTagField($fieldTag[0], $attributesField, $attr->labelName);
        }
        return $openForm . $fields . "</form>";

    }

    /**
     * Build a field with its label when needed
     * @param string $fieldTag
     * @param string $attributesField
     * @param string $labelName
     * @return string
     */
    public function buildTagField(string $fieldTag, string $attributesField, string $labelName): string
    {
        if ($fieldTag==='InputTag' && !strpos($attributesField, 'submit')) {
            return "<label>$labelName<input $attributesField></label>";
        }else{
            return "<input $attributesField>";
        }
    }
}