<?php
declare(strict_types=1);

namespace tags;

use Aham\EzForm\Tags\InputTag;
use Aham\EzForm\Tags\SelectTag;
use Aham\EzForm\Tags\TextAreaTag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function testGetLabelNameReturnStringForInputTag()
    {
        $input = (new InputTag('Email'));
        $this->assertIsString( $input->getLabelName() );
    }

    public function testGetLabelNameReturnStringForSelectTag()
    {
        $select = (new SelectTag('Email'));
        $this->assertIsString( $select->getLabelName() );
    }

    public function testGetLabelNameReturnStringForTextAreaTag()
    {
        $textarea = (new TextAreaTag('Email'));
        $this->assertIsString( $textarea->getLabelName() );
    }



    public function testGetAttributesReturnArrayForInputTag()
    {
        $input = (new InputTag());
        $this->assertIsArray( $input->getAttributes() );
    }

    public function testGetAttributesReturnArrayForSelectTag()
    {
        $select = (new SelectTag());
        $this->assertIsArray( $select->getAttributes() );
    }

    public function testGetAttributesReturnArrayForTextAreaTag()
    {
        $textarea = (new TextAreaTag());
        $this->assertIsArray( $textarea->getAttributes() );
    }




    public function testGetIdReturnStringForInputTag()
    {
        $input = (new InputTag());
        $this->assertIsString( $input->getId() );
    }

    public function testGetIdReturnStringForSelectTag()
    {
        $select = (new SelectTag());
        $this->assertIsString( $select->getId() );
    }

    public function testGetIdReturnStringForTextAreaTag()
    {
        $textarea = (new TextAreaTag());
        $this->assertIsString( $textarea->getId() );
    }



    public function testHasLabelNameReturnBooleanForInputTag()
    {
        $input = (new InputTag());
        $this->assertIsBool( $input->hasLabelName() );
    }

    public function testHasLabelNameReturnBooleanForSelectTag()
    {
        $select = (new SelectTag());
        $this->assertIsBool( $select->hasLabelName() );
    }

    public function testHasLabelNameReturnBooleanForTextAreaTag()
    {
        $textarea = (new TextAreaTag());
        $this->assertIsBool( $textarea->hasLabelName() );
    }

}