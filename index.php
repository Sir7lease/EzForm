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


echo "<pre>";
print_r( $form );
echo "</pre>";

(new FormBuilder(['f'=>'p']))->buildForm($form)->renderForm();

$template = new Template();

echo "<pre>";
print_r( $template->getTemplate('Login Form') );
echo "</pre>";


$template->renderTemplate('Login Form');

