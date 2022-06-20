<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    ->addField(new SelectTag('Job', options: [1=>'dev', 2=>'tech']))
    ->addFieldset('User Disconnection', [
        (new InputTag('Disconnect', attributes: ['name'=>'disconnect', 'class'=>'main block_disconnect color_red'], wraps:['f'=>'span']))
    ]);



//pretty($form);
$templateForm = (new Template())->getTemplate('Login Form');

$templateForm
    ->removeFieldset('Fieldset_1', false)
    ->addField(
        (new InputTag('Address', attributes: ['name'=>'address', 'class'=>'color_purple'], wraps:['l'=>'div','f'=>'div']))
    );

(new FormBuilder(['l'=>'div']))->buildForm($templateForm)->renderForm();




