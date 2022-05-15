<?php
namespace EzForm;

abstract class FieldAttributes
{
    /** @var string|null $attrId attribute id */
    private ?string $attrId;

    /** @var array|string|null $attrClass attribute class */
    private array|string|null $attrClass;

    /** @var string|null $name attribute that specifies the name of a form */
    private ?string $attrName;


    public function addAttrId(string $attrId): self
    {
        $this->attributes['id'] = str_replace(' ', '_', $attrId);
        return $this;
    }

    public function addAttrClass(string|array $attrClass): self
    {
        $this->attributes['class'] = (is_array($attrClass)) ? implode(' ', $attrClass) : $attrClass;
        return $this;
    }

    public function addAttrName(string $name): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }

}