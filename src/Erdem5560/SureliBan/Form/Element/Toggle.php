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

class Toggle extends CustomFormElement{

	private $default;

	public function __construct(string $name, string $text, bool $defaultValue = false){
	parent::__construct($name, $text);
	$this->default = $defaultValue;
	}

	public function getType() : string{
	return "toggle";
	}

	public function getDefaultValue() : bool{
	return $this->default;
	}

	public function validateValue($value) : void{
	if(!is_bool($value)){
    throw new FormValidationException("Expected bool, got " . gettype($value));
	  }
	}

	protected function serializeElementData() : array{
	return [
	"default" => $this->default
	  ];
	}
  }
