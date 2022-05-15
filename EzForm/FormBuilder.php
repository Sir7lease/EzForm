<?php
namespace EzForm;

use EzForm\FormFields;
use EzForm\FormTag;

class FormBuilder
{
    public function __construct(
        private FormTag $formTag,
        private FormFields $formFields
    ){}

    public function buildForm(): string
    {
        // TODO : here the logic to build the form
        $attributes="";
        foreach($this->formTag->getFormTagAttributes() as $attr => $val)
            $attributes .= " $attr='$val'";

        return "<form $attributes>";

    }
}