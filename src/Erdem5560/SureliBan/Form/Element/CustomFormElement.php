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

abstract class CustomFormElement implements \JsonSerializable{
    
	private $name;
	private $text;

	public function __construct(string $name, string $text){
	$this->name = $name;
	$this->text = $text;
	}

	abstract public function getType() : string;

	public function getName() : string{
	return $this->name;
	}

	public function getText() : string{
	return $this->text;
	}

	abstract public function validateValue($value) : void;
	
	final public function jsonSerialize() : array{
	$ret = $this->serializeElementData();
	$ret["type"] = $this->getType();
	$ret["text"] = $this->getText();
	  return $ret;
	}

	abstract protected function serializeElementData() : array;
  }
