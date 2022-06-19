<?php
declare(strict_types=1);

    use Aham\EzForm\Form;
    use Aham\EzForm\FormBuilder;
    use Aham\EzForm\Tags\InputTag;
    use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    public function testAddFieldReturnInstanceOfForm()
    {
        $this->assertInstanceOf(
          Form::class,
          (new Form())->addField( new InputTag() ));
    }

    public function testGetFormTagAttributesReturnArray()
    {
        $this->assertIsArray(
          (new Form())->getFormTagAttributes()
        );
    }

    public function testGetFieldsReturnArray()
    {
        $this->assertIsArray(
          (new Form())->getFields()
        );
    }
}