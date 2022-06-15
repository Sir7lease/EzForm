<?php

    use Aham\EzForm\Form;
    use Aham\EzForm\FormBuilder;
    use Aham\EzForm\Tags\InputTag;
    use Aham\EzForm\Templates\Template;

require "vendor/autoload.php";

$form = (new Form(['class'=>'login_form ref_color', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'novalidate']))

  ->addField(['User Connection' => [
    (new InputTag('Login'))->addAttr(['name'=>'login'])->addWrap(['l'=>'span']),
    (new InputTag('Password'))->addAttr(['type'=>'password','name'=>'password'])->addWrap(['lf'=>'div,span']),
    (new InputTag())->addAttr(['type'=>'submit', 'value'=>'Login'])
  ]]);

   //(new FormBuilder(['l'=>'p']))->buildForm();

    echo "<pre>";
    print_r( $form );
    echo "</pre>";

    echo (new FormBuilder())->buildForm($form)->renderForm();

$template = new Template();

echo "<pre>";
print_r( $template->getTemplate('Login Form') );
echo "</pre>";


$template->renderTemplate('Login Form');


















    /*var_dump( $template );

    echo "<pre>";
    print_r( $template );
    echo "</pre>";*/