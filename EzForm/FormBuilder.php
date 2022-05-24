<?php
namespace EzForm;

use EzForm\Tags\FormTag;

/**
 * This Class will build the form with the form tag and all the fields created
 * with all their attributes
 *
 * @author  Hammoumi Abdelaziz
 */
class FormBuilder
{
    /** @var string $labelName will contain the label text of the field it's attached to */
    private string $labelName;

    /** @var string $labeFor will contain the 'for' attribute to target which field it's attached to */
    private string $labeFor;

    /** @var string $attributesField will contain all the attributes concatenated into a string */
    private string $attributesField;

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

            // Assemble all the attributes contained in the array into one string
            foreach ($attr->attributes as $name => $value)
                $attributesField .= " $name='$value'";

            $this->labelName = $attr->labelName;
            $this->labeFor = $attr->attributes['id'];
            $this->attributesField = $attributesField;
            $fields .= $this->buildField($fieldTag[0]);
        }
        return $openForm . $fields . "</form>";
    }

    /**
     * Build a field with its label when needed
     * @param string $fieldTag
     * @return string
     */
    private function buildField(string $fieldTag): string
    {
        $labelTag = "<label for='$this->labeFor'>$this->labelName</label>";
        if ($fieldTag==='InputTag')
            return $this->wrapField( (!strpos($this->attributesField, 'submit')) ? "$labelTag<input $this->attributesField>" : "<input $this->attributesField>" ) ;
        else if ($fieldTag==='TextAreaTag')
            return $this->wrapField("$labelTag<textarea $this->attributesField></textarea>");
    }

    private function wrapField(string $field): string
    {
        return <<< FIELDBLOCK
            <div id="block_$this->labeFor">
                $field
            </div>
        FIELDBLOCK;
    }
}