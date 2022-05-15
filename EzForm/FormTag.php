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
	/** @var string|null $acceptCharset attribute that specifies the character encodings used for the form submission */
	private ?string $attrAcceptCharset;
	
	/** 
	 *	@var string $action attribute that specifies where to send the form-data when a form is submitted
	 *	@default empty string (which mean to itself)
	 */
	private string $attrAction;
	
	/** @var string|null $autoComplete attribute that specifies whether a form should have autocomplete on or off */
	private ?string $attrAutoComplete;
	
	/** @var string|null $enctype attribute that specifies how the form-data should be encoded when submitting it to the server (only for method="POST") */
	private ?string $attrEnctype;
	
	/** 
	 *	@var string $method attribute that specifies the HTTP method to use when sending form-data
	 *	@default POST to protect from sending as parameters.
	 */
	private string $attrMethod;

	/** @var string|null $noValidate attribute that specifies that the form should not be validated when submitted */
	private ?string $attrNoValidate;
	
	/** @var string|null $rel attribute that specifies the relationship between a linked resource and the current document */
	private ?string $attrRel;
	
	/** @var string|null $target attribute that specifies where to display the response that is received after submitting the form */
	private ?string $attrTarget;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
	protected array $attributes = [];


	public function __construct()
	{
		// Assign values to the attributes.
		$this->attributes = [
			"action" => '',
			"method" => 'GET',
		];
	}


	public function getFormTagAttributes(): array
	{
		return $this->attributes;
	}

	public function addAttrAcceptCharset(): self
	{
		$this->attributes['accept-charset'] = 'character_set';
		return $this;
	}
	
	public function addAttrAction(string $attrAction): self
	{
		$this->attributes['action'] = $attrAction;
		return $this;
	}
	
	public function addAttrAutoComplete(string $autoComplete='on'): self
	{
		$this->attributes['autocomplete'] = $autoComplete;
		return $this;
	}
	
	public function addAttrEnctype(string $enctype='application/x-www-form-urlencoded'): self
	{
		$this->attributes['enctype'] = $enctype;
		return $this;
	}
	
	public function addAttrMethod(string $method='GET'): self
	{
		$this->attributes['method'] = $method;
		return $this;
	}
	
	public function addAttrNoValidate(): self
	{
		$this->attributes['novalidate'] = 'true';
		return $this;
	}
	
	public function addAttrRel(string $rel): self
	{
		$this->attributes['rel'] = $rel;
		return $this;
	}
	
	public function addAttrTarget(string $target): self
	{
		$this->attributes['target'] = $target;
		return $this;
	}
	
	
	
	
}