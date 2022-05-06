<?php

/**
*	TODO: 	- Check/verify the values set by the user before putting it into the form as attribut otherwise throw error.
*			- Code the part to always add method and action to the attributes of the form.
**/

/**
 * This Class set the attributes for the tag form, and open the tag form
 *
 * @author  Hammoumi Abdelaziz
 */
class FormTag
{
	/** @var string|null $acceptCharset attribute that specifie the character encodings used for the form submission */
	private $acceptCharset = null;
	
	/** 
	 *	@var string $action attribute that specifies where to send the form-data when a form is submitted
	 *	@default empty string (which mean to itself)
	 */
	private $action = '';
	
	/** @var string|null $autoComplete attribute that specifies whether a form should have autocomplete on or off */
	private $autoComplete = null;
	
	/** @var string|null $enctype attribute that specifie how the form-data should be encoded when submitting it to the server (only for method="POST") */
	private $enctype = null;
	
	/** 
	 *	@var string $method attribute that specifie the HTTP method to use when sending form-data
	 *	@default POST to protect from sending as parameters.
	 */
	private $method = 'POST';
	
	/** @var string|null $name attribute that specifie the name of a form */
	private $name = null;
	
	/** @var string|null $noValidate attribute that specifie that the form should not be validated when submitted */
	private $noValidate = null;
	
	/** @var string|null $rel attribute that specifie the relationship between a linked resource and the current document */
	private $rel = null;
	
	/** @var string|null $target attribute that specifie where to display the response that is received after submitting the form */
	private $target = null;
	
	private $attributes = [];
	
	
	
	/**
     * Open the <form ...> with all the attributes that aren't null. Only the attributes [method] and [action] will be always added in.
     *
     * @return self
     */
	public function setForm()
	{
		$this->attributes = [
			"accept-charset" => $this->acceptCharset,
			"action" => $this->action,
			"autocomplete" => $this->autoComplete,
			"enctype" => $this->enctype,
			"method" => $this->method,
			"name" => $this->name,
			"novalidate" => $this->noValidate,
			"rel" => $this->rel,
			"target" => $this->target,
		];
		
		
		$listAttributes = "";
		
		foreach($this->attributes as $attribute => $value)
			$listAttributes .= ($value) ? "$attribute='$value'" : '';
		
		$this->openTagForm = base64_encode("<form $listAttributes>");
		
		return $this;
	}
	
	
	
	public function getAcceptCharset(): ?string
	{
		return $this->acceptCharset;
	}
	
	public function setAcceptCharset(string $acceptCharset): self
	{
		$this->acceptCharset = $acceptCharset;
		return $this;
	}
	
	public function getAction(): ?string
	{
		return $this->action;
	}
	
	public function setAction(string $action): self
	{
		$this->action = $action;
		return $this;
	}
	
	public function getAutoComplete(): ?string
	{
		return $this->autoComplete;
	}
	
	public function setAutoComplete(string $autoComplete): self
	{
		$this->autoComplete = $autoComplete;
		return $this;
	}
	
	public function getEnctype(): ?string
	{
		return $this->enctype;
	}
	
	public function setEnctype(string $enctype): self
	{
		$this->enctype = $enctype;
		return $this;
	}
	
	public function getMethod(): ?string
	{
		return $this->method;
	}
	
	public function setMethod(string $method): self
	{
		$this->method = $method;
		return $this;
	}
	
	public function getName(): ?string
	{
		return $this->name;
	}
	
	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}
	
	public function getNoValidate(): ?string
	{
		return $this->noValidate;
	}
	
	public function setNoValidate(string $noValidate): self
	{
		$this->setNoValidate = $noValidate;
		return $this;
	}
	
	public function getRel(): ?string
	{
		return $this->rel;
	}
	
	public function setRel(string $rel): self
	{
		$this->rel = $rel;
		return $this;
	}
	
	public function getTarget(): ?string
	{
		return $this->target;
	}
	
	public function setTarget(string $target): self
	{
		$this->target = $target;
		return $this;
	}
}