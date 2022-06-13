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

    public function getId(): string
    {
        return $this->getAttributes()['id'];
    }

    public function hasLabelName(): bool
    {
        return (isset($this->labelName) && !empty($this->labelName)) ? true : false;
    }

}