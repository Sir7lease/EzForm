<?php
declare(strict_types=1);

namespace Aham\EzForm\Tags;

use Aham\EzForm\Attributes\FieldAttributes;

/**
 * This Class allows you to add select field in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class SelectTag extends LabelTag implements FieldInterface
{
    use TagsTrait;

    /** @var string[] $selectOptions contains the options list for the select field */
    private array $selectOptions;

    public function __construct(string $labelName='', array $attributes=[], array $options=['null' => 'No options'], array $wraps=[])
    {
        if(!empty($labelName))
            $this->labelName = $labelName;

        $this->attributes = match((bool)$attributes) {
            true    => array_merge(['id' => 'id_', 'name' => 'field_'], $attributes),
            default => ['id' => 'id_', 'name' => 'field_']
        };

        $this->selectOptions = ['null' => 'Select Option']+$options;

        $this->wraps = $wraps;
    }

    public function getOptions()
    {
        return $this->selectOptions;
    }
}