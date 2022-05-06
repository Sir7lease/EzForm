<?php

/**
 * This Class set the attributes for the tag form, and open the tag form
 *
 * @author  Hammoumi Abdelaziz
 */
class FormTag
{
	private $action;
	private $method;
	private $acceptCharset;
	private $autoComplete;
	private $enctype;
	private $name;
	private $noValidate;
	private $rel;
	private $target;
	private $attributes = [];
	
	public function __construct($action='', $method='POST', $acceptCharset=null, $autoComplete=null, $enctype=null, $name=null, $noValidate=null, $rel=null, $target=null)
	{
		$this->attributes = [
			"action" => $action,
			"method" => $method,
			"acceptCharset" => $acceptCharset,
			"autoComplete" => $autoComplete,
			"enctype" => $enctype,
			"name" => $name,
			"noValidate" => $noValidate,
			"rel" => $rel,
			"target" => $target,
		];
		
		$this->openForm();
	}
	
	private function openForm()
	{
		$listAttributes = "";
		
		foreach($this->attributes as $attribute => $value)
			$listAttributes .= ($value) ? "$attribute='$value'" : '';
		
		$this->openTagForm = base64_encode("<form $listAttributes>");
		
		return $this;
	}
	
	
	
	
	
	
	
}