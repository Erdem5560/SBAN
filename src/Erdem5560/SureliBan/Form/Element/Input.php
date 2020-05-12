<?php

/*
      _____         _                     
     | ____|_ __ __| | ___ _ __ ___       
     |  _| | '__/ _` |/ _ \ '_ ` _ \      
     | |___| | | (_| |  __/ | | | | |     
     |_____|_|  \__,_|\___|_| |_| |_|     
          ____ ____   __    ___           
          | ___| ___| / /_  / _ \         
          |___ \___ \| '_ \| | | |        
           ___) |__) | (_) | |_| |        
          |____/____/ \___/ \___/         
           ____    _    _   _ 
          | __ )  / \  | \ | |
          |  _ \ / _ \ |  \| |
          | |_) / ___ \| |\  |
          |____/_/   \_\_| \_|
                     
                                          */

declare(strict_types=1);

namespace Erdem5560\SureliBan\Form\Element;

use pocketmine\form\FormValidationException;

class Input extends CustomFormElement{

	private $hint;
	private $default;

	public function __construct(string $name, string $text, string $hintText = "", string $defaultText = ""){
	parent::__construct($name, $text);
	$this->hint = $hintText;
	$this->default = $defaultText;
	}

	public function getType() : string{
	return "input";
	}

	public function validateValue($value) : void{
	if(!is_string($value)){
	throw new FormValidationException("Expected string, got " . gettype($value));
	  }
	}

	public function getHintText() : string{
	return $this->hint;
	}

	public function getDefaultText() : string{
	return $this->default;
	}

	protected function serializeElementData() : array{
	return [
	"placeholder" => $this->hint,
	"default" => $this->default
	  ];
	}
  }
