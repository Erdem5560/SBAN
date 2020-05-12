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

namespace Erdem5560\SureliBan\Form;

class CustomFormResponse{

	private $data;

	public function __construct(array $data){
	  $this->data = $data;
	}

	public function getInt(string $name) : int{
	  $this->checkExists($name);
	  return $this->data[$name];
	}

	public function getString(string $name) : string{
	  $this->checkExists($name);
	  return $this->data[$name];
	}

	public function getFloat(string $name) : float{
	  $this->checkExists($name);
	  return $this->data[$name];
	}

	public function getBool(string $name) : bool{
	  $this->checkExists($name);
	  return $this->data[$name];
	}

	public function getAll() : array{
	  return $this->data;
	}

	private function checkExists(string $name) : void{
	if(!isset($this->data[$name])){
	throw new \InvalidArgumentException("Value \"$name\" not found");
	  }
	}
  }
