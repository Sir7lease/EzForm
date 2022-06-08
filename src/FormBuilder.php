<?php
namespace src;

use src\Tags\FormTag;
use src\Tags\TagsTrait;

/**
 * This Class will build the form with the form tag and all the fields created
 * with all their attributes
 *
 * @author  Hammoumi Abdelaziz
 */
class FormBuilder extends TagBuilder
{
    use TagsTrait;

    /** @var string $openForm will contain the <form> tag with its attributes */
    private string $openForm;

    /** @var string $labelFor will contain the value of the attributes 'for' of the label */
    private string $labelFor;

    /** @var string $fields will contain all the fields of the form */
    private string $fields = '';

    /** @var string $attributesField will contain all the attributes concatenated of a field */
    private string $attributesField;

    /** @var string $optionsSelect  will contain all the options concatenated for the <select> */
    private string $optionsSelect = '';

    public function __construct(array $wrap)
    {
        parent::__construct($wrap);
    }

    public function buildForm(Form $form): self
    {
        // Build <form...> tag
        $this->openForm = $this->buildFormTag($form->getFormTagAttributes());

        // Build field
        foreach ($form->getFormFields() as $fieldTagIndex => $fieldObject) {
            $this->fields .= (str_contains($fieldTagIndex, 'Fieldset')) ?
                $this->buildFieldsetTag($fieldTagIndex, $fieldObject/*, $this->wrapper*/) :
                $this->buildFieldTag($fieldTagIndex, $fieldObject/*, $this->wrapper*/);
        }

        return $this;
    }

    public function renderForm(): void
    {
        echo $this->openForm . $this->fields . "</form>";
    }

}