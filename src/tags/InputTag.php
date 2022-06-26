<?php
declare(strict_types=1);

namespace Aham\EzForm\Tags;

/**
 * This Class allows you to add input field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class InputTag extends LabelTag implements FieldInterface
{
    use TagsTrait;

    /**
     * @param string $labelName
     * @param array $attributes
     * @param array $wraps
     */
    public function __construct(string $labelName='', array $attributes=[], array $wraps=[])
    {
        if(!empty($labelName))
            $this->labelName = $labelName;

        $this->attributes = match((bool)$attributes) {
            true    => array_merge(['id' => 'id_', 'type' => 'text', 'name' => 'field_'], $attributes),
            default => ['id' => 'id_', 'type' => 'text', 'name' => 'field_']
        };

        $this->wraps = $wraps;
    }

}