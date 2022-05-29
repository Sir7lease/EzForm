<?php
namespace EzForm;

use EzForm\Tags\FormTag;
use EzForm\Tags\TagsTrait;

/**
 * This Class will build the form with the form tag and all the fields created
 * with all their attributes
 *
 * @author  Hammoumi Abdelaziz
 */
class FormBuilder
{
    use TagsTrait;

    /** @var string $labelFor will contain the value of the attributes 'for' of the label */
    private string $labelFor;

    /** @var string $attributesField will contain all the attributes concatenated into a string */
    private string $attributesField;

    /** @var string $optionsSelect  will contain all the options concatenated into a string */
    private string $optionsSelect = '';

    private string $openForm;
    private string $fields = '';


    /**
     * The actual function that goes through all the arrays and return the form built.
     * @param FormTag $formTag
     * @param FormFields $formFields
     * @return self
     */
    public function buildForm(FormTag $formTag, FormFields $formFields): self
    {
        $attributesForm='';

        // Iterate array that contains all the attributes for the tag <form> and concatenate into a string
        foreach($formTag->getFormTagAttributes() as $name => $value)
            $attributesForm .= " $name='$value'";
        $this->openForm = "<form $attributesForm>";

        // Iterate array that contain the list of fields and prepare each one to be build as a field with all the attributes, options...
        foreach ($formFields->getFormFields() as $fieldTagIndex => $attr) {
            $this->optionsSelect = '';

            if(str_contains($fieldTagIndex, 'Fieldset_')){

                $groupFields = '';
                foreach ($attr as $name => $value) {
                    $attributesField = array_map(fn($attrTag, $attrVal) => "$attrTag=$attrVal", array_keys($value->getAttributes()), array_values($value->getAttributes()));

                    $this->labelName = $value->getLabelName();
                    $this->labelFor = $value->getAttributes()['id'];
                    $this->attributesField = implode(' ', $attributesField);

                    if(str_contains($name,'SelectTag'))
                        $this->optionsSelect = implode(array_map(fn($valueOptionAttr, $textOptionHTML) => "<option value='$valueOptionAttr'>$textOptionHTML</option>", array_keys($value->selectOptions), array_values($value->selectOptions)));

                    $groupFields .= $this->buildField($this->getKeyField($name));
                }

                $this->fields .= <<<FIELDSET
                    <fieldset>
                        <legend>$fieldTagIndex</legend>
                        $groupFields
                    </fieldset>
                FIELDSET;

            } else {

                // Assemble all the attributes contained in the array into one string
                $attributesField = array_map(fn($attrName, $attrValue) => "$attrName=$attrValue", array_keys($attr->getAttributes()), array_values($attr->getAttributes()));

                $this->labelName = $attr->getLabelName();
                $this->labelFor = $attr->getAttributes()['id'];
                $this->attributesField = implode(' ', $attributesField);

                if(str_contains($this->getKeyField($fieldTagIndex),'SelectTag'))
                    $this->optionsSelect = implode(array_map(fn($valueOptionAttr, $textOptionHTML) => "<option value='$valueOptionAttr'>$textOptionHTML</option>", array_keys($attr->selectOptions), array_values($attr->selectOptions)));

                $this->fields .= $this->buildField($this->getKeyField($fieldTagIndex));
            }
        }
        return $this;
    }

    public function renderForm(): void
    {
        echo $this->openForm . $this->fields . "</form>";
    }



    /**
     * Build a field with its label when needed
     * @param string $fieldTag
     * @return string
     */
    private function buildField(string $fieldTag): string
    {

        $labelTag = "<label for='$this->labelFor'>$this->labelName</label>";
        if ($fieldTag==='InputTag')
            return $this->wrapField( (!strpos($this->attributesField, 'submit')) ? "$labelTag<input $this->attributesField>" : "<input $this->attributesField>" ) ;
        else if ($fieldTag==='TextAreaTag')
            return $this->wrapField("$labelTag<textarea $this->attributesField></textarea>");
        else if ($fieldTag==='SelectTag') {
            return $this->wrapField("$labelTag<select $this->attributesField>$this->optionsSelect</select>");
        }
        return false;
    }


    private function wrapField(string $field): string
    {
        return <<< FIELDBLOCK
            <div id="block_$this->labelFor">
                $field
            </div>
        FIELDBLOCK;
    }

    /**
     * Getting the class name used to create the field
     * @param string $fieldKey
     * @return string
     */
    private function getKeyField(string $fieldKey): string
    {
        return explode('_', $fieldKey)[0];
    }

}