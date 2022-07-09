<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\TagsTrait;

abstract class SortFields
{

    private Form $form;
    private array $sorter;

    /**
     * [
     *      [1=>3, 2=>5],
     *      'nomfieldset' => [1=>7,6=>3]
     *      'nomfieldset' => [1=>7,6=>3]
     *      'nomfieldset' => [1=>7,6=>3]
     * ]
     *
     */

    public function sortFields(Form $form, array $sorter=[])
    {
        $this->form = $form;
        $this->sorter = $sorter;

        foreach($sorter as $key => $field){
            if(is_array($key)){

            }else{
                foreach($sorter as $fieldsetFields){

                }
            }
        }





        /*if ( empty($sorter) ) {
            sort();
        } else if( !empty($sorter) ) {

        }*/
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