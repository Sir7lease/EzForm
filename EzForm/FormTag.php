<?php
namespace EzForm;
/**
*	TODO: 	- Check/verify/validate the values set by the user before putting it into the form as attribute otherwise throw error.
**/


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
		// Assign values to the attributes.
		$this->attributes = [
			'action' => '',
			'method' => 'GET',
		];
	}


	public function getFormTagAttributes(): array
	{
		return $this->attributes;
	}

}