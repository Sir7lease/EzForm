<?php
    namespace src;

    use src\Tags\FieldInterface;

    /**
     * This Class Build a Field with all the attributes
     *
     * @author  Hammoumi Abdelaziz
     */
    abstract class TagBuilder
    {

        private int $poil = 0;

        protected array|string $wrapTags;

        public function __construct(array $wrapTags=[])
        {
            $this->wrapTags = $wrapTags;
        }

        protected function buildFormTag(array $attr): string
        {
            return "<form {$this->concatAttributesField($attr)}>";
        }


        protected function buildFieldTag(string $classNameField, FieldInterface $objectField): string
        {
            if (str_contains($classNameField, 'InputTag'))
                $fieldTag = "<input {$this->concatAttributesField($objectField->getAttributes())} />";
            elseif (str_contains($classNameField, 'TextAreaTag'))
                $fieldTag = "<textarea {$this->concatAttributesField($objectField->getAttributes())} ></textarea>";
            elseif (str_contains($classNameField, 'SelectTag'))
                $fieldTag = "<select {$this->concatAttributesField($objectField->getAttributes())} > {$this->buildOptionsSelect($objectField->selectOptions)} </select>";

            if(array_key_exists('f', $this->wrapTags))
                $fieldTag = $this->addWrap($fieldTag, $this->wrapTags['f']);

            $labelTag = (array_key_exists('l', $this->wrapTags)) ? $this->addWrap($this->isLabelWanted($objectField), $this->wrapTags['l']) : $this->isLabelWanted($objectField);

            if(array_key_exists('fl', $this->wrapTags))
                $labelField = $this->addWrap($labelTag . $fieldTag, $this->wrapTags['fl']);

            return $labelField;
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
            return implode(' ', array_map(fn($attrKey, $attrVal) => (is_numeric($attrKey))?$attrVal:"$attrKey='$attrVal'", array_keys($attr), array_values($attr)));
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
            return explode('_', $fieldKey)[($className)?0:1];
        }

        private function isLabelWanted(FieldInterface $objectField): null|string
        {
            if($objectField->hasLabelName()){
                return "<label for='{$objectField->getId()}'>{$objectField->getLabelName()}</label>";
            }
            return null;
        }

        private function addWrap($fieldTag, array|string $tags): string
        {
            if(!is_array($tags))
                $tags = array_reverse(explode(',', str_replace(' ', '', $tags)));
            foreach($tags as $tag){
                $fieldTag = "<$tag>$fieldTag</$tag>";
            }
            return $fieldTag;
        }

    }