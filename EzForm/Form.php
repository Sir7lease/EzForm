<?php
namespace EzForm;


class Form
{
    private FormBuilder $form;

    /**
     * @param FormBuilder $form
     */
    public function __construct(FormBuilder $form)
    {
        $this->form = $form;
    }

    /**
     * Display the form
     * @return string
     */
    public function showForm(): string
    {
        return $this->form->buildForm();
    }
}