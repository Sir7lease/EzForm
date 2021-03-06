<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\TagsTrait;

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

    /** @var string $fields will contain all the fields of the form */
    private string $fields = '';

    public function __construct(array $wrap=[])
    {
        parent::__construct($wrap);
    }

    public function buildForm(Form $form): self
    {
        // Build <form...> tag
        $this->openForm = $this->buildFormTag($form->getFormTagAttributes());

        // Build field
        foreach ($form->getFields() as $fieldTagIndex => $fieldObject)
            $this->fields .= ($fieldObject->getFieldType()==='Fieldset') ?
              $this->buildFieldsetTag($fieldObject) : $this->buildFieldTag($fieldObject);

        return $this;
    }

    public function renderForm(): void
    {
        echo $this->openForm . $this->fields . "</form>";
    }

}