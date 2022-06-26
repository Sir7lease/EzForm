<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * TODO:    Need to add the posibility to order the fields like so:
 *              - sortFields() will sort the fields and fieldsets
 *              - sortFieldsetFields($namefieldset) will sort the fields only inside a fieldset
 *          Need to add the feature that'll allow to save form input if a page is left like so:
 *              - Generate first an id in the <form data-id='the_id_generated'> tag so we do
 *                know on which form each inputs belong to.
 *              - Either event on each keydown or lost focus of a field save the form inputs
 *                on a json file (probably in Javascript/Jquery)
 */

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

// Form build from class
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
pretty($form);
(new FormBuilder(['l'=>'div']))->buildForm($form)->renderForm();

$form->sortFields($form, );


//// Form build from saved template
/*$templateForm = (new Template())->getTemplate('Login Form');
$templateForm
    ->removeFieldset('Fieldset_1', false)
    ->addField(
        (new InputTag('Address', attributes: ['name'=>'address', 'class'=>'color_purple'], wraps:['l'=>'div','f'=>'div']))
    );*/





