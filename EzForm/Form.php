<?php
namespace EzForm;

/**
 * Final class that display the form on the page
 * showForm() to display it
 *
 * @author  Hammoumi Abdelaziz
 */
final class Form
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
     * Display the form on the page
     */
    public function showForm(): void
    {
        echo  $this->form->buildForm();
    }
}