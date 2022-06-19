<?php

use Aham\EzForm\Form;
use Aham\EzForm\FormBuilder;
use Aham\EzForm\Tags\InputTag;
use Aham\EzForm\Tags\SelectTag;
use Aham\EzForm\Tags\TextAreaTag;
use Aham\EzForm\Templates\Template;

require "vendor/autoload.php";
function pretty($obj){
    echo "<pre>";
    print_r( $obj );
    echo "</pre>";
}

$form = new Form(['method'=>'POST']);

$form->addFieldset('User Connection', [
        (new InputTag('Login', attributes: ['name'=>'login', 'class'=>'main block_login color_blue'], wraps:['f'=>'span'])),
        (new InputTag('Password', ['type'=>'password', 'name'=>'password'], ['l'=>'div','lf'=>'div']))
        ])
    ->addField((new TextAreaTag(attributes: ['name'=>'description'])))
    ->addField(new SelectTag('Job', options: [1=>'dev', 2=>'tech']));









pretty($form);
(new FormBuilder(['l'=>'div']))->buildForm($form)->renderForm();



