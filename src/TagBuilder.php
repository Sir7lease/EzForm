<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\FieldInterface;

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
     * @param string $classNameField
     * @param FieldInterface $objectField
     * @return string field ready to be added to the <form>
     */
    protected function buildFieldTag(string $classNameField, FieldInterface $objectField): string
    {
        $this->singleFieldWrap = $objectField->getWrap();

        $this->labelTag = ($this->isLabelWanted($objectField))??'';

        if (str_contains($classNameField, 'InputTag'))
            $this->fieldTag = "<input {$this->concatAttributesField($objectField->getAttributes())} />";
        elseif (str_contains($classNameField, 'TextAreaTag'))
            $this->fieldTag = "<textarea {$this->concatAttributesField($objectField->getAttributes())} ></textarea>";
        elseif (str_contains($classNameField, 'SelectTag'))
            $this->fieldTag = "<select {$this->concatAttributesField($objectField->getAttributes())} > {$this->buildOptionsSelect($objectField->selectOptions)} </select>";




        /*if( isset( $this->wrapTags ) && array_key_exists('f', $this->wrapTags ) )
            $fieldTag = $this->addWrap($fieldTag, $this->wrapTags['f']);

        $labelTag = (isset($this->wrapTags) && array_key_exists('l', $this->wrapTags)) ?
          $this->addWrap($this->isLabelWanted($objectField), $this->wrapTags['l']) : $this->isLabelWanted($objectField);

        $labelField = (isset($this->wrapTags) && array_key_exists('fl', $this->wrapTags)) ? $this->addWrap($labelTag . $fieldTag, $this->wrapTags['fl']) : $labelTag . $fieldTag;*/

        return $this->addWrap();
    }


    protected function buildFieldsetTag(string $nameFielset, array $fieldset): string
    {
        $fieldsetFields = '';
        foreach ($fieldset as $classNameField => $objectField)
            $fieldsetFields .= $this->buildFieldTag($classNameField, $objectField);
        return <<<FIELDSET
           <fieldset>
              <legend>{$this->splitStringByUnderscore($nameFielset, false)}</legend>
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

    /**
     * Return either : the class name that created the field object (0)
     *              or the fieldset name if a fieldset is added to the form (1)
     */
    private function splitStringByUnderscore(string $fieldKey, bool $className=true): string
    {
        return explode('_', $fieldKey)[($className) ? 0 : 1];
    }


    private function isLabelWanted(FieldInterface $objectField): null|string
    {
        if($objectField->hasLabelName()){
            return "<label for='{$objectField->getId()}'>{$objectField->getLabelName()}</label>";
        }
        return null;
    }


    private function addWrap(): string
    {
        $singleWrap = [];
        $globalWrap = [];

        if ($this->labelTag) {
            // Label Wrap (first Single then Global)
            if (isset($this->singleFieldWrap) && array_key_exists('l', $this->singleFieldWrap))
                if (!is_array($this->singleFieldWrap['l']))
                    $singleWrap = array_reverse(explode(',', str_replace(' ', '', $this->singleFieldWrap['l'])));
                foreach ($singleWrap as $tag)
                    $this->labelTag = "<$tag>$this->labelTag</$tag>";

            if (isset($this->globalFieldWrap) && array_key_exists('l', $this->globalFieldWrap))
                if (!is_array($this->globalFieldWrap['l']))
                    $globalWrap = array_reverse(explode(',', str_replace(' ', '', $this->globalFieldWrap['l'])));
                foreach ($globalWrap as $tag)
                    $this->labelTag = "<$tag>$this->labelTag</$tag>";
        }

        $singleWrap = [];
        $globalWrap = [];
        // Field Wrap (first Single then Global)
        if(isset($this->singleFieldWrap) && array_key_exists('f', $this->singleFieldWrap))
            if(!is_array($this->singleFieldWrap['f']))
                $singleWrap = array_reverse(explode(',', str_replace(' ', '', $this->singleFieldWrap['f'])));
            foreach($singleWrap as $tag)
                $this->fieldTag = "<$tag>$this->fieldTag</$tag>";

        if(isset($this->globalFieldWrap) && array_key_exists('f', $this->globalFieldWrap))
            if(!is_array($this->globalFieldWrap['f']))
                $globalWrap = array_reverse(explode(',', str_replace(' ', '', $this->globalFieldWrap['f'])));
            foreach($globalWrap as $tag)
                $this->fieldTag = "<$tag>$this->fieldTag</$tag>";

        $singleWrap = [];
        $globalWrap = [];
        // Label & Field Wrap (first Single then Global)
        $labelField = $this->labelTag . $this->fieldTag;
        if(isset($this->singleFieldWrap) && array_key_exists('lf', $this->singleFieldWrap))
            if(!is_array($this->singleFieldWrap['lf']))
                $singleWrap = array_reverse(explode(',', str_replace(' ', '', $this->singleFieldWrap['lf'])));
            foreach($singleWrap as $tag)
                $labelField = "<$tag>$labelField</$tag>";

        if(isset($this->globalFieldWrap) && array_key_exists('lf', $this->globalFieldWrap))
            if(!is_array($this->globalFieldWrap['lf']))
                $globalWrap = array_reverse(explode(',', str_replace(' ', '', $this->globalFieldWrap['lf'])));
            foreach($globalWrap as $tag)
                $labelField = "<$tag>$labelField</$tag>";


        return $labelField;
    }




    private function applyWrap(bool $wrapSingle, bool $wrapGlobal)
    {
        $singleWrap = [];
        $globalWrap = [];
        if ( $wrapSingle ) {
            if( $wrapSingle!=='l' || ( $wrapSingle==='l' && !$this->labelTag ) ){}

        }
    }







}