<?php
declare(strict_types=1);

namespace Aham\EzForm\Tags;

class FieldsetTag implements FieldInterface
{
    private string $legend;
    private array $fieldset;

    /**
     * @param string $legend
     * @param FieldInterface[] $fieldset
     */
    public function __construct(string $legend, array $fieldset)
    {
        $this->legend = $legend;

        $this->fieldset = $fieldset;
    }

    public function getLegend(): string
    {
        return $this->legend;
    }

    public function getFieldset(): array
    {
        return $this->fieldset;
    }

}