<?php
declare(strict_types=1);

namespace Aham\EzForm\Tests;

use Aham\EzForm\Form;
use Aham\EzForm\FormBuilder;
use Aham\EzForm\Tags\InputTag;
use PHPUnit\Framework\TestCase;

class FormBuilderTest extends TestCase
{
    public function testBuildFormReturnInstanceOfFormBuilder()
    {
        $form = (new Form())->addField( new InputTag('login') );

        $this->assertInstanceOf(
          FormBuilder::class,
          (new FormBuilder([]))->buildForm($form)
        );
    }

    public function testRenderFormOutput()
    {
        $this->expectOutputString((new FormBuilder([]))->buildForm($form)->renderForm());
    }
}