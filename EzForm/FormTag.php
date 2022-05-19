<?php
namespace EzForm;

use EzForm\FieldAttributes;

/**
 * This Class set the attributes for the tag form, and open the tag form
 *
 * @author  Hammoumi Abdelaziz
 */
class FormTag extends FieldAttributes
{
    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
	protected array $attributes = [];

	public function __construct()
	{
		$this->attributes = [
			'action' => '',
			'method' => 'GET',
		];
	}

    /**
     * @return array
     */
	public function getFormTagAttributes(): array
	{
		return $this->attributes;
	}

}