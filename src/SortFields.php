<?php
declare(strict_types=1);

namespace Aham\EzForm;

use Aham\EzForm\Tags\TagsTrait;

abstract class SortFields
{
    /**
     *  @example Format: ['key_number_field'=>'sorted order you want',...]
     *           Given:  [InputTag_3][SelectTag_5] -(in param should be)-> [3=>2,5=>1]
     *           Output: [SelectTag_1][InputTag_2]
     *
     *  Know that you can give a nested array, if so here's how it'll process it :
     *      [[*],'fieldset_n'=>[**],'fieldset_n'=>[**],... ]
     *          * : Nested array without a key will sort the first lvl of the form fields (including fieldset)
     *          **: Nested array with a key will sort the fieldset. You need to specify the fieldset key you
     *              wanna sort then the array of the order you want to sort the field inside of it (like the @example)
     *
     * @param bool $insideFieldset empty array will sort only the first level of the fields
     * @return void
     */
    public function sortFields(array $fields, array $sorter=[])
    {


        $tempArr=[];
        if ( empty($sorter) ) {
            foreach($fields as $keyField => $objectField) {
                $tempArr[$keyField[-1]] = [$keyField=>$objectField];
            }
        }
        sort($tempArr);
        echo "<pre>";
        print_r( $tempArr );
        echo "</pre>";
    }


}