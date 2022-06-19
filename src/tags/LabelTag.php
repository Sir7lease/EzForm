<?php
declare(strict_types=1);

namespace Aham\EzForm\Tags;

use Aham\EzForm\Attributes\FieldAttributes;

/**
 * This Class allows you to add a <label> to go with your field
 *
 * @author  Hammoumi Abdelaziz
 */
abstract class LabelTag implements FieldInterface
{
    protected string $labelName;

    public function getLabelName(): string
    {
        return $this->labelName;
    }
}