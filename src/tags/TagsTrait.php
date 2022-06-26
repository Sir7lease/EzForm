<?php
declare(strict_types=1);

namespace Aham\EzForm\Tags;

/**
 * This Trait is shared by all the Tags Fields and FieldAttributes abstract class.
 * It'll allow you to overwrite the values (if needed) of the $attributes array that is set in the constructor
 * of each <Field Tag> class.
 *
 * @author  Hammoumi Abdelaziz
 */
trait TagsTrait
{
    private string $fieldType;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
    protected array $attributes;

    /** @var string[] $wraps contains all the tags to wrap with (label, field and/or both) */
    protected array $wraps;

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getWrap()
    {
        return $this->wraps;
    }

    public function getId(): string
    {
        return $this->getAttributes()['id'];
    }

    public function setId(string $id)
    {
        $this->attributes['id'] = $id;
    }

    public function getFieldType()
    {
        return $this->fieldType;
    }

    public function setFieldType()
    {
        $pathCurrentClassArr = explode('\\',get_class($this));
        $this->fieldType = substr(array_pop($pathCurrentClassArr), 0, -3);
    }

    public function hasLabelName(): bool
    {
        return (isset($this->labelName) && !empty($this->labelName))?? false;
    }

    public function setName(string $name)
    {
        $this->attributes['name'] = $name;
    }

}