<?php
namespace EzForm;
/**
 * This Class contains all the methods needed to set input tag into your form.
 *
 * @author  Hammoumi Abdelaziz
 */
class InputField
{

	public function __construct(
		protected FormTag $form
	){
	}
	
	public function getObject(){
		return $this->form;
	}
	
	public function getAttrName()
	{
		
	}
	
	public function setAttrName()
	{
		
	}
	
}