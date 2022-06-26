<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\TagsTrait;

abstract class SortFields
{

    private Form $form;
    private array $sorter;

    /**
     * @example Format: ['key_number_field'=>'sorted order you want',...]
     *          Given:  [InputTag_3][SelectTag_5] -(in param should be)-> [3=>2,5=>1]
     *          Output: [SelectTag_1][InputTag_2]
     *
     * Know that you can give a nested array, if so here's how it'll process it :
     *     [[*],'fieldset_n'=>[**],'fieldset_n'=>[**],... ]
     *         * : Nested array without a key will sort the first lvl of the form fields (including fieldset)
     *         **: To sort fields inside of a specific fieldset, you need to specify the fieldset key then
     *             the array of the order you want to sort the fields (like the @example)
     *
     * @param bool $insideFieldset empty array will sort only the first level of the fields
     * @return void
     */
    public function sortFields(Form $form, array $sorter=[])
    {
        $this->form = $form;
        $this->sorter = $sorter;

        if ( empty($sorter) ) {
            sort();
        } else if( !empty($sorter) ) {

        }
    }

    private function sort()
    {
        $tempArr=[];
        foreach($this->form->getFields() as $keyField => $objectField)
            $tempArr[$keyField[-1]] = $objectField;

        ksort($tempArr);
        $this->fields = [];

        foreach($tempArr as $keyField => $objectField) {
            $pathClassArray = explode('\\', $objectField::class);
            $this->fields[array_pop($pathClassArray) . '_' . $keyField] = $objectField;
        }
    }




}