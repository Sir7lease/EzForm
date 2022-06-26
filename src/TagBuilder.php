<?php
/**
 * TODO: In the setWrap() method we it is repeating the same logic 3 times we can simply this part.
 */

declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\FieldInterface;
use Aham\EzForm\Tags\FieldsetTag;

/**
 * This Class Build a Field with all the attributes
 *
 * @author  Hammoumi Abdelaziz
 */
abstract class TagBuilder implements FieldInterface
{
    protected array|string $wrapTags;

    private string $labelTag;
    private string $fieldTag;

    private array|string $singleFieldWrap;
    private array|string $globalFieldWrap;


    public function __construct(array $wrapTags=[])
    {
        $this->globalFieldWrap = $wrapTags;
    }

    protected function buildFormTag(array $attr): string
    {
        return "<form {$this->concatAttributesField($attr)}>";
    }

    /**
     * Build a field with a label (if requested) and wrap label, field and/or label+field with tags (div, span, p...)
     * @param FieldInterface $objectField
     * @return string field ready to be added to the <form>
     */
    protected function buildFieldTag(FieldInterface $objectField): string
    {
        $this->singleFieldWrap = $objectField->getWrap();

        $this->labelTag = $this->getLabel($objectField);

        if ($objectField->getFieldType() === 'Input')
            $this->fieldTag = "<input {$this->concatAttributesField($objectField->getAttributes())} />";
        elseif ($objectField->getFieldType() === 'TextArea')
            $this->fieldTag = "<textarea {$this->concatAttributesField($objectField->getAttributes())} ></textarea>";
        elseif ($objectField->getFieldType() === 'Select')
            $this->fieldTag = "<select {$this->concatAttributesField($objectField->getAttributes())} > {$this->buildOptionsSelect($objectField->getOptions())} </select>";

        return $this->setWrap();
    }


    protected function buildFieldsetTag(FieldsetTag $fieldset): string
    {
        $fieldsetFields = '';
        foreach ($fieldset->getFieldset() as $objectField)
            $fieldsetFields .= $this->buildFieldTag($objectField);
        return <<<FIELDSET
           <fieldset>
              <legend>{$fieldset->getLegend()}</legend>
              $fieldsetFields
           </fieldset>
        FIELDSET;
    }

    private function concatAttributesField(array $attr): string
    {
        return implode(' ', array_map(fn($attrKey, $attrVal) => (is_numeric($attrKey)) ? $attrVal : "$attrKey='$attrVal'", array_keys($attr), array_values($attr)));
    }

    private function buildOptionsSelect(array $options): string
    {
        $optionsSelect='';
        foreach($options as $optKey => $optVal) {
            if (is_array($optVal)) {
                $optionElements = implode(array_map(fn($valueOptionAttr, $textOptionHTML) => "<option value='$valueOptionAttr'>$textOptionHTML</option>", array_keys($optVal), array_values($optVal)));
                $optionsSelect .= "<optgroup label='$optKey'>$optionElements</optgroup>";
            } else {
                $optionsSelect .= "<option value='$optKey'>$optVal</option>";
            }
        }
        return $optionsSelect;
    }

    private function getLabel(FieldInterface $objectField): bool|string
    {
        if($objectField->hasLabelName()){
            return "<label for='{$objectField->getId()}'>{$objectField->getLabelName()}</label>";
        }
        return '';
    }

    private function setWrap(): string
    {
        // We can do simplier by
        $wrapLabelTag = array_merge(
            (array_key_exists('l', $this->singleFieldWrap)) ? array_reverse(explode(',', str_replace(' ', '', $this->singleFieldWrap['l']))) : [],
            (array_key_exists('l', $this->globalFieldWrap)) ? array_reverse(explode(',', str_replace(' ', '', $this->globalFieldWrap['l']))) : []
        );
        $this->labelTag = $this->applyWrap($this->labelTag, $wrapLabelTag);

        $wrapFieldTag = array_merge(
            (array_key_exists('f', $this->singleFieldWrap)) ? array_reverse(explode(',', str_replace(' ', '', $this->singleFieldWrap['f']))) : [],
            (array_key_exists('f', $this->globalFieldWrap)) ? array_reverse(explode(',', str_replace(' ', '', $this->globalFieldWrap['f']))) : []
        );
        $this->fieldTag = $this->applyWrap($this->fieldTag, $wrapFieldTag);

        $wrapLabelFieldTag = array_merge(
            (array_key_exists('lf', $this->singleFieldWrap)) ? array_reverse(explode(',', str_replace(' ', '', $this->singleFieldWrap['lf']))) : [],
            (array_key_exists('lf', $this->globalFieldWrap)) ? array_reverse(explode(',', str_replace(' ', '', $this->globalFieldWrap['lf']))) : []
        );
        return $this->applyWrap($this->labelTag . $this->fieldTag, $wrapLabelFieldTag);
    }


    private function applyWrap(string $tagToWrap, array $wraps)
    {
        foreach ($wraps as $wrap)
            $tagToWrap = "<$wrap>$tagToWrap</$wrap>";

        // Return the field finished (?label + field ?wrapped)
        return $tagToWrap;
    }







}