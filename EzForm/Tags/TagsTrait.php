<?php
namespace EzForm\Tags;

/**
 * This Trait is shared by all the Tags Fields and FieldAttributes abstract class.
 * It'll overwrite the values (if needed) of the $attributes array that is set in the constructor
 * of each <Field Tag> class.
 *
 * @author  Hammoumi Abdelaziz
 */
trait TagsTrait
{
    /** @var string $labelName will contain the label name for each field added through each new instance of this class */
    private string $labelName;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
    protected array $attributes = [];

    public function getLabelName(): string
    {
        return $this->labelName;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

}