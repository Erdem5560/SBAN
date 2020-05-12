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

class Slider extends CustomFormElement{

	private $min;
	private $max;
	private $step;
	private $default;

	public function __construct(string $name, string $text, float $min, float $max, float $step = 1.0, ?float $default = null){
	parent::__construct($name, $text);
	if($this->min > $this->max){
	throw new \InvalidArgumentException("Slider min value should be less than max value");
	}
	$this->min = $min;
	$this->max = $max;
	if($default !== null){
	if($default > $this->max or $default < $this->min){
	throw new \InvalidArgumentException("Default must be in range $this->min ... $this->max");
	}
	$this->default = $default;
	}else{
	$this->default = $this->min;
	}
	if($step <= 0){
	throw new \InvalidArgumentException("Step must be greater than zero");
	  }
	$this->step = $step;
	}

	public function getType() : string{
	return "slider";
	}

	public function validateValue($value) : void{
	if(!is_float($value) and !is_int($value)){
	throw new FormValidationException("Expected float, got " . gettype($value));
	}
	if($value < $this->min or $value > $this->max){
	throw new FormValidationException("Value $value is out of bounds (min $this->min, max $this->max)");
	  }
	}

	public function getMin() : float{
	return $this->min;
	}

	public function getMax() : float{
	return $this->max;
	}

	public function getStep() : float{
	return $this->step;
	}

	public function getDefault() : float{
	return $this->default;
	}

	protected function serializeElementData() : array{
	return [
	"min" => $this->min,
	"max" => $this->max,
	"default" => $this->default,
	"step" => $this->step
	  ];
	}
  }
