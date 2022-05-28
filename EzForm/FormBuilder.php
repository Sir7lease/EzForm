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
        echo "<pre>";
        print_r ( $this->formFields->getFormFields() );
        echo "</pre>";

        $attributesForm='';
        $fields ='';

        // Iterate array that contains all the attributes for the tag <form> and concatenate into a string
        foreach($this->formTag->getFormTagAttributes() as $name => $value)
            $attributesForm .= " $name='$value'";
        $openForm = "<form $attributesForm>";

        // Iterate array that contain the list of fields and prepare each one to be build as a field with all the attributes, options...
        foreach ($this->formFields->getFormFields() as $fieldTagIndex => $attr) {
            $attributesField = '';

            // Assemble all the attributes contained in the array into one string
            foreach ($attr->getAttributes() as $name => $value)
                $attributesField .= " $name='$value'";

            $this->labelName = $attr->getLabelName();
            $this->labelFor = $attr->getAttributes()['id'];
            $this->attributesField = $attributesField;

            if($this->getKeyField($fieldTagIndex)==='SelectTag')
                foreach($this->formFields->getSelectOptions($fieldTagIndex) as $valueOptionAttr => $textOptionHTML)
                    $this->optionsSelect .= "<option value='$valueOptionAttr'>$textOptionHTML</option>";

            $fields .= $this->buildField($this->getKeyField($fieldTagIndex));
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